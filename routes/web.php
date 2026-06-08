<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\PenyewaController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;

Route::get('/', function () {
    return redirect('/login');
});

// Route Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Kendaraan
    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('admin.kendaraan.index');
    Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name('admin.kendaraan.create');
    Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('admin.kendaraan.store');
    Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('admin.kendaraan.edit');
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])->name('admin.kendaraan.update');
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('admin.kendaraan.destroy');

    // Penyewa
    Route::get('/penyewa', [PenyewaController::class, 'index'])->name('admin.penyewa.index');
    Route::get('/penyewa/create', [PenyewaController::class, 'create'])->name('admin.penyewa.create');
    Route::post('/penyewa', [PenyewaController::class, 'store'])->name('admin.penyewa.store');
    Route::get('/penyewa/{id}', [PenyewaController::class, 'show'])->name('admin.penyewa.show');
    Route::get('/penyewa/{id}/edit', [PenyewaController::class, 'edit'])->name('admin.penyewa.edit');
    Route::put('/penyewa/{id}', [PenyewaController::class, 'update'])->name('admin.penyewa.update');
    Route::delete('/penyewa/{id}', [PenyewaController::class, 'destroy'])->name('admin.penyewa.destroy');

    // Booking
    Route::get('/booking', [BookingController::class, 'index'])->name('admin.booking.index');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('admin.booking.show');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('admin.booking.update');

    // Payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('admin.payment.index');
    Route::get('/payment/verify/{id}', [PaymentController::class, 'verify'])->name('admin.payment.verify');
    Route::get('/payment/reject/{id}', [PaymentController::class, 'reject'])->name('admin.payment.reject');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('admin.laporan.update');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');

    // Profil Admin
    Route::get('/profil', [AdminController::class, 'profil'])->name('admin.profil');
    Route::post('/profil/update', [AdminController::class, 'updateProfil'])->name('admin.profil.update');
    Route::post('/profil/upload-photo', [AdminController::class, 'uploadPhoto'])->name('admin.profil.upload');

    // Data User (CRUD)
    Route::get('/data-user', [AdminController::class, 'dataUser'])->name('admin.data-user');
    Route::get('/data-user/create', [AdminController::class, 'createUser'])->name('admin.data-user.create');
    Route::post('/data-user', [AdminController::class, 'storeUser'])->name('admin.data-user.store');
    Route::get('/data-user/{id}/edit', [AdminController::class, 'editUser'])->name('admin.data-user.edit');
    Route::put('/data-user/{id}', [AdminController::class, 'updateUser'])->name('admin.data-user.update');
    Route::delete('/data-user/{id}', [AdminController::class, 'destroyUser'])->name('admin.data-user.destroy');
});

// Route untuk User
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('/home', [UserController::class, 'home'])->name('user.home');
    Route::get('/kendaraan/{id}', [UserController::class, 'detail'])->name('user.kendaraan.detail');
    Route::get('/kategori/{kategori}', [UserController::class, 'kategori'])->name('user.kategori');
    Route::get('/booking', [UserController::class, 'booking'])->name('user.booking');
    Route::post('/booking/create', [UserController::class, 'createBooking'])->name('user.booking.create');
    Route::post('/booking/store', [UserController::class, 'storeBooking'])->name('user.booking.store');
    Route::get('/invoice', [UserController::class, 'invoice'])->name('user.invoice');
    Route::post('/invoice/confirm', [UserController::class, 'confirmBooking'])->name('user.invoice.confirm');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
    Route::get('/bantuan', [UserController::class, 'bantuan'])->name('user.bantuan');
    Route::post('/bantuan', [UserController::class, 'storeBantuan'])->name('user.bantuan.store');
    Route::get('/riwayat-bantuan', [UserController::class, 'riwayatBantuan'])->name('user.riwayat-bantuan');

    // Payment User
    Route::get('/payment', [UserPaymentController::class, 'index'])->name('user.payment');
    Route::get('/upload', [UserPaymentController::class, 'upload'])->name('user.upload');
    Route::post('/upload', [UserPaymentController::class, 'storeBukti'])->name('user.upload.store');
    Route::get('/confirmation/{id}', [UserPaymentController::class, 'confirmation'])->name('user.payment.confirmation');
    Route::get('/check-status/{id}', [UserPaymentController::class, 'checkStatus'])->name('user.payment.check'); // Tambahkan ini

    // Profil User
    Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
    Route::post('/profil/update', [UserController::class, 'updateProfil'])->name('user.profil.update');
    Route::post('/profil/upload-photo', [UserController::class, 'uploadPhoto'])->name('user.profil.upload');
});