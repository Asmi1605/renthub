<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    // Admin View
    public function index()
    {
        $rentals = Rental::with('vendor')->latest()->get();
        return view('admin.manage-rentals', compact('rentals'));
    }

    // Vendor View - List their own items
    public function userRentals()
    {
        $rentals = Rental::where('vendor_id', Auth::id())->latest()->get();
        return view('user.items.index', compact('rentals'));
    }

    // Show details
    public function show($id)
    {
        $rental = Rental::with('vendor')->findOrFail($id);
        return view('user.items.details', compact('rental'));
    }

    // Show create form
    public function create()
    {
        return view('vendor.items.create');
    }

    // Save new item
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'tags' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'price_day' => 'required|numeric',
            'price_week' => 'nullable|numeric',
            'price_month' => 'nullable|numeric',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('rentals', 'public');
                $images[] = $filename;
            }
        }

        Rental::create([
            'title' => $request->title,
            'vendor_id' => Auth::id(),
            'category' => $request->category,
            'description' => $request->description,
            'tags' => explode(',', $request->tags),
            'images' => $images,
            'price_day' => $request->price_day,
            'price_week' => $request->price_week,
            'price_month' => $request->price_month,
            'status' => 'active',
        ]);

        return redirect()->route('user.rentals')->with('success', 'Rental item added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $rental = Rental::where('vendor_id', Auth::id())->findOrFail($id);
        return view('user.items.edit', compact('rental'));
    }

    // Update item
    public function update(Request $request, $id)
    {
        $rental = Rental::where('vendor_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'tags' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'price_day' => 'required|numeric',
            'price_week' => 'nullable|numeric',
            'price_month' => 'nullable|numeric',
        ]);

        $images = $rental->images ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('rentals', 'public');
                $images[] = $filename;
            }
        }

        $rental->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'tags' => explode(',', $request->tags),
            'images' => $images,
            'price_day' => $request->price_day,
            'price_week' => $request->price_week,
            'price_month' => $request->price_month,
        ]);

        return redirect()->route('user.rentals')->with('success', 'Rental item updated.');
    }

    // Delete rental
    public function destroy($id)
    {
        $rental = Rental::where('vendor_id', Auth::id())->findOrFail($id);

        // Delete images from storage
        if ($rental->images) {
            foreach ($rental->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $rental->delete();
        return redirect()->back()->with('success', 'Rental item deleted.');
    }


    public function Vendordashboard()
{
    $vendorId = Auth::id();

    $totalItems = Rental::where('vendor_id', $vendorId)->count();
    $pendingBookings = Booking::whereHas('rental', fn($q) => $q->where('vendor_id', $vendorId))
                              ->where('status', 'pending')->count();
    $monthlyEarnings = Booking::whereHas('rental', fn($q) => $q->where('vendor_id', $vendorId))
                              ->whereMonth('created_at', now()->month)
                              ->where('status', 'accepted')
                              ->sum('total_price');
    $wallet = Auth::user()->wallet_balance ?? 0;

    $recentBookings = Booking::with('rental')
                             ->whereHas('rental', fn($q) => $q->where('vendor_id', $vendorId))
                             ->latest()->take(5)->get();

    $recentItems = Rental::where('vendor_id', $vendorId)->latest()->take(5)->get();

    return view('vendor.dashboard', compact(
        'totalItems',
        'pendingBookings',
        'monthlyEarnings',
        'wallet',
        'recentBookings',
        'recentItems'
    ));
}



public function myRentalsVendors()
{
    $vendor = auth()->user();
    $items = Rental::where('vendor_id', $vendor->id)->latest()->paginate(10); // Adjust per your table structure

    return view('vendor.items.rentals', compact('items'));
}


public function editVendorItem($id)
{
    $item = Rental::findOrFail($id);
    return view('vendor.items.edit', compact('item'));
}

// Update rental item
public function updateVendorItem(Request $request, $id)
{
    $item = Rental::findOrFail($id);

    // Validate the form input
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
        'images' => 'nullable|array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image uploads
    $images = $item->images ? json_decode($item->images, true) : [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('rental_images', 'public');
            $images[] = asset('storage/' . $imagePath);
        }
    }

    // Update rental item
    $item->update([
        'title' => $request->title,
        'category' => $request->category,
        'status' => $request->status,
        'images' => json_encode($images),
    ]);

    return redirect()->route('vendor.items.rentals')->with('success', 'Rental item updated successfully.');
}

}
