<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    // Constructor
    public function __construct()
    {
        // Avoid middleware here unless necessary
    }

    /**
     * Display all bookings for the authenticated user (Upcoming, Completed, Canceled)
     */
    public function index()
    {
        $user = Auth::user();

        $upcomingBookings = $user->bookings()->where('status', 'upcoming')->get();
        $completedBookings = $user->bookings()->where('status', 'completed')->get();
        $canceledBookings = $user->bookings()->where('status', 'canceled')->get();

        return view('user.bookings.index', compact('upcomingBookings', 'completedBookings', 'canceledBookings'));
    }

    /**
     * Show the details of a specific booking
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('user.bookings.details', compact('booking'));
    }

    /**
     * Show the checkout page for a rental with date range (from/to)
     */
    public function checkout(Request $request, Rental $rental)
    {
        $dateRange = $request->query('dates'); // Expecting format: "2025-05-01 to 2025-05-03"
    
        $startDate = $endDate = null;
        $days = 0;
        $totalPrice = 0;
    
        try {
            if ($dateRange) {
                $parts = explode(' to ', $dateRange);
                if (count($parts) === 2) {
                    $startDate = Carbon::parse($parts[0]);
                    $endDate = Carbon::parse($parts[1]);
    
                    if ($startDate->gte($endDate)) {
                        throw new \Exception('Invalid date range');
                    }
    
                    $days = $startDate->diffInDays($endDate) ?: 1;
                    $totalPrice = $days * $rental->price;
                } else {
                    throw new \Exception('Date format incorrect');
                }
            }
        } catch (\Exception $e) {
            $startDate = $endDate = null;
            $days = 0;
            $totalPrice = 0;
        }
    
        return view('checkout', compact('rental', 'startDate', 'endDate', 'days', 'totalPrice'));
    }
    

    /**
     * Handle booking form submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'from' => 'required|date|before:to',
            'to' => 'required|date|after:from',
            'price' => 'required|numeric|min:1',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'rental_id' => $request->rental_id,
            'start_date' => Carbon::parse($request->from),
            'end_date' => Carbon::parse($request->to),
            'total_price' => $request->price,
            'status' => 'upcoming',
        ]);
        

        return redirect()->route('booking.success', ['id' => $booking->id]);
    }

    /**
     * Booking success confirmation page
     */
    public function success($id)
    {
        $booking = Booking::with('rental')->findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('booking-success', compact('booking'));
    }
}
