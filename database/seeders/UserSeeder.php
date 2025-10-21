<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@rental.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Cashier User
        User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@rental.com',
            'password' => Hash::make('cashier123'),
            'role' => 'kasir',
        ]);

        // Create Customer/User
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@rental.com',
            'password' => Hash::make('customer123'),
            'role' => 'user',
        ]);
    }
}