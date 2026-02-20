<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Bill;
use App\Models\Parcel;
use App\Models\Condominium;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('userable');
        
        // Get condominium ID
        $condominiumId = null;
        
        if ($user->userable && isset($user->userable->condominium_id)) {
            $condominiumId = $user->userable->condominium_id;
        }
        
        // Admin fallback
        if (!$condominiumId && $user->isAdmin()) {
            $condominium = Condominium::first();
            $condominiumId = $condominium?->id;
        }
        
        // Check if we have a condominium ID
        if (!$condominiumId) {
            abort(403, 'No condominium associated with this account. Please contact support.');
        }
        
        $condominium = Condominium::find($condominiumId);
        
        if (!$condominium) {
            abort(403, 'Condominium not found.');
        }
        
        // Get total count of active announcements
        $announcementCount = Announcement::where('condominium_id', $condominium->id)
            ->where('start_date', '<=', now())
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->count();
        
        // Get announcements for display (latest 2)
        $announcements = Announcement::where('condominium_id', $condominium->id)
            ->where('start_date', '<=', now())
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        
        $stats = [];
        
        if ($user->isResident()) {
            $resident = $user->userable;
            
            $stats = [
                'announcements' => [
                    'count' => $announcementCount,
                    'label' => 'New',
                ],
                'parcels' => [
                    'count' => Parcel::where('resident_id', $resident->id)
                                    ->whereIn('status', ['pending', 'notified'])
                                    ->count(),
                    'label' => 'Ready',
                ],
                'bills' => [
                    'count' => Bill::where('resident_id', $resident->id)
                                  ->where('status', 'pending')
                                  ->count(),
                    'label' => 'Pending',
                    'next_due' => Bill::where('resident_id', $resident->id)
                                     ->where('status', 'pending')
                                     ->orderBy('due_date', 'asc')
                                     ->first(),
                ],
            ];
        } else {
            // Staff/Admin stats
            $stats = [
                'announcements' => [
                    'count' => $announcementCount,
                    'label' => 'Active',
                ],
                'parcels' => [
                    'count' => Parcel::where('condominium_id', $condominium->id)
                                    ->whereIn('status', ['pending', 'notified'])
                                    ->count(),
                    'label' => 'Pending',
                ],
                'bills' => [
                    'count' => Bill::where('condominium_id', $condominium->id)
                                  ->where('status', 'pending')
                                  ->count(),
                    'label' => 'Unpaid',
                ],
            ];
        }
        
        return view('dashboard', compact('announcements', 'stats'));
    }
}