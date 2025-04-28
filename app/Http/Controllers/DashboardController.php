<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats
        $totalUsers = User::count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::sum('price');
    
        // Recent Rentals
        $recentRentals = Rental::latest()->take(5)->get();
    
        // Top Vendors
        $topVendors = User::where('role', 'vendor')
                          ->withCount('rentals')
                          ->orderBy('rentals_count', 'desc')
                          ->take(3)
                          ->get();
    
        // Monthly Earnings for Chart
        $monthlyEarningsRaw = Rental::selectRaw('MONTH(created_at) as month, SUM(price) as total')
                                    ->groupBy('month')
                                    ->pluck('total', 'month')
                                    ->toArray();
    
        $monthNames = [];
        $finalEarnings = [];
        foreach (range(1, 12) as $m) {
            $monthNames[] = date('F', mktime(0, 0, 0, $m, 1));
            $finalEarnings[] = $monthlyEarningsRaw[$m] ?? 0;
        }
    
        return view('admin.dashboard', compact(
            'totalUsers', 'totalVendors', 'totalRentals', 'totalEarnings',
            'recentRentals', 'topVendors', 'monthNames', 'finalEarnings'
        ));
    }
    
    
}
