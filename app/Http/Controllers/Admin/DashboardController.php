<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooking = Booking::count();
        $pendapatanHariIni = Booking::whereDate('created_at', today())->sum('total_harga');
        $unitTersedia = Kendaraan::where('status', 'Tersedia')->count();
        $unitDisewa = Kendaraan::where('status', 'Disewa')->count();
        $pendapatan7Hari = Booking::where('created_at', '>=', now()->subDays(7))->sum('total_harga');

        return view('admin.dashboard', compact(
            'totalBooking',
            'pendapatanHariIni',
            'unitTersedia',
            'unitDisewa',
            'pendapatan7Hari'
        ));
    }
}