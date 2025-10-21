<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        
        // You can add more customer users if needed
        User::create([
            'name' => 'Regular Customer',
            'email' => 'regular@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        
        // More sample customers
        User::create([
            'name' => 'VIP Customer',
            'email' => 'vip@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}