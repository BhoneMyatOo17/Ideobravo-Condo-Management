<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements
     */
    public function index(Request $request)
    {
        $query = Announcement::with(['creator', 'condominium']);

        // Filter by user's condominium based on role
        if (Auth::user()->isResident()) {
            // Residents: only see their condo's announcements
            $residentCondoId = Auth::user()->userable?->condominium_id;
            
            if ($residentCondoId) {
                $query->where('condominium_id', $residentCondoId);
                
                $today = now()->toDateString();
                
                // RESIDENTS: Hide draft announcements (not yet published)
                $query->where('start_date', '<=', $today);
                
                // RESIDENTS: Hide expired announcements
                $query->where(function($q) use ($today) {
                    $q->whereNull('end_date')
                      ->orWhere('end_date', '>=', $today);
                });
            } else {
                // If no condo found, show no announcements
                $query->whereRaw('1 = 0');
            }
        } elseif (Auth::user()->isStaff()) {
            // Staff with condo_id: only see their condo's announcements
            $staffCondoId = Auth::user()->userable?->condominium_id;
            
            if ($staffCondoId) {
                $query->where('condominium_id', $staffCondoId);
            }
            // If no condo_id, don't apply filter (show all)
        }
        // Admin: see all announcements including expired and draft ones (no filter applied)

        // Filter by search (title or description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by status (only for staff and admin)
        if ($request->filled('status') && !Auth::user()->isResident()) {
            $today = now()->toDateString();
            
            if ($request->status == 'published') {
                $query->where('start_date', '<=', $today)
                      ->where(function($q) use ($today) {
                          $q->whereNull('end_date')
                            ->orWhere('end_date', '>=', $today);
                      });
            } elseif ($request->status == 'draft') {
                $query->where('start_date', '>', $today);
            } elseif ($request->status == 'expired') {
                $query->whereNotNull('end_date')
                      ->where('end_date', '<', $today);
            }
        }

        // Sort by latest
        $query->latest('created_at');

        $announcements = $query->paginate(12);

        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new announcement
     */
    public function create()
    {
        // Get all condominiums for the dropdown
        $condominiums = Condominium::all();

        return view('announcements.create', compact('condominiums'));
    }

    /**
     * Store a newly created announcement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:important,event,maintenance,update,new,eco,security,community',
            'priority' => 'required|in:normal,high,urgent,low',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'send_email' => 'nullable|boolean',
            'send_push' => 'nullable|boolean',
            'target_audience' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'condominium_id' => 'required|exists:condominiums,id',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['send_email'] = $request->has('send_email');
        $validated['send_push'] = $request->has('send_push');
        $validated['target_audience'] = $validated['target_audience'] ?? 'all';

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        Announcement::create($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully!');
    }

    /**
     * Display the specified announcement
     */
    public function show(Announcement $announcement)
    {
        // Check access permissions
        if (Auth::user()->isResident()) {
            // Residents: only their condo
            $residentCondoId = Auth::user()->userable?->condominium_id;
            
            if ($announcement->condominium_id != $residentCondoId) {
                abort(403, 'Unauthorized access to this announcement.');
            }
            
            // RESIDENTS: Cannot view draft announcements (not yet published)
            if (!$announcement->isPublished()) {
                abort(403, 'This announcement is not yet published.');
            }
            
            // RESIDENTS: Cannot view expired announcements
            if ($announcement->isExpired()) {
                abort(403, 'This announcement has expired and is no longer available.');
            }
        } elseif (Auth::user()->isStaff()) {
            // Staff with condo_id: only their condo
            $staffCondoId = Auth::user()->userable?->condominium_id;
            
            if ($staffCondoId && $announcement->condominium_id != $staffCondoId) {
                abort(403, 'Unauthorized access to this announcement.');
            }
            // STAFF: Can view draft and expired announcements
        }
        // Admin: can access all including draft and expired (no check needed)

        $announcement->load(['creator', 'condominium']);
        
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified announcement
     */
    public function edit(Announcement $announcement)
    {
        // Check edit permissions
        if (Auth::user()->isResident()) {
            // Residents cannot edit announcements
            abort(403, 'Residents cannot edit announcements.');
        } elseif (Auth::user()->isStaff()) {
            // Staff with condo_id: only edit their condo's announcements
            // Staff without condo_id: can edit all
            $staffCondoId = Auth::user()->userable?->condominium_id;
            
            if ($staffCondoId && $announcement->condominium_id != $staffCondoId) {
                abort(403, 'You can only edit announcements from your condominium.');
            }
        }
        // Admin: can edit all

        $condominiums = Condominium::all();
        
        return view('announcements.edit', compact('announcement', 'condominiums'));
    }

    /**
     * Update the specified announcement
     */
    public function update(Request $request, Announcement $announcement)
    {
        // Check update permissions
        if (Auth::user()->isResident()) {
            abort(403, 'Residents cannot update announcements.');
        } elseif (Auth::user()->isStaff()) {
            $staffCondoId = Auth::user()->userable?->condominium_id;
            
            if ($staffCondoId && $announcement->condominium_id != $staffCondoId) {
                abort(403, 'You can only update announcements from your condominium.');
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:important,event,maintenance,update,new,eco,security,community',
            'priority' => 'required|in:normal,high,urgent,low',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'send_email' => 'nullable|boolean',
            'send_push' => 'nullable|boolean',
            'target_audience' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'condominium_id' => 'required|exists:condominiums,id',
        ]);

        $validated['send_email'] = $request->has('send_email');
        $validated['send_push'] = $request->has('send_push');
        $validated['target_audience'] = $validated['target_audience'] ?? 'all';

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully!');
    }

    /**
     * Remove the specified announcement
     */
    public function destroy(Announcement $announcement)
    {
        // Check delete permissions
        if (Auth::user()->isResident()) {
            abort(403, 'Residents cannot delete announcements.');
        } elseif (Auth::user()->isStaff()) {
            $staffCondoId = Auth::user()->userable?->condominium_id;
            
            if ($staffCondoId && $announcement->condominium_id != $staffCondoId) {
                abort(403, 'You can only delete announcements from your condominium.');
            }
        }

        // Delete image if exists
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully!');
    }
}