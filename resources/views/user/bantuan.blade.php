@extends('layouts.user')

@section('content')
<h2 class="fw-bold text-primary mb-4">Pusat Bantuan</h2>

<div class="row">
    <div class="col-md-12">
        <div class="card p-4 shadow-sm">
            <form action="{{ route('user.bantuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. WhatsApp</label>
                    <input type="text" name="no_wa" class="form-control" placeholder="No. WhatsApp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Masalah</label>
                    <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan masalah Anda" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Bukti</label>
                    <input type="file" name="bukti" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim Laporan</button>
            </form>
        </div>
    </div>
</div>
@endsection