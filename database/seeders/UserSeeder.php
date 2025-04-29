<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Creating an Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Hash the password
            'role' => 'admin',
        ]);

        // Creating 2 regular Users
        User::create([
            'name' => 'Regular User 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('user123'), // Hash the password
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('user123'), // Hash the password
            'role' => 'user',
        ]);

        // Creating 2 Vendor users
        User::create([
            'name' => 'Vendor User 1',
            'email' => 'vendor1@example.com',
            'password' => Hash::make('vendor123'), // Hash the password
            'role' => 'vendor',
        ]);

        User::create([
            'name' => 'Vendor User 2',
            'email' => 'vendor2@example.com',
            'password' => Hash::make('vendor123'), // Hash the password
            'role' => 'vendor',
        ]);
    }
}
