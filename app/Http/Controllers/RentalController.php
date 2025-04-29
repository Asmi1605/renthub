<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('vendor')->latest()->get();
        return view('admin.manage-rentals', compact('rentals'));
    }

    // 👇 Add this new method properly here
    public function userRentals()
    {
        $rentals = Rental::with('vendor')->latest()->get();
        return view('user.items.index', compact('rentals'));
    }


    public function show($id)
    {
        $rental = Rental::with('vendor')->findOrFail($id);
        return view('user.items.details', compact('rental'));
    }
}
