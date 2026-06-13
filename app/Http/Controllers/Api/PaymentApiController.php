<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\OnoPayService;

class PaymentApiController extends Controller
{
    protected $onopay;

public function __construct(OnoPayService $onopay)
{
    $this->onopay = $onopay;
}

public function generateQr($id)
{
    $booking = Booking::findOrFail($id);

    if (!$booking->qr_code) {

        $response = $this->onopay->generateQR(
            $booking->total_harga,
            'Booking-' . $booking->id
        );

        if (
            isset($response['success']) &&
            $response['success']
        ) {

            $booking->qr_code =
                $response['data']['qr_code'];

            $booking->qr_image =
                'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' .
                $response['data']['qr_code'];

            $booking->save();
        }
    }

    return response()->json([
        'success' => true,
        'booking_id' => $booking->id,
        'qr_code' => $booking->qr_code,
        'qr_image' => $booking->qr_image,
    ]);
}
    public function uploadBukti(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $booking = Booking::findOrFail(
            $request->booking_id
        );

        $path = $request->file('bukti')
            ->store('pembayaran', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'metode' => 'QRIS',
            'bukti_pembayaran' => $path,
            'status' => 'pending'
        ]);

        $booking->status = 'menunggu';
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Bukti pembayaran berhasil diupload'
        ]);
    }
}