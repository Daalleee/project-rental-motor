<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CashierUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@example.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
        
        // You can add more cashier users if needed
        User::create([
            'name' => 'Main Cashier',
            'email' => 'maincashier@example.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
    }
}