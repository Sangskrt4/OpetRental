@extends('layouts.admin')

@section('content')
<h2 class="text-center fw-bold mb-4">Data Kendaraan</h2>

<div class="mb-3">
    <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">+ Tambah Kendaraan</a>
    <a href="{{ route('admin.kendaraan.index') }}?jenis=motor" class="btn btn-secondary">Motor</a>
    <a href="{{ route('admin.kendaraan.index') }}?jenis=mobil" class="btn btn-secondary">Mobil</a>
    <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Semua</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>No Plat</th>
            <th>Tahun</th>
            <th>Warna</th>
            <th>CC</th>
            <th>Transmisi</th>
            <th>Harga Sewa</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kendaraan as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($k->gambar)
                    <img src="{{ asset('storage/' . $k->gambar) }}" width="80" height="80" style="object-fit: cover;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>{{ $k->nama }}</td>
            <td>{{ $k->no_plat }}</td>
            <td>{{ $k->tahun }}</td>
            <td>{{ $k->warna }}</td>
            <td>{{ $k->cc }}</td>
            <td>{{ $k->transmisi }}</td>
            <td>Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}</td>
            <td>{{ $k->status }}</td>
            <td>
                <a href="{{ route('admin.kendaraan.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.kendaraan.destroy', $k->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection