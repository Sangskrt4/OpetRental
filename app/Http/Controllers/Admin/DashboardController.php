<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode
        $periode = $request->periode ?? '7hari';
        $startDate = $this->getStartDate($periode);

        // Data untuk card
        $totalBooking = Booking::count();
        $pendapatanHariIni = Booking::whereDate('created_at', today())->sum('total_harga');
        $unitTersedia = Kendaraan::where('status', 'Tersedia')->count();
        $unitDisewa = Kendaraan::where('status', 'Disewa')->count();

        // Data grafik realtime
        $grafikData = $this->getGrafikData($startDate);

        return view('admin.dashboard', compact(
            'totalBooking',
            'pendapatanHariIni',
            'unitTersedia',
            'unitDisewa',
            'grafikData',
            'periode'
        ));
    }

    private function getStartDate($periode)
    {
        return match($periode) {
            '1hari' => now()->subDay(),
            '3hari' => now()->subDays(3),
            '7hari' => now()->subDays(7),
            '1bulan' => now()->subMonth(),
            '3bulan' => now()->subMonths(3),
            default => now()->subDays(7),
        };
    }

    private function getGrafikData($startDate)
    {
        $dates = [];
        $totals = [];

        // Loop dari startDate sampai hari ini
        for ($date = clone $startDate; $date <= now(); $date->addDay()) {
            $dates[] = $date->format('d/m');
            $totals[] = Booking::whereDate('created_at', $date)->sum('total_harga');
        }

        return [
            'labels' => $dates,
            'data' => $totals,
        ];
    }
}