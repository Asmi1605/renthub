<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Rental;
use App\Models\Wallet;
use App\Models\Transaction;

class UserDashboardController extends Controller
{
  
    
    public function index()
    {
        $user = Auth::user();
    
        $upcomingCount = Booking::where('user_id', $user->id)
                                ->where('status', 'upcoming')
                                ->count();
    
        $completedCount = Booking::where('user_id', $user->id)
                                 ->where('status', 'completed')
                                 ->count();
    
        $rentals = Rental::latest()->take(8)->get();
    
        // Dynamic wallet balance
        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $walletBalance = $wallet->balance;
    
        // Fetch 5 recent transactions
        $recentTransactions = Transaction::where('wallet_id', $wallet->id)
                                         ->latest()
                                         ->take(5)
                                         ->get();
    
        return view('user.dashboard', compact(
            'upcomingCount',
            'completedCount',
            'rentals',
            'walletBalance',
            'recentTransactions'
        ));
    }
}
