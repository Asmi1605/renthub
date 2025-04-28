<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Constructor should not have middleware for auth directly here
    public function __construct()
    {
        // Do not use middleware here, unless needed for specific actions
    }

    // Display all bookings for the authenticated user (Upcoming, Completed, Canceled)
    public function index()
    {
        $user = Auth::user();  // Get the authenticated user

        // Fetch the bookings for the user
        $upcomingBookings = $user->bookings()->where('status', 'upcoming')->get();
        $completedBookings = $user->bookings()->where('status', 'completed')->get();
        $canceledBookings = $user->bookings()->where('status', 'canceled')->get();

        // Return the view with the bookings data
        return view('user.bookings.index', compact('upcomingBookings', 'completedBookings', 'canceledBookings'));
    }

    // Show the details of a specific booking
    public function show($id)
    {
        $booking = Booking::findOrFail($id);  // Find booking by ID

        // Return the view with booking details
        return view('user.bookings.details', compact('booking'));
    }
}
