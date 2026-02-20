<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Condominium;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CondoCodeController extends Controller
{
    /**
     * Show the condo code entry form
     */
    public function show()
    {
        if (Auth::user()->hasRole()) {
            return redirect()->route('dashboard');
        }

        return view('auth.condo-code');
    }

    /**
     * Verify the condominium code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'condominium_code' => ['required', 'string', 'exists:condominiums,code'],
        ], [
            'condominium_code.exists' => 'Invalid condominium code. Please check and try again.',
        ]);

        // Get the condominium
        $condominium = Condominium::where('code', $request->condominium_code)->first();

        // Store condominium in session for next step
        session(['pending_condominium_id' => $condominium->id]);

        return redirect()->route('resident.details');
    }

    /**
     * Show resident details form
     */
    public function showDetails()
    {
        // Check if user already has a role
        if (Auth::user()->hasRole()) {
            return redirect()->route('dashboard');
        }

        // Check if condominium is in session
        if (!session()->has('pending_condominium_id')) {
            return redirect()->route('condo-code')->with('error', 'Please enter your condominium code first.');
        }

        $condominium = Condominium::findOrFail(session('pending_condominium_id'));

        return view('auth.resident-details', compact('condominium'));
    }

    /**
     * Complete resident registration
     */
    public function complete(Request $request)
    {
        $request->validate([
            'condominium_id' => ['required', 'exists:condominiums,id'],
            'unit_number' => ['required', 'string', 'max:20'],
            'floor' => ['nullable', 'string', 'max:10'],
            'residency_status' => ['required', 'in:owner,tenant'],
            'move_in_date' => ['nullable', 'date'],
            'number_of_occupants' => ['nullable', 'integer', 'min:1', 'max:20'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'emergency_contact_relationship' => ['nullable', 'string', 'max:100'],
        ]);

        $user = Auth::user();

        // Check if user already has a role
        if ($user->hasRole()) {
            return redirect()->route('dashboard')->with('error', 'You already have a registered profile.');
        }

        // Create resident record
        $resident = Resident::create([
            'user_id' => $user->id,
            'condominium_id' => $request->condominium_id,
            'unit_number' => $request->unit_number,
            'floor' => $request->floor,
            'residency_status' => $request->residency_status,
            'move_in_date' => $request->move_in_date ?? now(),
            'number_of_occupants' => $request->number_of_occupants ?? 1,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
            'is_active' => true,
        ]);

        // Update user with polymorphic relationship
        $user->update([
            'user_type' => 'resident',
            'userable_id' => $resident->id,
            'userable_type' => Resident::class,
        ]);

        // Clear session
        session()->forget('pending_condominium_id');

        return redirect()->route('dashboard')->with('success', 'Welcome to ' . $resident->condominium->name . '!');
    }
}