<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Common Dashboard (after login, we will auto-redirect properly later)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (for all logged-in users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect after login based on role
Route::get('/redirect', [RedirectController::class, 'index'])->middleware('auth');



// ====================
// Admin Protected Routes
// ====================
Route::middleware(['auth', 'rolecheck:admin'])->prefix('admin')->name('admin.')->group(function () {
    
 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Manage Users
  
    Route::get('/manage-users', [UserController::class, 'manageUsers'])->name('manage-users');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update-user');
    
    
    // Manage Vendors
    Route::get('/manage-vendors', [UserController::class, 'manageVendors'])->name('manage-vendors');



    // Manage Rentals/Items
    Route::get('/manage-rentals', [RentalController::class, 'index'])->name('manage-rentals');

    // (Optional) Settings
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');

});

// ====================
// Vendor Protected Routes
// ====================
Route::middleware(['auth', 'rolecheck:vendor'])->group(function () {
    Route::get('/vendor/dashboard', function () {
        return view('vendor.dashboard');
    });
});

// ====================
// User Protected Routes
// ====================
Route::middleware(['auth', 'rolecheck:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/user/bookings', [BookingController::class, 'index'])->name('user.bookings');
    Route::get('/user/booking/{id}', [BookingController::class, 'show'])->name('user.booking.details');
    
    Route::get('/user/wallet', function () {
        return view('user.wallet');  // Adjust the view name as needed
    })->name('user.wallet');

    Route::get('/user/profile', function () {
        return view('user.profile');  // Adjust the view name as needed
    })->name('user.profile');
    
    Route::get('/user/items', [RentalController::class, 'userRentals'])->name('user.items');
    Route::get('/user/items/{id}', [RentalController::class, 'show'])->name('user.items.details');
    Route::get('/user/items/book', function () {
        return view('user.items.book');  // Adjust the view name as needed
    })->name('user.items.book');

    Route::get('/user/items/category', function () {
        return view('user.items.category');  // Adjust the view name as needed
    })->name('user.items.category');
    
    Route::get('/user/reviews', function () {
        return view('user.reviews');  // Adjust the view name as needed
    })->name('user.reviews');
    
    Route::get('/user/refunds', function () {
        return view('user.refunds');  // Adjust the view name as needed
    })->name('user.refunds');
    
    Route::get('/user/notifications', function () {
        return view('user.notifications');  // Adjust the view name as needed
    })->name('user.notifications'); 
    
    Route::get('/user/settings', function () {
        return view('user.settings');  // Adjust the view name as needed
    })->name('user.settings');

    Route::get('/checkout/{rental}', [BookingController::class, 'checkout'])->name('checkout');
    Route::post('/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/success/{id}', [BookingController::class, 'success'])->name('booking.success');
});


// Auth routes (login, register, forgot password etc.)
require __DIR__.'/auth.php';
