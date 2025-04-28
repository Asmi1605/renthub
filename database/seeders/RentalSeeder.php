<?php
namespace Database\Seeders; 
use Illuminate\Database\Seeder;
use App\Models\Rental;
use App\Models\User;

class RentalSeeder extends Seeder
{
    public function run()
    {
        // Create dummy rental data
        Rental::create([
            'title' => 'Luxury Villa in Goa',
            'vendor_id' => 2, // Assuming vendor with ID 1 exists
            'category' => 'Villa',
            'price' => 5000.00,
            'status' => 'active',
        ]);

        Rental::create([
            'title' => 'Beachfront Cottage in Kerala',
            'vendor_id' => 4, // Assuming vendor with ID 1 exists
            'category' => 'Cottage',
            'price' => 3000.00,
            'status' => 'active',
        ]);

        Rental::create([
            'title' => 'Modern Apartment in Bangalore',
            'vendor_id' => 2, // Assuming vendor with ID 2 exists
            'category' => 'Apartment',
            'price' => 2500.00,
            'status' => 'active',
        ]);

        // Add more rentals if needed
    }
}
