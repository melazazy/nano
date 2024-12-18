<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'phone' => '1234567890',
            'address' => '123 Admin Street',
            'country' => 'United States'
        ]);

        // Create Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => false,
            'phone' => '0987654321',
            'address' => '456 User Avenue',
            'country' => 'United States'
        ]);

        // Create Additional Test Users
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => false,
            'phone' => '5555555555',
            'address' => '789 Test Road',
            'country' => 'United States'
        ]);
    }
}