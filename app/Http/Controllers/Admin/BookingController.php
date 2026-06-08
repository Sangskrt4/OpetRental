<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'kendaraan'])->orderBy('created_at', 'desc')->get();
        return view('admin.booking.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'kendaraan'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status,
            'catatan_penolakan' => $request->catatan_penolakan,
        ]);

        // TAMBAHKAN INI 👇 (Increment total_dipesan jika disetujui)
        if ($request->status == 'disetujui') {
            $booking->kendaraan->increment('total_dipesan');
        }

        return redirect()->route('admin.booking.index')->with('success', 'Status booking berhasil diperbarui');
    }

    // --- TAMBAHKAN METHOD INI DI BAWAH UPDATE ---
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dihapus');
    }
}