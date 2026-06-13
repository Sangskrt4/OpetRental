<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kendaraan;
use Carbon\Carbon;

class BookingApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'kendaraan_id' => 'required',
            'nama' => 'required',
            'no_ktp' => 'required',
            'no_sim' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tanggal_pemakaian' => 'required|date',
            'jaminan' => 'required',
            'paket' => 'required|integer'
        ]);

        $kendaraan = Kendaraan::findOrFail(
            $request->kendaraan_id
        );

        $totalHarga =
            $kendaraan->harga_sewa *
            $request->paket;

       $bookingId = DB::table('bookings')->insertGetId([
            'user_id' => $request->user_id,

            'kendaraan_id' =>
                $request->kendaraan_id,

            'tanggal_mulai' =>
                $request->tanggal_pemakaian,

            'tanggal_selesai' =>
                Carbon::parse(
                    $request->tanggal_pemakaian
                )->addDays($request->paket),

            'total_harga' =>
                $totalHarga,

            'status' => 'menunggu',

            'nama' => $request->nama,
            'no_ktp' => $request->no_ktp,
            'no_sim' => $request->no_sim,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jaminan' => $request->jaminan,

            'status_penyewa' => 'Ready',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
    'success' => true,
    'message' => 'Booking berhasil',
    'booking_id' => $bookingId
]);
    }
    
    public function history($userId){
    $bookings = \App\Models\Booking::with('kendaraan')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $bookings
    ]);
}
}