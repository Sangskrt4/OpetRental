@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Laporan</h2>

<div class="row">
    @foreach($laporans as $l)
    <div class="col-md-12 mb-3">
        <div class="card p-3 shadow-sm">
            <div class="row">
                <div class="col-md-2">
                    <div style="background: linear-gradient(135deg, #2563eb, #06b6d4); border-radius: 10px; padding: 20px; color: white; text-align: center;">
                        @if($l->foto_bukti)
                            <img src="{{ asset('storage/' . $l->foto_bukti) }}" class="w-100" style="height: 100px; object-fit: cover; border-radius: 10px;">
                        @else
                            <i class="fas fa-image" style="font-size: 40px;"></i>
                            <p class="small mt-2">Foto Bukti</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-10">
                    <h5 class="fw-bold text-primary">{{ $l->user->name ?? 'User' }}</h5>
                    <p><strong>No. WhatsApp:</strong> {{ $l->no_wa }}</p>
                    <p><strong>Deskripsi:</strong> {{ $l->deskripsi }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $l->status == 'Selesai' ? 'bg-success' : 'bg-warning' }}">
                            {{ $l->status ?? 'Belum Ditangani' }}
                        </span>
                    </p>

                    <div class="mt-2">
                        <!-- Edit Status -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $l->id }}">
                            <i class="fas fa-edit"></i> Edit Status
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('admin.laporan.destroy', $l->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Status -->
    <div class="modal fade" id="editModal{{ $l->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.laporan.update', $l->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Status Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Belum Ditangani" {{ $l->status == 'Belum Ditangani' ? 'selected' : '' }}>Belum Ditangani</option>
                                <option value="Sudah Ditangani" {{ $l->status == 'Sudah Ditangani' ? 'selected' : '' }}>Sudah Ditangani</option>
                                <option value="Selesai" {{ $l->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection