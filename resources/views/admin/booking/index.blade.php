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

<div class="row" style="max-height: 600px; overflow-y: auto;">
    @foreach($bookings as $b)
    <div class="col-md-12 mb-3">
        <div class="card p-3 shadow-sm" style="background: linear-gradient(135deg, #2563eb, #06b6d4); color: white;">
            <div class="row">
                <div class="col-md-1 text-center">
                    <span class="badge bg-light text-dark">{{ $loop->iteration }}</span>
                </div>
                <div class="col-md-1">
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        @if($b->kendaraan && $b->kendaraan->jenis == 'Motor')
                            <i class="fas fa-motorcycle" style="font-size: 30px; color: white;"></i>
                        @elseif($b->kendaraan && $b->kendaraan->jenis == 'Mobil')
                            <i class="fas fa-car" style="font-size: 30px; color: white;"></i>
                        @else
                            <i class="fas fa-question-circle" style="font-size: 30px; color: white;"></i>
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
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $b->id }}" style="margin-left: 10px;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal{{ $b->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus booking ini?</p>
                    <p><strong>{{ $b->kendaraan->nama ?? 'Kendaraan' }}</strong> - {{ $b->user->name ?? 'User' }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.booking.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection