<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResidentController extends Controller
{
    /**
     * Display a listing of residents
     */
    public function index(Request $request)
    {
        $query = Resident::where('condominium_id', Auth::user()->condo_id)
            ->with('user');

        // Filter by active/inactive
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filter by residency type
        if ($request->has('residency_status')) {
            $query->where('residency_status', $request->residency_status);
        }

        // Search by name, email, or unit number
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('unit_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $residents = $query->orderBy('unit_number')->paginate(20);

        $stats = [
            'total' => Resident::where('condominium_id', Auth::user()->condo_id)->count(),
            'active' => Resident::where('condominium_id', Auth::user()->condo_id)->where('is_active', true)->count(),
            'owners' => Resident::where('condominium_id', Auth::user()->condo_id)->where('residency_status', 'owner')->count(),
            'tenants' => Resident::where('condominium_id', Auth::user()->condo_id)->where('residency_status', 'tenant')->count(),
        ];

        return view('residents.index', compact('residents', 'stats'));
    }

    /**
     * Show the form for creating a new resident
     */
    public function create()
    {
        return view('residents.create');
    }

    /**
     * Store a newly created resident
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'unit_number' => 'required|string|max:255',
            'floor' => 'nullable|string|max:255',
            'move_in_date' => 'nullable|date',
            'residency_status' => 'required|in:owner,tenant',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'number_of_occupants' => 'nullable|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'condo_id' => Auth::user()->condo_id,
                'user_type' => 'resident',
            ]);

            // Create resident profile
            $resident = Resident::create([
                'user_id' => $user->id,
                'condominium_id' => Auth::user()->condo_id,
                'unit_number' => $validated['unit_number'],
                'floor' => $validated['floor'] ?? null,
                'move_in_date' => $validated['move_in_date'] ?? now(),
                'residency_status' => $validated['residency_status'],
                'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                'emergency_contact_relationship' => $validated['emergency_contact_relationship'] ?? null,
                'number_of_occupants' => $validated['number_of_occupants'] ?? 1,
                'is_active' => true,
            ]);

            // Update user polymorphic relationship
            $user->update([
                'userable_id' => $resident->id,
                'userable_type' => Resident::class,
            ]);

            DB::commit();

            return redirect()->route('residents.index')
                ->with('success', 'Resident created successfully. Login credentials sent to email.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to create resident: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resident
     */
    public function show(Resident $resident)
    {
        if ($resident->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        $resident->load('user');

        // Get resident's parcels and bills
        $recentParcels = $resident->user->parcels()->latest()->limit(5)->get();
        $recentBills = $resident->user->bills()->latest()->limit(5)->get();

        return view('residents.show', compact('resident', 'recentParcels', 'recentBills'));
    }

    /**
     * Show the form for editing the resident
     */
    public function edit(Resident $resident)
    {
        if ($resident->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        $resident->load('user');

        return view('residents.edit', compact('resident'));
    }

    /**
     * Update the specified resident
     */
    public function update(Request $request, Resident $resident)
    {
        if ($resident->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $resident->user_id,
            'unit_number' => 'required|string|max:255',
            'floor' => 'nullable|string|max:255',
            'move_in_date' => 'nullable|date',
            'move_out_date' => 'nullable|date|after_or_equal:move_in_date',
            'residency_status' => 'required|in:owner,tenant',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'number_of_occupants' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            // Update user
            $resident->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update resident profile
            $resident->update([
                'unit_number' => $validated['unit_number'],
                'floor' => $validated['floor'] ?? null,
                'move_in_date' => $validated['move_in_date'],
                'move_out_date' => $validated['move_out_date'] ?? null,
                'residency_status' => $validated['residency_status'],
                'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                'emergency_contact_relationship' => $validated['emergency_contact_relationship'] ?? null,
                'number_of_occupants' => $validated['number_of_occupants'] ?? 1,
                'is_active' => $validated['is_active'],
            ]);

            DB::commit();

            return redirect()->route('residents.index')
                ->with('success', 'Resident updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to update resident: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resident
     */
    public function destroy(Resident $resident)
    {
        if ($resident->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        // Check if resident has pending bills or parcels
        $hasPendingBills = $resident->user->bills()->where('status', 'pending')->exists();
        $hasPendingParcels = $resident->user->parcels()->whereIn('status', ['pending', 'notified'])->exists();

        if ($hasPendingBills || $hasPendingParcels) {
            return back()->with('error', 'Cannot delete resident with pending bills or parcels.');
        }

        DB::beginTransaction();
        try {
            $user = $resident->user;
            $resident->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('residents.index')
                ->with('success', 'Resident deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete resident: ' . $e->getMessage());
        }
    }
}