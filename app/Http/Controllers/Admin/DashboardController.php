<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Total booking (semua status)
        $totalBooking = Booking::count();

        // Pendapatan Hari Ini (JOIN payments + bookings)
        $pendapatanHariIni = Payment::where('payments.status', 'verified')
            ->whereDate('payments.created_at', Carbon::today())
            ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
            ->sum('bookings.total_harga');

        // Jika tidak ada data, set ke 0
        if (!$pendapatanHariIni) {
            $pendapatanHariIni = 0;
        }

        // Unit Tersedia
        $unitTersedia = Kendaraan::where('status', 'Tersedia')->count();

        // ✅ UNIT DISEWA (OPSI 1 - Semua booking yang sudah disetujui)
        $unitDisewa = Booking::where('status', 'disetujui')->count();

        // Data pendapatan per periode (JOIN payments + bookings)
        $periodeData = [
            '1 Hari (Hari Ini)' => Payment::where('payments.status', 'verified')
                ->whereDate('payments.created_at', Carbon::today())
                ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
                ->sum('bookings.total_harga'),

            '3 Hari Terakhir' => Payment::where('payments.status', 'verified')
                ->whereDate('payments.created_at', '>=', now()->subDays(3))
                ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
                ->sum('bookings.total_harga'),

            '7 Hari Terakhir' => Payment::where('payments.status', 'verified')
                ->whereDate('payments.created_at', '>=', now()->subDays(7))
                ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
                ->sum('bookings.total_harga'),

            '1 Bulan Terakhir' => Payment::where('payments.status', 'verified')
                ->whereDate('payments.created_at', '>=', now()->subMonth())
                ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
                ->sum('bookings.total_harga'),

            '3 Bulan Terakhir' => Payment::where('payments.status', 'verified')
                ->whereDate('payments.created_at', '>=', now()->subMonths(3))
                ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
                ->sum('bookings.total_harga'),
        ];

        $totalSemua = Payment::where('payments.status', 'verified')
            ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
            ->sum('bookings.total_harga');

        return view('admin.dashboard', compact(
            'totalBooking',
            'pendapatanHariIni',
            'unitTersedia',
            'unitDisewa',
            'periodeData',
            'totalSemua'
        ));
    }
}