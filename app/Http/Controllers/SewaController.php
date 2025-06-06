<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental;
use App\Models\Motor;
use Carbon\Carbon;

class SewaController extends Controller
{
    public function store(Motor $motor)
    {
        $user = Auth::user();

        Rental::create([
            'user_id' => $user->id,
            'motor_id' => $motor->id,
            'start_date' => Carbon::today(),
            'end_date' => Carbon::today()->addDays(1),
            'total_price' => $motor->harga_sewa,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pemesanan berhasil, menunggu konfirmasi kasir.');
    }
}
