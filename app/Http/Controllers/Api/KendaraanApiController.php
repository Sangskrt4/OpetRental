<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class KendaraanApiController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::where('status', 'Tersedia')
            ->orderBy('total_dipesan', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $kendaraan
        ]);
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $kendaraan
        ]);
    }
}