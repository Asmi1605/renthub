<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Booking;
use Carbon\Carbon;

class VendorDashboardController extends Controller
{
    public function index()
    {
        // Fetch total items (items added by the vendor)
        $totalItems = Item::where('user_id', auth()->id())->count();

        // Fetch pending bookings
        $pendingBookings = Booking::where('user_id', auth()->id())
                                  ->where('status', 'pending')
                                  ->count();

        // Fetch this month's earnings from completed bookings (assuming 'amount' is a field in the Booking model)
        $monthlyEarnings = Booking::where('user_id', auth()->id())
                                  ->where('status', 'completed') // Assuming "completed" means paid
                                  ->whereMonth('created_at', Carbon::now()->month)
                                  ->sum('amount'); // Sum of the 'amount' field in Booking model

        // Fetch wallet balance (if stored in User model or another table)
        $wallet = auth()->user()->wallet_balance; // Assuming wallet balance is stored on the User model

        // Fetch top-selling items based on bookings (assuming each booking represents a rental)
        $topSellingItems = Item::where('user_id', auth()->id())
                               ->withCount('bookings')  // Assuming 'bookings' relationship exists in Item model
                               ->orderBy('bookings_count', 'desc')
                               ->take(5)
                               ->get();

        // Fetch booking trends for the past week (count of bookings per day)
        $bookingTrends = Booking::selectRaw('DATE(created_at) as day, count(*) as bookings')
                                ->where('user_id', auth()->id())
                                ->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])
                                ->groupBy('day')
                                ->orderBy('day', 'asc')
                                ->get();

        // Fetch recent bookings
        $recentBookings = Booking::where('user_id', auth()->id())
                                 ->latest()
                                 ->take(5)
                                 ->get();

        // Fetch recently added items
        $recentItems = Item::where('user_id', auth()->id())
                           ->latest()
                           ->take(5)
                           ->get();

        // Pass data to the view
        return view('vendor.dashboard', [
            'totalItems' => $totalItems,
            'pendingBookings' => $pendingBookings,
            'monthlyEarnings' => $monthlyEarnings,
            'wallet' => $wallet,
            'topSellingItems' => $topSellingItems,
            'bookingTrends' => $bookingTrends,
            'recentBookings' => $recentBookings,
            'recentItems' => $recentItems,
        ]);
    }
}
