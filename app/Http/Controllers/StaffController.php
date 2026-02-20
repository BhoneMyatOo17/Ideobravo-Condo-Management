<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Condominium;
use App\Mail\StaffCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    /**
     * Display a listing of staff
     */
    public function index(Request $request)
    {
        $query = Staff::with(['user', 'condominium']);

        // Admin sees all staff, staff sees only their condo
        if (!Auth::user()->isAdmin()) {
            $query->where('condominium_id', Auth::user()->condo_id);
        }

        // Filter by active/inactive
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filter by condominium
        if ($request->has('condominium_id') && $request->condominium_id) {
            $query->where('condominium_id', $request->condominium_id);
        }

        // Filter by department
        if ($request->has('department') && $request->department) {
            $query->where('department', $request->department);
        }

        // Filter by employment type
        if ($request->has('employment_type') && $request->employment_type) {
            $query->where('employment_type', $request->employment_type);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('employee_id', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $staff = $query->orderBy('position')->paginate(20);

        // Calculate stats based on user role
        if (Auth::user()->isAdmin()) {
            $stats = [
                'total' => Staff::count(),
                'active' => Staff::where('is_active', true)->count(),
                'full_time' => Staff::where('employment_type', 'full-time')->count(),
                'part_time' => Staff::where('employment_type', 'part-time')->count(),
            ];
        } else {
            $stats = [
                'total' => Staff::where('condominium_id', Auth::user()->condo_id)->count(),
                'active' => Staff::where('condominium_id', Auth::user()->condo_id)->where('is_active', true)->count(),
                'full_time' => Staff::where('condominium_id', Auth::user()->condo_id)->where('employment_type', 'full-time')->count(),
                'part_time' => Staff::where('condominium_id', Auth::user()->condo_id)->where('employment_type', 'part-time')->count(),
            ];
        }

        // Get condominiums for filter dropdown
        $condominiums = Condominium::orderBy('name')->get();

        return view('staff.index', compact('staff', 'stats', 'condominiums'));
    }

    /**
     * Show the form for creating a new staff member
     */
    public function create()
    {
        $condominiums = Condominium::orderBy('name')->get();
        return view('staff.create', compact('condominiums'));
    }

    /**
     * Store a newly created staff member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:255',
            'condominium_id' => 'nullable|exists:condominiums,id',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'employee_id' => 'nullable|string|max:255|unique:staff,employee_id',
            'hire_date' => 'nullable|date',
            'employment_type' => 'required|in:full-time,part-time,contract',
            'work_phone' => 'nullable|string|max:255',
            'work_email' => 'nullable|email',
        ]);

        // Store the plain password before hashing for email
        $plainPassword = $validated['password'];

        DB::beginTransaction();
        try {
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone_number' => $validated['phone_number'] ?? null,
                'condo_id' => $validated['condominium_id'] ?? null,
                'user_type' => 'staff',
            ]);

            // Create staff profile
            $staff = Staff::create([
                'user_id' => $user->id,
                'condominium_id' => $validated['condominium_id'] ?? null,
                'position' => $validated['position'],
                'department' => $validated['department'] ?? null,
                'employee_id' => $validated['employee_id'] ?? 'EMP-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
                'hire_date' => $validated['hire_date'] ?? now(),
                'employment_type' => $validated['employment_type'],
                'work_phone' => $validated['work_phone'] ?? null,
                'work_email' => $validated['work_email'] ?? null,
                'is_active' => true,
            ]);

            // Update user polymorphic relationship
            $user->update([
                'userable_id' => $staff->id,
                'userable_type' => Staff::class,
            ]);

            // Get condominium details if assigned
            $condominium = $validated['condominium_id'] 
                ? Condominium::find($validated['condominium_id']) 
                : null;

            // Send credentials email
            try {
                Mail::to($user->email)->send(new StaffCredentials($user, $plainPassword, $condominium));
                
                DB::commit();

                return redirect()->route('staff.index')
                    ->with('success', 'Staff member created successfully! Login credentials have been sent to their email.');
                    
            } catch (\Exception $e) {
                // Log the error but don't fail the entire operation
                Log::error('Failed to send staff credentials email: ' . $e->getMessage());
                
                DB::commit();
                
                return redirect()->route('staff.index')
                    ->with('warning', 'Staff account created successfully, but failed to send email. Please provide credentials manually: ' . $user->email . ' / ' . $plainPassword);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to create staff: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified staff member
     */
   public function show(Staff $staff)
    {
        // Load relationships
        $staff->load(['user', 'condominium']);
        
        // Get all condominiums for the dropdown/display
        $condominiums = Condominium::orderBy('name')->get();
        
        return view('staff.show', compact('staff', 'condominiums'));
    }

    /**
     * Show the form for editing the staff member
     */
    public function edit(Staff $staff)
    {
        // Check permissions
        if (!Auth::user()->isAdmin() && $staff->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        $staff->load('user', 'condominium');
        $condominiums = Condominium::orderBy('name')->get();

        return view('staff.edit', compact('staff', 'condominiums'));
    }

    /**
     * Update the specified staff member
     */
    public function update(Request $request, Staff $staff)
    {
        // Check permissions
        if (!Auth::user()->isAdmin() && $staff->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->user_id,
            'phone_number' => 'nullable|string|max:255',
            'condominium_id' => 'nullable|exists:condominiums,id',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'employee_id' => 'nullable|string|max:255|unique:staff,employee_id,' . $staff->id,
            'hire_date' => 'nullable|date',
            'employment_type' => 'required|in:full-time,part-time,contract',
            'work_phone' => 'nullable|string|max:255',
            'work_email' => 'nullable|email',
            'is_active' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            // Update user
            $staff->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'] ?? null,
                'condo_id' => $validated['condominium_id'] ?? null,
            ]);

            // Update staff profile
            $staff->update([
                'condominium_id' => $validated['condominium_id'] ?? null,
                'position' => $validated['position'],
                'department' => $validated['department'] ?? null,
                'employee_id' => $validated['employee_id'] ?? $staff->employee_id,
                'hire_date' => $validated['hire_date'],
                'employment_type' => $validated['employment_type'],
                'work_phone' => $validated['work_phone'] ?? null,
                'work_email' => $validated['work_email'] ?? null,
                'is_active' => $validated['is_active'],
            ]);

            DB::commit();

            return redirect()->route('staff.index')
                ->with('success', 'Staff member updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to update staff: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified staff member
     */
    public function destroy(Staff $staff)
    {
        // Check permissions
        if (!Auth::user()->isAdmin() && $staff->condominium_id !== Auth::user()->condo_id) {
            abort(403);
        }

        DB::beginTransaction();
        try {
            $user = $staff->user;
            $staff->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('staff.index')
                ->with('success', 'Staff member deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete staff: ' . $e->getMessage());
        }
    }
}