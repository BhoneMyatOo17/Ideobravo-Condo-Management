<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Parcel;
use App\Models\Resident;
use App\Models\Staff;
use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Main reports dashboard
     */
    public function index()
    {
        // Overview stats
        $stats = [
            'total_residents' => Resident::count(),
            'active_residents' => Resident::where('is_active', true)->count(),
            'total_staff' => Staff::count(),
            'total_condominiums' => Condominium::count(),
            'total_bills' => Bill::count(),
            'pending_bills' => Bill::where('status', 'pending')->count(),
            'total_parcels' => Parcel::count(),
            'pending_parcels' => Parcel::where('status', 'pending')->count(),
        ];

        // Revenue this month
        $stats['revenue_this_month'] = Bill::where('status', 'paid')
            ->whereMonth('paid_date', now()->month)
            ->whereYear('paid_date', now()->year)
            ->sum('amount');

        // Overdue bills
        $stats['overdue_bills'] = Bill::where('status', 'pending')
            ->where('due_date', '<', now())
            ->count();

        // Monthly revenue for last 6 months (for chart)
        $monthlyRevenue = Bill::where('status', 'paid')
            ->where('paid_date', '>=', now()->subMonths(6))
            ->selectRaw('YEAR(paid_date) as year, MONTH(paid_date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $revenueLabels = [];
        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenueLabels[] = $date->format('M Y');
            $found = $monthlyRevenue->first(function ($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            $revenueData[] = $found ? (float) $found->total : 0;
        }

        // Parcels by status (for pie chart)
        $parcelsByStatus = Parcel::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Bills by status (for pie chart)
        $billsByStatus = Bill::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Recent activity
        $recentBills = Bill::with('condominium')
            ->latest()
            ->take(5)
            ->get();

        $recentParcels = Parcel::with('condominium')
            ->latest()
            ->take(5)
            ->get();

        return view('reports.index', compact(
            'stats',
            'revenueLabels',
            'revenueData',
            'parcelsByStatus',
            'billsByStatus',
            'recentBills',
            'recentParcels'
        ));
    }

    /**
     * Bills report
     */
    public function bills(Request $request)
    {
        // Filter parameters
        $condominiumId = $request->get('condominium_id');
        $status = $request->get('status');
        $billType = $request->get('bill_type');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Summary stats
        $stats = [
            'total_bills' => Bill::count(),
            'total_amount' => Bill::sum('amount'),
            'paid_amount' => Bill::where('status', 'paid')->sum('amount'),
            'pending_amount' => Bill::where('status', 'pending')->sum('amount'),
            'overdue_count' => Bill::where('status', 'pending')->where('due_date', '<', now())->count(),
            'overdue_amount' => Bill::where('status', 'pending')->where('due_date', '<', now())->sum('amount'),
        ];

        // Bills by type (for bar chart)
        $billsByType = Bill::selectRaw('bill_type, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('bill_type')
            ->get();

        // Bills by status
        $billsByStatus = Bill::selectRaw('status, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('status')
            ->get();

        // Monthly trend (last 12 months)
        $monthlyTrend = Bill::where('created_at', '>=', now()->subMonths(12))
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $trendLabels = [];
        $trendCounts = [];
        $trendAmounts = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $trendLabels[] = $date->format('M Y');
            $found = $monthlyTrend->first(function ($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            $trendCounts[] = $found ? (int) $found->count : 0;
            $trendAmounts[] = $found ? (float) $found->total : 0;
        }

        // Payment methods breakdown
        $paymentMethods = Bill::where('status', 'paid')
            ->whereNotNull('payment_method')
            ->selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('payment_method')
            ->get();

        // Bills by condominium
        $billsByCondominium = Bill::with('condominium')
            ->selectRaw('condominium_id, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('condominium_id')
            ->get();

        // Filtered bills list
        $billsQuery = Bill::with(['condominium']);
        
        if ($condominiumId) {
            $billsQuery->where('condominium_id', $condominiumId);
        }
        if ($status) {
            $billsQuery->where('status', $status);
        }
        if ($billType) {
            $billsQuery->where('bill_type', $billType);
        }
        if ($dateFrom) {
            $billsQuery->whereDate('issue_date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $billsQuery->whereDate('issue_date', '<=', $dateTo);
        }

        $bills = $billsQuery->latest()->paginate(20);
        $condominiums = Condominium::orderBy('name')->get();

        return view('reports.bills', compact(
            'stats',
            'billsByType',
            'billsByStatus',
            'trendLabels',
            'trendCounts',
            'trendAmounts',
            'paymentMethods',
            'billsByCondominium',
            'bills',
            'condominiums'
        ));
    }

    /**
     * Parcels report
     */
    public function parcels(Request $request)
    {
        // Filter parameters
        $condominiumId = $request->get('condominium_id');
        $status = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Summary stats
        $stats = [
            'total_parcels' => Parcel::count(),
            'pending_parcels' => Parcel::where('status', 'pending')->count(),
            'notified_parcels' => Parcel::where('status', 'notified')->count(),
            'picked_up_parcels' => Parcel::where('status', 'picked_up')->count(),
            'today_received' => Parcel::whereDate('received_date', today())->count(),
            'today_picked_up' => Parcel::whereDate('picked_up_date', today())->count(),
        ];

        // Average pickup time (in hours)
        $avgPickupTime = Parcel::where('status', 'picked_up')
            ->whereNotNull('picked_up_date')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, received_date, picked_up_date)) as avg_hours')
            ->value('avg_hours');
        $stats['avg_pickup_hours'] = round($avgPickupTime ?? 0, 1);

        // Parcels by status (pie chart)
        $parcelsByStatus = Parcel::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Parcels by courier (bar chart)
        $parcelsByCourier = Parcel::selectRaw('courier_service, COUNT(*) as count')
            ->groupBy('courier_service')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Parcels by size
        $parcelsBySize = Parcel::selectRaw('parcel_size, COUNT(*) as count')
            ->groupBy('parcel_size')
            ->pluck('count', 'parcel_size')
            ->toArray();

        // Daily trend (last 30 days)
        $dailyTrend = Parcel::where('received_date', '>=', now()->subDays(30))
            ->selectRaw('DATE(received_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $dailyLabels = [];
        $dailyData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dailyLabels[] = now()->subDays($i)->format('M d');
            $dailyData[] = $dailyTrend[$date] ?? 0;
        }

        // Parcels by condominium
        $parcelsByCondominium = Parcel::with('condominium')
            ->selectRaw('condominium_id, COUNT(*) as total, SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending')
            ->groupBy('condominium_id')
            ->get();

        // Filtered parcels list
        $parcelsQuery = Parcel::with(['condominium', 'resident']);
        
        if ($condominiumId) {
            $parcelsQuery->where('condominium_id', $condominiumId);
        }
        if ($status) {
            $parcelsQuery->where('status', $status);
        }
        if ($dateFrom) {
            $parcelsQuery->whereDate('received_date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $parcelsQuery->whereDate('received_date', '<=', $dateTo);
        }

        $parcels = $parcelsQuery->latest()->paginate(20);
        $condominiums = Condominium::orderBy('name')->get();

        return view('reports.parcels', compact(
            'stats',
            'parcelsByStatus',
            'parcelsByCourier',
            'parcelsBySize',
            'dailyLabels',
            'dailyData',
            'parcelsByCondominium',
            'parcels',
            'condominiums'
        ));
    }

    /**
     * Residents report
     */
    public function residents(Request $request)
    {
        // Filter parameters
        $condominiumId = $request->get('condominium_id');
        $status = $request->get('status');

        // Summary stats
        $stats = [
            'total_residents' => Resident::count(),
            'active_residents' => Resident::where('is_active', true)->count(),
            'inactive_residents' => Resident::where('is_active', false)->count(),
            'new_this_month' => Resident::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        // Residents by status (pie chart)
        $residentsByStatus = [
        'active' => Resident::where('is_active', true)->count(),
        'inactive' => Resident::where('is_active', false)->count(),
            ];

        // Residents by condominium
        $residentsByCondominium = Resident::selectRaw('condominium_id, COUNT(*) as total, SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active')
            ->groupBy('condominium_id')
            ->with('condominium')
            ->get();

        // Monthly registrations (last 12 months)
        $monthlyRegistrations = Resident::where('created_at', '>=', now()->subMonths(12))
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $regLabels = [];
        $regData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $regLabels[] = $date->format('M Y');
            $found = $monthlyRegistrations->first(function ($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            $regData[] = $found ? (int) $found->count : 0;
        }

        // Occupancy by condominium
        $occupancyData = Condominium::withCount(['residents' => function ($query) {
            $query->where('is_active', true);
        }])->get()->map(function ($condo) {
            $occupancy = $condo->total_units > 0 
                ? round(($condo->residents_count / $condo->total_units) * 100, 1)
                : 0;
            return [
                'name' => $condo->name,
                'total_units' => $condo->total_units,
                'occupied' => $condo->residents_count,
                'occupancy_rate' => $occupancy,
            ];
        });

        // Filtered residents list
        $residentsQuery = Resident::with(['condominium', 'user']);
        
        if ($condominiumId) {
            $residentsQuery->where('condominium_id', $condominiumId);
        }
        if ($status) {
            $residentsQuery->where('is_active', $request->status === 'active');
        }

        $residents = $residentsQuery->latest()->paginate(20);
        $condominiums = Condominium::orderBy('name')->get();

        return view('reports.residents', compact(
            'stats',
            'residentsByStatus',
            'residentsByCondominium',
            'regLabels',
            'regData',
            'occupancyData',
            'residents',
            'condominiums'
        ));
    }
}