<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\KendaraanApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\PaymentApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/update-profile', [AuthApiController::class, 'updateProfile']);
Route::post('/change-password', [AuthApiController::class, 'changePassword']);

Route::get('/kendaraan', [KendaraanApiController::class, 'index']);
Route::get('/kendaraan/{id}', [KendaraanApiController::class, 'show']);

Route::post('/booking', [BookingApiController::class, 'store']);
Route::get('/booking/history/{userId}',[BookingApiController::class, 'history']);

Route::post('/upload-bukti', [PaymentApiController::class, 'uploadBukti']);
Route::post('/generate-qr/{id}', [PaymentApiController::class, 'generateQr']);