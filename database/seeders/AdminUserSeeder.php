<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // You can add more admin users if needed
        User::create([
            'name' => 'System Admin',
            'email' => 'system@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}