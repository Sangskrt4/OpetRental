<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['booking.user', 'booking.kendaraan'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.payment.index', compact('payments'));
    }

    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'verified';
        $payment->save();

        $payment->booking->status = 'disetujui';
        $payment->booking->save();

        return redirect()->route('admin.payment.index')->with('success', 'Pembayaran diverifikasi');
    }

    public function reject($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'rejected';
        $payment->save();

        return redirect()->route('admin.payment.index')->with('error', 'Pembayaran ditolak');
    }
}