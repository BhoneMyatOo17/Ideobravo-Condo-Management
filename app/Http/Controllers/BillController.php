<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBillMail;

class BillController extends Controller
{
    /**
     * Get the condominium ID for the current staff/admin user
     */
    private function getCondominiumId()
    {
        $user = Auth::user();
        
        if ($user->isStaff() && $user->userable) {
            return $user->userable->condominium_id;
        }
        
        if ($user->isAdmin()) {
            // Admin can see first condo or implement condo selection
            return \App\Models\Condominium::first()?->id;
        }
        
        return null;
    }

    /**
     * Display a listing of bills (Staff/Admin view)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Start the query
        $query = Bill::with(['resident.user', 'generatedByStaff', 'condominium']);
        
        // Apply condominium filter based on user role
        if ($user->isStaff() && $user->userable) {
            // Staff can only see bills from their condominium
            $query->where('condominium_id', $user->userable->condominium_id);
        } elseif ($user->isAdmin()) {
            // Admin can see all bills, but can filter by condominium if desired
            if ($request->filled('condominium_id')) {
                $query->where('condominium_id', $request->condominium_id);
            }
        } else {
            abort(403, 'Unauthorized access.');
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('bill_number', 'like', "%{$search}%")
                ->orWhereHas('resident.user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Bill type filter
        if ($request->filled('bill_type')) {
            $query->where('bill_type', $request->bill_type);
        }

        $bills = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Calculate stats based on user role
        if ($user->isStaff() && $user->userable) {
            $condoId = $user->userable->condominium_id;
            $stats = [
                'total' => Bill::where('condominium_id', $condoId)->count(),
                'pending' => Bill::where('condominium_id', $condoId)->where('status', 'pending')->count(),
                'paid' => Bill::where('condominium_id', $condoId)->where('status', 'paid')->count(),
                'overdue' => Bill::where('condominium_id', $condoId)->where('status', 'overdue')->count(),
            ];
        } else {
            // Admin sees all bills or filtered bills
            $statsQuery = Bill::query();
            if ($request->filled('condominium_id')) {
                $statsQuery->where('condominium_id', $request->condominium_id);
            }
            
            $stats = [
                'total' => (clone $statsQuery)->count(),
                'pending' => (clone $statsQuery)->where('status', 'pending')->count(),
                'paid' => (clone $statsQuery)->where('status', 'paid')->count(),
                'overdue' => (clone $statsQuery)->where('status', 'overdue')->count(),
            ];
        }
        
        // Get all condominiums for admin filter dropdown
        $condominiums = $user->isAdmin() ? \App\Models\Condominium::orderBy('name')->get() : collect();
        
        return view('bills.index', compact('bills', 'stats', 'condominiums'));
    }

    /**
     * Show the form for creating a new bill
     */
    public function create()
    {
        $condominiumId = $this->getCondominiumId();
        
        if (!$condominiumId) {
            abort(403, 'No condominium associated with your account.');
        }

        $residents = Resident::where('condominium_id', $condominiumId)
            ->where('is_active', true)
            ->with('user')
            ->orderBy('unit_number')
            ->get();
        
        return view('bills.create', compact('residents'));
    }

    /**
     * Store a newly created bill
     */
    public function store(Request $request)
    {
        $condominiumId = $this->getCondominiumId();
        
        if (!$condominiumId) {
            abort(403, 'No condominium associated with your account.');
        }

        $validated = $request->validate([
        'resident_id' => 'required|exists:residents,id',
        'bill_type' => 'required|in:common_area,water,electricity,insurance,parking,other',
        'amount' => 'required|numeric|min:1',
        'issue_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:issue_date',
        'notes' => 'nullable|string',
    ], [
        'amount.min' => 'The bill amount must be at least ฿1.00',
    ]);

        // Get resident details
        $resident = Resident::findOrFail($validated['resident_id']);

        $validated['condominium_id'] = $condominiumId;
        $validated['generated_by'] = Auth::user()->id;
        $validated['unit_number'] = $resident->unit_number;
        $validated['bill_number'] = Bill::generateBillNumber();
        $validated['status'] = 'pending';

        $bill = Bill::create($validated);

        try {
    $resident = Resident::with('user')->find($validated['resident_id']);
    
    if ($resident && $resident->user && $resident->user->email) {
        Mail::to($resident->user->email)->send(new NewBillMail(
            $bill,
            $resident->user->email,
            $resident->user->name
        ));
    }
} catch (\Exception $e) {
    // Log error but don't fail the bill creation
 logger()->error('Failed to send bill notification email: ' . $e->getMessage());
}

        return redirect()->route('bills.index')
            ->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified bill
     */
    public function show(Bill $bill)
    {
        // Check permissions
        if (Auth::user()->isResident()) {
            // Residents can only view their own bills
            if ($bill->resident->user_id !== Auth::id()) {
                abort(403);
            }
        } else {
            // Staff/Admin can only view bills from their condo
            $condominiumId = $this->getCondominiumId();
            if ($bill->condominium_id !== $condominiumId) {
                abort(403);
            }
        }

        $bill->load(['resident.user', 'generatedByStaff', 'condominium']);

        return view('bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the bill
     */
    public function edit(Bill $bill)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($bill->condominium_id !== $condominiumId) {
            abort(403);
        }

        // Cannot edit paid bills
        if ($bill->status === 'paid') {
            return back()->with('error', 'Cannot edit paid bills.');
        }

        $residents = Resident::where('condominium_id', $condominiumId)
            ->where('is_active', true)
            ->with('user')
            ->orderBy('unit_number')
            ->get();
        
        return view('bills.edit', compact('bill', 'residents'));
    }

    /**
     * Update the specified bill
     */
    public function update(Request $request, Bill $bill)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($bill->condominium_id !== $condominiumId) {
            abort(403);
        }

        // Cannot update paid bills
        if ($bill->status === 'paid') {
            return back()->with('error', 'Cannot update paid bills.');
        }

        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'bill_type' => 'required|in:common_area,water,electricity,insurance,parking,other',
            'amount' => 'required|numeric|min:1',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|in:pending,paid,overdue,cancelled',
            'notes' => 'nullable|string',
        ], [
            'amount.min' => 'The bill amount must be at least ฿1.00',
        ]);

        // Update unit number if resident changed
        if ($validated['resident_id'] != $bill->resident_id) {
            $resident = Resident::findOrFail($validated['resident_id']);
            $validated['unit_number'] = $resident->unit_number;
        }

        $bill->update($validated);

        return redirect()->route('bills.index')
            ->with('success', 'Bill updated successfully.');
    }

    /**
     * Mark bill as paid
     */
    public function markAsPaid(Request $request, Bill $bill)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($bill->condominium_id !== $condominiumId) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        $bill->markAsPaid($validated['payment_method'], $validated['payment_reference'] ?? null);

        return back()->with('success', 'Bill marked as paid.');
    }

    /**
     * Remove the specified bill
     */
    public function destroy(Bill $bill)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($bill->condominium_id !== $condominiumId) {
            abort(403);
        }

        // Cannot delete paid bills
        if ($bill->status === 'paid') {
            return back()->with('error', 'Cannot delete paid bills.');
        }

        $bill->delete();

        return redirect()->route('bills.index')
            ->with('success', 'Bill deleted successfully.');
    }

    /**
     * Display bills for logged-in resident
     */
    public function myBills(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        $query = Bill::where('resident_id', $resident->id)
            ->with('generatedByStaff');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by bill type
        if ($request->filled('bill_type')) {
            $query->where('bill_type', $request->bill_type);
        }

        $bills = $query->orderBy('due_date', 'desc')->paginate(20);

        $stats = [
            'total' => Bill::where('resident_id', $resident->id)->count(),
            'pending' => Bill::where('resident_id', $resident->id)->where('status', 'pending')->count(),
            'paid' => Bill::where('resident_id', $resident->id)->where('status', 'paid')->count(),
            'overdue' => Bill::where('resident_id', $resident->id)->where('status', 'overdue')->count(),
            'pending_amount' => Bill::where('resident_id', $resident->id)->where('status', 'pending')->sum('amount'),
        ];

        return view('bills.my-bills', compact('bills', 'stats'));
    }

    /**
     * Display specific bill for resident
     */
    public function myBillShow(Bill $bill)
    {
        $user = Auth::user();
        
        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        // Check if bill belongs to this resident
        if ($bill->resident_id !== $resident->id) {
            abort(403);
        }

        $bill->load('generatedByStaff', 'condominium');

        return view('bills.my-bills-show', compact('bill'));
    }
    /**
 * Upload payment receipt
 */
public function uploadPayment(Request $request, Bill $bill)
{
    $user = Auth::user();
    
    if (!$user->isResident()) {
        abort(403);
    }

    $resident = Resident::where('user_id', $user->id)->firstOrFail();

    // Check if bill belongs to this resident
    if ($bill->resident_id !== $resident->id) {
        abort(403);
    }

    $request->validate([
        'payment_slip' => 'required|image|mimes:jpeg,jpg,png|max:5120',
    ]);

    $path = $request->file('payment_slip')->store('payment-proofs', 'public');

    $bill->update([
        'payment_proof' => $path,
        'payment_method' => 'qr_code',
        'payment_date' => now(),
        'status' => 'paid',
    ]);

    return back()->with('success', 'Payment receipt uploaded! Bill marked as paid.');
}
    /**
     * Submit card payment (simulated)
     */
    public function submitCard(Request $request, Bill $bill)
    {
    $user = Auth::user();
    
    if (!$user->isResident()) {
        abort(403);
    }

    $resident = Resident::where('user_id', $user->id)->firstOrFail();

    // Check if bill belongs to this resident
    if ($bill->resident_id !== $resident->id) {
        abort(403);
    }

    $request->validate([
        'card_number' => 'required',
        'card_name' => 'required',
        'expiry' => 'required',
        'cvv' => 'required',
    ]);

    // Simulated payment success
    $bill->update([
        'payment_method' => 'card',
        'payment_date' => now(),
        'status' => 'paid',
    ]);

    return redirect()
        ->route('my-bills.show', $bill)
        ->with('success', 'Payment completed successfully!');
}
}