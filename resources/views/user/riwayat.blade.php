@extends('layouts.user')

@section('content')
<!-- Div pembungkus dengan scroll vertikal -->
<div style="height: 85vh; overflow-y: auto; overflow-x: hidden; padding-right: 5px;">

    <h2 class="fw-bold text-primary mb-4">Riwayat Pesanan</h2>

    <div class="row">
        @foreach($bookings as $b)
        <div class="col-md-12 mb-3">
            <div class="card p-3 shadow-sm" style="background: white; border-radius: 15px;">
                <div class="row">
                    <div class="col-md-3">
                        @if($b->kendaraan->gambar)
                            <img src="{{ asset('storage/' . $b->kendaraan->gambar) }}" class="w-100" style="height: 150px; object-fit: cover; border-radius: 10px;">
                        @else
                            <div style="height: 150px; background: linear-gradient(135deg, #2563eb, #06b6d4); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-motorcycle" style="font-size: 80px; color: white;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h5 class="fw-bold text-primary">{{ $b->kendaraan->nama ?? 'Merk Kendaraan' }}</h5>
                        <p class="mb-1"><strong>Tanggal Pemakaian:</strong> {{ $b->tanggal_mulai }}</p>
                        <p class="mb-1"><strong>Tanggal Pengembalian:</strong> {{ $b->tanggal_selesai }}</p>
                        <p class="mb-1">
                            <strong>Status:</strong>
                            @if($b->status == 'pending' || $b->status == 'menunggu')
                                <span class="text-warning fw-bold">Menunggu Persetujuan</span>
                            @elseif($b->status == 'disetujui')
                                <span class="text-success fw-bold">Siap Diambil</span>
                            @elseif($b->status == 'selesai')
                                <span class="text-primary fw-bold">Selesai</span>
                            @else
                                <span class="text-danger fw-bold">Ditolak</span>
                            @endif
                        </p>

                        <!-- Tambahan: Rating dan Booking Ulang (hanya untuk status SELESAI) -->
                        @if($b->status == 'selesai')
                        <div class="mt-2">
                            <p class="mb-1"><strong>Rating :</strong></p>
                            <div class="mb-2 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <a href="#" class="btn btn-primary btn-sm">Booking Ulang</a>
                        </div>
                        @else
                        <!-- Jika belum selesai, tetap tampilkan tombol lihat detail -->
                        <a href="#" class="btn btn-primary btn-sm mt-2">Lihat Detail Kendaraan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection