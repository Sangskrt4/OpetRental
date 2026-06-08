@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Data Kendaraan</h2>
    <div>
        <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kendaraan
        </a>
    </div>
</div>

<div class="mb-3">
    <div class="btn-group" role="group">
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-outline-primary active">Semua</a>
        <a href="{{ route('admin.kendaraan.index') }}?jenis=motor" class="btn btn-outline-primary">Motor</a>
        <a href="{{ route('admin.kendaraan.index') }}?jenis=mobil" class="btn btn-outline-primary">Mobil</a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>No Plat</th>
                        <th>Tahun</th>
                        <th>Warna</th>
                        <th>CC</th>
                        <th>Transmisi</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraan as $k)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td>
                            @if($k->gambar)
                                <img src="{{ asset('storage/' . $k->gambar) }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fas fa-car text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $k->nama }}</td>
                        <td>{{ $k->no_plat }}</td>
                        <td>{{ $k->tahun }}</td>
                        <td><span class="badge bg-secondary">{{ $k->warna }}</span></td>
                        <td>{{ $k->cc }}</td>
                        <td>{{ $k->transmisi }}</td>
                        <td>Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}</td>
                        <td>
                            @if($k->status == 'Tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Disewa</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.kendaraan.edit', $k->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.kendaraan.destroy', $k->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection