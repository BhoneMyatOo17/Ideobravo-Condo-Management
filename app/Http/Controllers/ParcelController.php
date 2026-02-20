<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParcelArrivedMail;

class ParcelController extends Controller
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
            return \App\Models\Condominium::first()?->id;
        }
        
        return null;
    }

    /**
     * Display a listing of parcels (Staff/Admin view)
     */
    public function index(Request $request)
    {
        $query = Parcel::with(['resident.user', 'receivedByStaff']);

        // For staff, filter by their condominium
        if (Auth::user()->isStaff()) {
            $condominiumId = $this->getCondominiumId();
            if (!$condominiumId) {
                abort(403, 'No condominium associated with your account.');
            }
            $query->where('condominium_id', $condominiumId);
        }

        // For admin, allow filtering by condominium
        if (Auth::user()->isAdmin() && $request->filled('condominium_id')) {
            $query->where('condominium_id', $request->condominium_id);
        }

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tracking_number', 'like', '%' . $search . '%')
                  ->orWhere('courier_service', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $parcels = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get stats
        $statsQuery = Parcel::query();
        if (Auth::user()->isStaff()) {
            $condominiumId = $this->getCondominiumId();
            $statsQuery->where('condominium_id', $condominiumId);
        }

        $stats = [
            'total' => (clone $statsQuery)->count(),
            'pending' => (clone $statsQuery)->whereIn('status', ['pending', 'notified'])->count(),
            'picked_up' => (clone $statsQuery)->where('status', 'picked_up')->count(),
            'today' => (clone $statsQuery)->whereDate('received_date', today())->count(),
        ];

        // Get condominiums for admin filter
        $condominiums = [];
        if (Auth::user()->isAdmin()) {
            $condominiums = \App\Models\Condominium::orderBy('name')->get();
        }
        
        return view('parcels.index', compact('parcels', 'stats', 'condominiums'));
    }

    /**
     * Show the form for creating a new parcel
     */
    public function create()
    {
        $condominiumId = $this->getCondominiumId();
        
        if (!$condominiumId) {
            abort(403, 'No condominium associated with your account.');
        }

        // Staff automatically uses their assigned condominium
        $condominium = \App\Models\Condominium::findOrFail($condominiumId);
        
        return view('parcels.create', compact('condominium'));
    }

    /**
     * Store a newly created parcel
     */
   public function store(Request $request)
{
    $condominiumId = $this->getCondominiumId();
    
    if (!$condominiumId) {
        abort(403, 'No condominium associated with your account.');
    }

    $validated = $request->validate([
        'recipient_name' => 'required|string|max:255',
        'room_number' => 'required|string|max:50',
        'tracking_number' => 'required|string|max:255|unique:parcels,tracking_number',
        'courier_service' => 'required|string|max:255',
        'received_date' => 'required|date|before_or_equal:today',
        'notes' => 'nullable|string',
        'parcel_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'send_notification' => 'nullable|boolean',
    ]);

    // Try to find resident by room number FIRST
    $resident = Resident::where('condominium_id', $condominiumId)
        ->where('unit_number', $validated['room_number'])
        ->where('is_active', true)
        ->with('user')
        ->first();

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('parcel_image')) {
        $imagePath = $request->file('parcel_image')->store('parcels', 'public');
    }

    // Create parcel with resident_id if found
    $parcel = Parcel::create([
        'condominium_id' => $condominiumId,
        'resident_id' => $resident?->id,
        'received_by' => Auth::id(),
        'tracking_number' => $validated['tracking_number'],
        'recipient_name' => $validated['recipient_name'],
        'unit_number' => $validated['room_number'],
        'courier_service' => $validated['courier_service'],
        'parcel_size' => 'medium',
        'status' => 'pending',
        'received_date' => $validated['received_date'],
        'notes' => $validated['notes'] ?? null,
        'image' => $imagePath,
    ]);

    // Send email notification if checkbox is checked and resident exists
    if ($request->boolean('send_notification') && $resident && $resident->user && $resident->user->email) {
        try {
            logger()->info('Sending parcel email to: ' . $resident->user->email);
            
            Mail::to($resident->user->email)->send(new ParcelArrivedMail(
                $parcel,
                $resident->user->email
            ));
            
            logger()->info('Parcel email sent successfully');
        } catch (\Exception $e) {
            logger()->error('Failed to send parcel notification email: ' . $e->getMessage());
        }
    }

    $successMessage = 'Parcel registered successfully for ' . $parcel->recipient_name . ' - Room ' . $parcel->unit_number;
    
    if ($resident) {
        $successMessage .= ' (Linked to resident: ' . $resident->user->name . ')';
    } else {
        $successMessage .= ' (No registered resident found for this room)';
    }

    return redirect()->route('parcels.index')->with('success', $successMessage);
}

    /**
     * Display the specified parcel
     */
    public function show(Parcel $parcel)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($parcel->condominium_id !== $condominiumId) {
            abort(403);
        }

        $parcel->load(['resident.user', 'receivedByStaff', 'pickedUpByResident.user']);

        return view('parcels.show', compact('parcel'));
    }

    /**
     * Show the form for editing the parcel
     */
    public function edit(Parcel $parcel)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($parcel->condominium_id !== $condominiumId) {
            abort(403);
        }
        
        return view('parcels.edit', compact('parcel'));
    }

    /**
     * Update the specified parcel
     */
    public function update(Request $request, Parcel $parcel)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($parcel->condominium_id !== $condominiumId) {
            abort(403);
        }

        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'tracking_number' => 'required|string|max:255|unique:parcels,tracking_number,' . $parcel->id,
            'courier_service' => 'required|string|max:255',
            'received_date' => 'required|date',
            'status' => 'required|in:pending,notified,picked_up',
            'notes' => 'nullable|string',
            'parcel_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Map room_number to unit_number for database
        $validated['unit_number'] = $validated['room_number'];
        unset($validated['room_number']);

        // Handle image upload - column name is 'image' in migration
        if ($request->hasFile('parcel_image')) {
            // Delete old image
            if ($parcel->image) {
                Storage::disk('public')->delete($parcel->image);
            }
            $validated['image'] = $request->file('parcel_image')->store('parcels', 'public');
        }
        unset($validated['parcel_image']);

        $parcel->update($validated);

        return redirect()->route('parcels.show', $parcel)
            ->with('success', 'Parcel updated successfully.');
    }

    /**
 * Mark parcel as picked up
 */
        public function markPickedUp(Parcel $parcel)
        {
            // Admin can mark any parcel as picked up
            if (Auth::user()->isAdmin()) {
                $parcel->markAsPickedUp($parcel->resident_id);
                return back()->with('success', 'Parcel marked as picked up.');
            }
            
            // Staff must be from the same condominium
            $condominiumId = $this->getCondominiumId();
            
            if ($parcel->condominium_id !== $condominiumId) {
                abort(403);
            }

            $parcel->markAsPickedUp($parcel->resident_id);

            return back()->with('success', 'Parcel marked as picked up.');
        }

    /**
     * Remove the specified parcel
     */
    public function destroy(Parcel $parcel)
    {
        $condominiumId = $this->getCondominiumId();
        
        if ($parcel->condominium_id !== $condominiumId) {
            abort(403);
        }

        // Delete image if exists
        if ($parcel->image) {
            Storage::disk('public')->delete($parcel->image);
        }

        $parcel->delete();

        return redirect()->route('parcels.index')
            ->with('success', 'Parcel deleted successfully.');
    }

    public function myParcels(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        $query = Parcel::where('resident_id', $resident->id)
            ->with('receivedByStaff');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $parcels = $query->orderBy('received_date', 'desc')->paginate(20);

        $stats = [
            'total' => Parcel::where('resident_id', $resident->id)->count(),
            'pending' => Parcel::where('resident_id', $resident->id)->where('status', 'pending')->count(),
            'notified' => Parcel::where('resident_id', $resident->id)->where('status', 'notified')->count(),
            'picked_up' => Parcel::where('resident_id', $resident->id)->where('status', 'picked_up')->count(),
        ];

        return view('parcels.my-parcels', compact('parcels', 'stats'));
    }

    /**
     * Display specific parcel for resident
     */
    public function myParcelShow(Parcel $parcel)
    {
        $user = Auth::user();
        
        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        // Check if parcel belongs to this resident
        if ($parcel->resident_id !== $resident->id) {
            abort(403);
        }

        $parcel->load('receivedByStaff', 'condominium');

        return view('parcels.my-parcel-show', compact('parcel'));
    }

    /**
     * Resident confirms parcel pickup
     */
    public function confirmPickup(Parcel $parcel)
    {
        $user = Auth::user();
        
        if (!$user->isResident()) {
            abort(403);
        }

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        // Check if parcel belongs to this resident
        if ($parcel->resident_id !== $resident->id) {
            abort(403);
        }

        // Check if parcel is still pending or notified
        if (!in_array($parcel->status, ['pending', 'notified'])) {
            return back()->with('error', 'This parcel has already been picked up.');
        }

        // Mark as picked up
        $parcel->markAsPickedUp($resident->id);

        return back()->with('success', 'Thank you! Parcel pickup confirmed.');
    }
}