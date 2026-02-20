<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Resident;
use App\Models\Staff;
use App\Models\Condominium;
use App\Mail\ResidentCredentials;
use App\Mail\StaffCredentials;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of all users (Staff & Admin only)
     */
    public function index(Request $request): View
    {
        $query = User::with(['userable.condominium', 'userable'])
            ->where('user_type', 'resident');

        // Staff sees only users from their condo, Admin sees all
        if (!Auth::user()->isAdmin()) {
            $condoId = Auth::user()->userable?->condominium_id;
            if ($condoId) {
                $query->whereHas('userable', function($q) use ($condoId) {
                    $q->where('condominium_id', $condoId);
                });
            }
        }

        // Filter by user type
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        // Filter by status (active/inactive)
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->whereHas('userable', function ($q) use ($isActive) {
                $q->where('is_active', $isActive);
            });
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            
            // Get Ids from related tables
            $residentUserIds = Resident::where('unit_number', 'like', "%{$search}%")
                ->pluck('user_id')
                ->toArray();
            
            $staffUserIds = Staff::where('position', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%")
                ->pluck('user_id')
                ->toArray();
            
            $relatedIds = array_merge($residentUserIds, $staffUserIds);
            
            $query->where(function ($q) use ($search, $relatedIds) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
                
                if (!empty($relatedIds)) {
                    $q->orWhereIn('id', $relatedIds);
                }
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        // Calculate stats based on condominium
        $condoId = Auth::user()->isAdmin() ? null : Auth::user()->userable?->condominium_id;

        $statsQuery = User::where('user_type', 'resident');
        
        if ($condoId) {
            $statsQuery->whereHas('userable', function($q) use ($condoId) {
                $q->where('condominium_id', $condoId);
            });
        }

        $stats = [
            'total_users' => $statsQuery->count(),
            'residents' => $statsQuery->count(),
            'staff' => 0, // Hidden from list
            'active' => (clone $statsQuery)->whereHas('userable', fn($q) => $q->where('is_active', true))->count(),
        ];

        return view('profile.index', compact('users', 'stats'));
    }

    /**
     * Display a specific user's profile (Staff & Admin only)
     */
    public function showUser(User $user): View
    {
        $user->load('userable.condominium');
        
        // Staff can only view users from their condo
        if (!Auth::user()->isAdmin()) {
            $authCondoId = Auth::user()->userable?->condominium_id;
            $userCondoId = $user->userable?->condominium_id;
            
            if ($authCondoId !== $userCondoId) {
                abort(403);
            }
        }

        // Staff cannot view other staff or admin profiles
        if (!Auth::user()->isAdmin() && ($user->isStaff() || $user->isAdmin())) {
            abort(403);
        }

        $profileData = null;
        if ($user->userable) {
            $profileData = $user->userable;
        }

        return view('profile.show', [
            'user' => $user,
            'profileData' => $profileData,
        ]);
    }

    /**
     * Show the form for creating a new user (Staff & Admin only)
     */
    public function create(): View
    {
        $condominiums = Condominium::orderBy('name')->get();
        return view('profile.create', compact('condominiums'));
    }

    /**
     * Store a newly created user (Staff & Admin only)
     */
   public function store(Request $request): RedirectResponse
    {
        $userType = $request->input('user_type', 'resident');

        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:resident,staff',
        ];

        // Condominium validation
        if (Auth::user()->isAdmin()) {
            $rules['condominium_id'] = 'required|exists:condominiums,id';
        }

        // Add role-specific validation
        if ($userType === 'resident') {
            $rules = array_merge($rules, [
                'unit_number' => 'required|string|max:255',
                'floor' => 'nullable|string|max:255',
                'residency_status' => 'required|in:owner,tenant',
                'move_in_date' => 'nullable|date',
                'number_of_occupants' => 'nullable|integer|min:1|max:20',
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_phone' => 'nullable|string|max:20',
                'emergency_contact_relationship' => 'nullable|string|max:255',
            ]);
        } elseif ($userType === 'staff') {
            // Only admin can create staff
            if (!Auth::user()->isAdmin()) {
                abort(403);
            }
            $rules = array_merge($rules, [
                'position' => 'required|string|max:255',
                'department' => 'nullable|string|max:255',
                'employee_id' => 'nullable|string|max:255|unique:staff,employee_id',
                'employment_type' => 'required|in:full-time,part-time,contract',
                'hire_date' => 'nullable|date',
                'work_phone' => 'nullable|string|max:20',
                'work_email' => 'nullable|email|max:255',
            ]);
        }

        $validated = $request->validate($rules);

        $condoId = Auth::user()->isAdmin() 
            ? $validated['condominium_id'] 
            : Auth::user()->userable?->condominium_id;

        // Store plain password before hashing for email
        $plainPassword = $validated['password'];

        DB::beginTransaction();
        try {
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'] ?? null,
                'password' => Hash::make($validated['password']),
                'user_type' => $userType,
                'condo_id' => $condoId,
            ]);

            // Get condominium details
            $condominium = Condominium::find($condoId);

            if ($userType === 'resident') {
                // Create resident profile
                $resident = Resident::create([
                    'user_id' => $user->id,
                    'condominium_id' => $condoId,
                    'unit_number' => $validated['unit_number'],
                    'floor' => $validated['floor'] ?? null,
                    'residency_status' => $validated['residency_status'],
                    'move_in_date' => $validated['move_in_date'] ?? now(),
                    'number_of_occupants' => $validated['number_of_occupants'] ?? 1,
                    'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                    'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                    'emergency_contact_relationship' => $validated['emergency_contact_relationship'] ?? null,
                    'is_active' => true,
                ]);

                $user->update([
                    'userable_id' => $resident->id,
                    'userable_type' => Resident::class,
                ]);

                // Send resident credentials email
                try {
                    Mail::to($user->email)->send(
                        new ResidentCredentials(
                            $user, 
                            $plainPassword, 
                            $condominium,
                            $validated['unit_number']
                        )
                    );
                    
                    DB::commit();

                    return redirect()->route('profile.index')
                        ->with('success', 'Resident created successfully! Welcome email with login credentials has been sent to ' . $user->email);
                        
                } catch (\Exception $e) {
                    Log::error('Failed to send resident credentials email: ' . $e->getMessage());
                    
                    DB::commit();
                    
                    return redirect()->route('profile.index')
                        ->with('warning', 'Resident account created successfully, but failed to send email. Please provide credentials manually: ' . $user->email . ' / ' . $plainPassword);
                }

            } elseif ($userType === 'staff') {
                // Create staff profile
                $staff = Staff::create([
                    'user_id' => $user->id,
                    'condominium_id' => $condoId,
                    'position' => $validated['position'],
                    'department' => $validated['department'] ?? null,
                    'employee_id' => $validated['employee_id'] ?? 'EMP-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
                    'employment_type' => $validated['employment_type'],
                    'hire_date' => $validated['hire_date'] ?? now(),
                    'work_phone' => $validated['work_phone'] ?? null,
                    'work_email' => $validated['work_email'] ?? null,
                    'is_active' => true,
                ]);

                $user->update([
                    'userable_id' => $staff->id,
                    'userable_type' => Staff::class,
                ]);

                // Send staff credentials email
                try {
                    Mail::to($user->email)->send(
                        new StaffCredentials($user, $plainPassword, $condominium)
                    );
                    
                    DB::commit();

                    return redirect()->route('profile.index')
                        ->with('success', 'Staff member created successfully! Login credentials have been sent to their email.');
                        
                } catch (\Exception $e) {
                    Log::error('Failed to send staff credentials email: ' . $e->getMessage());
                    
                    DB::commit();
                    
                    return redirect()->route('profile.index')
                        ->with('warning', 'Staff account created successfully, but failed to send email. Please provide credentials manually: ' . $user->email . ' / ' . $plainPassword);
                }
            }

            DB::commit();

            return redirect()->route('profile.index')
                ->with('success', ucfirst($userType) . ' created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        $user = $request->user();
        $user->load('userable.condominium');
        
        // Load role-specific data
        $profileData = null;
        if ($user->userable) {
            $profileData = $user->userable;
        }

        return view('profile.show', [
            'user' => $user,
            'profileData' => $profileData,
        ]);
    }

    /**
     * Show the form for editing the authenticated user's own profile.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $user->load('userable.condominium');
        
        // Load role-specific data
        $profileData = null;
        if ($user->userable) {
            $profileData = $user->userable;
        }

        return view('profile.edit', [
            'user' => $user,
            'profileData' => $profileData,
        ]);
    }

    /**
     * Update the authenticated user's own profile.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        // Base validation rules for all users
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
        ];

        // Add resident-specific validation if user is a resident
        if ($user->isResident()) {
            $rules = array_merge($rules, [
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_phone' => 'nullable|string|max:20',
                'emergency_contact_relationship' => 'nullable|string|max:255',
            ]);
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            // Update user info
            $user->fill([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'] ?? null,
            ]);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            // Update resident-specific data if applicable
            if ($user->isResident() && $user->userable) {
                $user->userable->update([
                    'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                    'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                    'emergency_contact_relationship' => $validated['emergency_contact_relationship'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('profile.show')
                ->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Show form to edit a specific user's profile (Staff & Admin only)
     */
    public function editUser(User $user): View
    {
        $user->load('userable.condominium');
        
        // Staff can only edit users from their condo
        if (!Auth::user()->isAdmin()) {
            $authCondoId = Auth::user()->userable?->condominium_id;
            $userCondoId = $user->userable?->condominium_id;
            
            if ($authCondoId !== $userCondoId) {
                abort(403);
            }
        }

        // Staff cannot edit other staff or admin profiles
        if (!Auth::user()->isAdmin() && ($user->isStaff() || $user->isAdmin())) {
            abort(403);
        }

        // Only allow editing residents
        if (!$user->isResident()) {
            abort(403, 'Can only edit resident profiles from this page.');
        }

        $profileData = null;
        if ($user->userable) {
            $profileData = $user->userable;
        }

        return view('profile.edit-user', [
            'user' => $user,
            'profileData' => $profileData,
        ]);
    }

    /**
     * Update a specific user's profile (Staff & Admin only)
     */
    public function updateUser(Request $request, User $user): RedirectResponse
    {
        // Staff can only edit users from their condo
        if (!Auth::user()->isAdmin()) {
            $authCondoId = Auth::user()->userable?->condominium_id;
            $userCondoId = $user->userable?->condominium_id;
            
            if ($authCondoId !== $userCondoId) {
                abort(403);
            }
        }

        // Staff cannot edit other staff or admin profiles
        if (!Auth::user()->isAdmin() && ($user->isStaff() || $user->isAdmin())) {
            abort(403);
        }

        // Only allow editing residents
        if (!$user->isResident()) {
            abort(403);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'unit_number' => 'required|string|max:255',
            'floor' => 'nullable|string|max:255',
            'residency_status' => 'required|in:owner,tenant',
            'move_in_date' => 'nullable|date',
            'number_of_occupants' => 'nullable|integer|min:1|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            // Update user info
            $user->fill([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'] ?? null,
            ]);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            // Update resident data
            if ($user->userable) {
                $user->userable->update([
                    'unit_number' => $validated['unit_number'],
                    'floor' => $validated['floor'] ?? null,
                    'residency_status' => $validated['residency_status'],
                    'move_in_date' => $validated['move_in_date'] ?? $user->userable->move_in_date,
                    'number_of_occupants' => $validated['number_of_occupants'] ?? 1,
                    'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                    'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                    'emergency_contact_relationship' => $validated['emergency_contact_relationship'] ?? null,
                    'is_active' => $validated['is_active'] ?? true,
                ]);
            }

            DB::commit();

            return redirect()->route('profile.showUser', $user)
                ->with('success', 'Resident profile updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Delete a resident profile (Admin & Staff only)
     */
    public function deleteResident(Request $request, User $user): RedirectResponse
    {
        // Authorization check
        if (!Auth::user()->isAdmin() && !Auth::user()->isStaff()) {
            abort(403, 'Unauthorized action.');
        }

        // Staff can only delete residents from their condo
        if (!Auth::user()->isAdmin()) {
            $authCondoId = Auth::user()->userable?->condominium_id;
            $userCondoId = $user->userable?->condominium_id;
            
            if ($authCondoId !== $userCondoId) {
                abort(403, 'You can only delete residents from your condominium.');
            }
        }

        // Verify this is a resident
        if (!$user->isResident() || !$user->userable) {
            return back()->with('error', 'This user is not a resident or has no resident profile.');
        }

        // Validate deletion reason
        $validated = $request->validate([
            'deletion_reason' => 'required|string|min:10|max:1000',
        ]);

        $resident = $user->userable;
        
        DB::beginTransaction();
        try {
            // Store deletion record BEFORE deleting the resident
            $deletion = \App\Models\ResidentDeletion::create([
                'user_id' => $user->id,
                'resident_id' => $resident->id,
                'deleted_by' => Auth::id(),
                'condominium_id' => $resident->condominium_id,
                'resident_name' => $user->name,
                'resident_email' => $user->email,
                'unit_number' => $resident->unit_number,
                'floor' => $resident->floor,
                'deletion_reason' => $validated['deletion_reason'],
            ]);

            // Send deletion notice email
            try {
                Mail::to($user->email)->send(
                    new \App\Mail\ResidentDeletionMail(
                        userName: $user->name,
                        userEmail: $user->email,
                        unitNumber: $resident->unit_number,
                        condominiumName: $resident->condominium->name ?? 'Condominium',
                        deletionReason: $validated['deletion_reason'],
                        deletedBy: Auth::user()->name
                    )
                );
                
                // Update deletion record
                $deletion->update([
                    'email_sent' => true,
                    'email_sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                //
            }

            // Remove polymorphic relationship
            $user->update([
                'userable_id' => null,
                'userable_type' => null,
                'user_type' => null,
            ]);

            // Delete the resident profile
            $resident->delete();

            DB::commit();

            return redirect()->route('profile.index')
                ->with('success', 'Resident profile deleted successfully. Deletion notice has been sent to ' . $user->email);
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete resident profile: ' . $e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}