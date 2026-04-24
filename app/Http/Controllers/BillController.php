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
    private function getCondominiumId()
    {
        $user = Auth::user();

        if ($user->isManagementStaff()) {
            return null;
        }

        if ($user->isStaff() && $user->userable) {
            return $user->userable->condominium_id;
        }

        if ($user->isAdmin()) {
            return null;
        }

        return null;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Bill::with(['resident.user', 'generatedByStaff', 'condominium']);

        if ($user->isStaff() && !$user->isManagementStaff()) {
            $query->where('condominium_id', $user->userable->condominium_id);
        } elseif ($user->isAdmin() || $user->isManagementStaff()) {
            if ($request->filled('condominium_id')) {
                $query->where('condominium_id', $request->condominium_id);
            }
        } else {
            abort(403, 'Unauthorized access.');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('bill_number', 'like', "%{$search}%")
                    ->orWhereHas('resident.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bill_type')) {
            $query->where('bill_type', $request->bill_type);
        }

        $bills = $query->orderBy('created_at', 'desc')->paginate(20);

        if ($user->isStaff() && !$user->isManagementStaff()) {
            $condoId = $user->userable->condominium_id;
            $stats = [
                'total' => Bill::where('condominium_id', $condoId)->count(),
                'pending' => Bill::where('condominium_id', $condoId)->where('status', 'pending')->count(),
                'paid' => Bill::where('condominium_id', $condoId)->where('status', 'paid')->count(),
                'overdue' => Bill::where('condominium_id', $condoId)->where('status', 'overdue')->count(),
            ];
        } else {
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

        $condominiums = ($user->isAdmin() || $user->isManagementStaff())
            ? \App\Models\Condominium::orderBy('name')->get()
            : collect();

        return view('bills.index', compact('bills', 'stats', 'condominiums'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->isManagementStaff() || $user->isAdmin()) {
            $condominiums = \App\Models\Condominium::orderBy('name')->get();
            $residents = collect();
            return view('bills.create', compact('residents', 'condominiums'));
        }

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

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->isManagementStaff() || $user->isAdmin()) {
            $condominiumId = $request->condominium_id;
        } else {
            $condominiumId = $this->getCondominiumId();
        }

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

        $resident = Resident::findOrFail($validated['resident_id']);
        $validated['condominium_id'] = $condominiumId;
        $validated['generated_by'] = Auth::id();
        $validated['unit_number'] = $resident->unit_number;
        $validated['bill_number'] = Bill::generateBillNumber();
        $validated['status'] = 'pending';

        $bill = Bill::create($validated);

        try {
            $resident = Resident::with('user')->find($validated['resident_id']);
            if ($resident && $resident->user && $resident->user->email) {
                Mail::to($resident->user->email)->send(new NewBillMail($bill, $resident->user->email, $resident->user->name));
            }
        } catch (\Exception $e) {
            logger()->error('Failed to send bill notification email: ' . $e->getMessage());
        }

        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    public function show(Bill $bill)
    {
        $user = Auth::user();

        if ($user->isResident()) {
            if ($bill->resident->user_id !== Auth::id()) {
                abort(403);
            }
        } elseif (!$user->isAdmin() && !$user->isManagementStaff()) {
            $condominiumId = $this->getCondominiumId();
            if ($bill->condominium_id !== $condominiumId) {
                abort(403);
            }
        }

        $bill->load(['resident.user', 'generatedByStaff', 'condominium']);
        return view('bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isManagementStaff()) {
            $condominiumId = $this->getCondominiumId();
            if ($bill->condominium_id !== $condominiumId) {
                abort(403);
            }
        }

        if ($bill->status === 'paid') {
            return back()->with('error', 'Cannot edit paid bills.');
        }

        $condominiumId = $bill->condominium_id;
        $residents = Resident::where('condominium_id', $condominiumId)
            ->where('is_active', true)
            ->with('user')
            ->orderBy('unit_number')
            ->get();

        return view('bills.edit', compact('bill', 'residents'));
    }

    public function update(Request $request, Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isManagementStaff()) {
            $condominiumId = $this->getCondominiumId();
            if ($bill->condominium_id !== $condominiumId) {
                abort(403);
            }
        }

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

        if ($validated['resident_id'] != $bill->resident_id) {
            $resident = Resident::findOrFail($validated['resident_id']);
            $validated['unit_number'] = $resident->unit_number;
        }

        $bill->update($validated);
        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }

    public function markAsPaid(Request $request, Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isManagementStaff()) {
            $condominiumId = $this->getCondominiumId();
            if ($bill->condominium_id !== $condominiumId) {
                abort(403);
            }
        }

        $validated = $request->validate([
            'payment_method' => 'required|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        $bill->markAsPaid($validated['payment_method'], $validated['payment_reference'] ?? null);
        return back()->with('success', 'Bill marked as paid.');
    }

    public function destroy(Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isManagementStaff()) {
            $condominiumId = $this->getCondominiumId();
            if ($bill->condominium_id !== $condominiumId) {
                abort(403);
            }
        }

        if ($bill->status === 'paid') {
            return back()->with('error', 'Cannot delete paid bills.');
        }

        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }

    public function myBills(Request $request)
    {
        $user = Auth::user();

        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        $query = Bill::where('resident_id', $resident->id)
            ->with('generatedByStaff');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

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

    public function myBillShow(Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        if ($bill->resident_id !== $resident->id) {
            abort(403);
        }

        $bill->load('generatedByStaff', 'condominium');
        return view('bills.my-bills-show', compact('bill'));
    }

    public function uploadPayment(Request $request, Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        if ($bill->resident_id !== $resident->id) {
            abort(403);
        }

        $request->validate([
            'payment_slip' => 'required|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $path = $request->file('payment_slip')->store('payment-proofs', 's3');

        $bill->update([
            'payment_proof' => $path,
            'payment_method' => 'qr_code',
            'payment_date' => now(),
            'status' => 'paid',
        ]);

        return back()->with('success', 'Payment receipt uploaded! Bill marked as paid.');
    }

    public function submitCard(Request $request, Bill $bill)
    {
        $user = Auth::user();

        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        if ($bill->resident_id !== $resident->id) {
            abort(403);
        }

        $request->validate([
            'card_number' => 'required',
            'card_name' => 'required',
            'expiry' => 'required',
            'cvv' => 'required',
        ]);

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
