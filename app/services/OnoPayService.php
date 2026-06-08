<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OnoPayService
{
    protected $baseUrl;
    protected $adminPhone;

    public function __construct()
    {
        $this->baseUrl = 'https://onopay.web.id/api/v1';
        $this->adminPhone = config('onopay.admin_phone', '089690260348');
    }

    public function generateQR($amount, $orderId, $description = 'Pembayaran Rental OPET')
    {
        $response = Http::post($this->baseUrl . '/payment/qr/generate', [
            'phone_number' => $this->adminPhone,
            'amount' => $amount,
            'description' => $description,
            'qr_mode' => 'single_use'
        ]);

        return $response->json();
    }

    public function payQR($qrCode, $payerPhone)
    {
        $response = Http::post($this->baseUrl . '/payment/qr/pay', [
            'qr_code' => $qrCode,
            'payer_phone' => $payerPhone,
        ]);

        return $response->json();
    }

    public function checkStatus($qrCode)
    {
        // Real API (jika endpoint check tersedia)
        // $response = Http::get($this->baseUrl . '/payment/qr/check/' . $qrCode);
        // return $response->json();

        // Dummy response (pending)
        return [
            'success' => true,
            'data' => [
                'status' => 'pending'
            ]
        ];
    }
}