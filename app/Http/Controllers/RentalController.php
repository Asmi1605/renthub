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
}
