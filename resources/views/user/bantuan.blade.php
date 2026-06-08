@extends('layouts.user')

@section('content')
<h2 class="fw-bold text-primary mb-4">Pusat Bantuan</h2>

<div class="row">
    <div class="col-md-12">
        <!-- Form Laporan -->
        <div id="formLaporan" class="card p-4 shadow-sm">
            <form id="formBantuan" action="{{ route('user.bantuan.store') }}" method="POST" enctype="multipart/form-data">
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
                <button type="button" class="btn btn-primary w-100" onclick="submitForm()">Kirim Laporan</button>
            </form>
        </div>

        <!-- Sukses (muncul setelah kirim) -->
        <div id="suksesLaporan" class="card p-4 shadow-sm text-center" style="display: none;">
            <div style="font-size: 80px; color: #22c55e;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h4 class="fw-bold text-success mt-2">Laporan Berhasil Dikirim!</h4>
            <p class="text-muted">Terima kasih, laporan Anda telah kami terima. Mohon tunggu respon dari admin.</p>
            <a href="{{ route('user.home') }}" class="btn btn-primary mt-3 w-100">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        const form = document.getElementById('formBantuan');
        const formData = new FormData(form);

        fetch('{{ route('user.bantuan.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Form hilang, ganti dengan halaman sukses
                document.getElementById('formLaporan').style.display = 'none';
                document.getElementById('suksesLaporan').style.display = 'block';
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection