<?php

namespace App\Http\Controllers;

use App\Models\Motor;

class DashboardController extends Controller
{
    public function index()
    {
        $motors = Motor::all();
        return view('dashboard', compact('motors'));
    }
}
