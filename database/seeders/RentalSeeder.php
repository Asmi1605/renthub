<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rental;

class RentalSeeder extends Seeder
{
    public function run()
    {
        Rental::create([
            'title' => 'Canon EOS 90D DSLR Camera',
            'vendor_id' => 2,
            'category' => 'Electronics',
            'price' => 1200.00,
            'status' => 'active',
            'description' => 'The Canon EOS 90D DSLR camera offers high-resolution imaging with a 32.5MP sensor, 4K video recording, and impressive autofocus capabilities. Perfect for professional shoots, events, and creative projects.',
            'images' => json_encode([
                'https://via.placeholder.com/800x500?text=Product+Image+1',
                'https://via.placeholder.com/800x500?text=Product+Image+2',
                'https://via.placeholder.com/800x500?text=Product+Image+3',
            ]),
            'tags' => json_encode(['#Camera', '#DSLR']),
        ]);

        Rental::create([
            'title' => 'Luxury Villa in Goa',
            'vendor_id' => 3,
            'category' => 'Villa',
            'price' => 5000.00,
            'status' => 'active',
            'description' => 'Experience luxury living near the beaches of Goa. Perfect for weekend getaways and family vacations.',
            'images' => json_encode([
                'https://via.placeholder.com/800x500?text=Villa+1',
                'https://via.placeholder.com/800x500?text=Villa+2'
            ]),
            'tags' => json_encode(['#Villa', '#Beachfront']),
        ]);

        Rental::create([
            'title' => 'Modern Apartment in Bangalore',
            'vendor_id' => 2,
            'category' => 'Apartment',
            'price' => 2500.00,
            'status' => 'active',
            'description' => 'A fully-furnished apartment in the heart of Bangalore. Ideal for working professionals and short stays.',
            'images' => json_encode([
                'https://via.placeholder.com/800x500?text=Apartment+1',
                'https://via.placeholder.com/800x500?text=Apartment+2'
            ]),
            'tags' => json_encode(['#CityLife', '#Furnished']),
        ]);
    }
}
