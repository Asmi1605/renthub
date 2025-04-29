<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Rental;

class UserDashboardController extends Controller
{
    /**
     * Display the user's dashboard with stats and rental previews.
     */
    public function index()
    {
        $user = Auth::user();

        $upcomingCount = Booking::where('user_id', $user->id)
                                ->where('status', 'upcoming')
                                ->count();

        $completedCount = Booking::where('user_id', $user->id)
                                 ->where('status', 'completed')
                                 ->count();

        $rentals = Rental::latest()->take(8)->get(); // Adjust limit as needed

        // Wallet & transactions can be integrated here in the future
        $recentTransactions = []; // Placeholder for now

        return view('user.dashboard', compact(
            'upcomingCount',
            'completedCount',
            'rentals',
            'recentTransactions'
        ));
    }
}
