@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Data Booking</h2>

<!-- Filter Status -->
<div class="mb-4">
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="#">Semua</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menunggu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Disetujui</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ditolak</a>
        </li>
    </ul>
</div>

<div class="row">
    @foreach($bookings as $b)
    <div class="col-md-12 mb-3">
        <div class="card p-3 shadow-sm" style="background: linear-gradient(135deg, #2563eb, #06b6d4); color: white;">
            <div class="row">
                <div class="col-md-2">
                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        @if($b->kendaraan->jenis == 'Motor')
                            <i class="fas fa-motorcycle" style="font-size: 40px; color: white;"></i>
                        @else
                            <i class="fas fa-car" style="font-size: 40px; color: white;"></i>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h5 class="fw-bold">{{ $b->kendaraan->nama ?? 'Kendaraan' }}</h5>
                    <p class="mb-1">{{ $b->user->name ?? 'User' }}</p>
                    <p class="mb-1">{{ $b->tanggal_mulai }} - {{ $b->tanggal_selesai }}</p>
                    <p class="mb-1">
                        <strong>Status: </strong>
                        @if($b->status == 'menunggu')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($b->status == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($b->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">{{ $b->status }}</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-end">
                    <a href="{{ route('admin.booking.show', $b->id) }}" class="btn btn-light">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection