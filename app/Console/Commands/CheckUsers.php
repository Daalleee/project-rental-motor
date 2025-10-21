<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUsers extends Command
{
    protected $signature = 'check:users';
    protected $description = 'Check if users were created properly';

    public function handle()
    {
        $users = User::all();
        $this->info('Total users: ' . $users->count());
        
        foreach ($users as $user) {
            $this->info('Name: ' . $user->name . ', Email: ' . $user->email . ', Role: ' . $user->role);
        }
    }
}