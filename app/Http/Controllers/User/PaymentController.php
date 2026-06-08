<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\OnoPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    protected $onopay;

    public function __construct(OnoPayService $onopay)
    {
        $this->onopay = $onopay;
    }

    public function index()
    {
        // Debug: cek apakah halaman payment diakses
        // dd('Halaman payment berhasil diakses');

        $booking = Booking::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->first();

        if (!$booking) {
            return redirect()->route('user.home')->with('error', 'Tidak ada booking pending.');
        }

        $response = $this->onopay->generateQR(
            $booking->total_harga,
            'Booking-' . $booking->id
        );

        if ($response['success']) {
            $booking->qr_code = $response['data']['qr_code'];
            $booking->qr_image = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . $response['data']['qr_code'];
            $booking->save();
        }

        return view('user.payment', compact('booking'));
    }

    public function upload()
    {
        $booking = Booking::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->first();

        return view('user.upload', compact('booking'));
    }

    public function storeBukti(Request $request)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        $path = $request->file('bukti')->store('pembayaran', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'metode' => 'QRIS',
            'bukti_pembayaran' => $path,
            'status' => 'pending'
        ]);

        $booking->status = 'menunggu';
        $booking->save();

        return redirect()->route('user.payment.confirmation', $booking->id);
    }

    public function confirmation($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.confirmation', compact('booking'));
    }

    public function checkStatus($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json([
            'status' => $booking->status
        ]);
    }
}