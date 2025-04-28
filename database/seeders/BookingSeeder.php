<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Rental;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $rental1 = Rental::first(); // Get the first rental
        $rental2 = Rental::skip(1)->first(); // Get the second rental

        if ($rental1 && $rental2) {
            // Add dummy bookings for User 1
            Booking::create([
                'user_id' => 1,
                'rental_id' => $rental1->id,
                'status' => 'upcoming',
                'total_price' => 1500.00,
                'start_date' => Carbon::now()->addDays(1),
                'end_date' => Carbon::now()->addDays(3),
            ]);

            Booking::create([
                'user_id' => 1,
                'rental_id' => $rental2->id,
                'status' => 'upcoming',
                'total_price' => 1200.00,
                'start_date' => Carbon::now()->addDays(5),
                'end_date' => Carbon::now()->addDays(7),
            ]);

            Booking::create([
                'user_id' => 1,
                'rental_id' => $rental1->id,
                'status' => 'completed',
                'total_price' => 800.00,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->subDays(8),
            ]);

            Booking::create([
                'user_id' => 1,
                'rental_id' => $rental2->id,
                'status' => 'canceled',
                'total_price' => 500.00,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->subDays(4),
            ]);
        } else {
            echo "Rentals not found. Please seed rentals first.\n";
        }
    }
}
