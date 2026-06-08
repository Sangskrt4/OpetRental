@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
            <!-- Header Profil -->
            <div class="card-header bg-gradient-primary text-white p-5" style="background: linear-gradient(135deg, #2563eb, #06b6d4);">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="position-relative d-inline-block">
                            @if($user->foto_profil)
                                <img src="{{ asset('storage/' . $user->foto_profil) }}" class="rounded-circle border border-4 border-white shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center mx-auto shadow" style="width: 180px; height: 180px;">
                                    <i class="fas fa-user text-primary" style="font-size: 80px;"></i>
                                </div>
                            @endif
                            <button class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle shadow" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <h3 class="fw-bold mt-3 text-white">{{ $user->name }}</h3>
                        <span class="badge bg-white text-primary">{{ $user->role == 'admin' ? 'Admin' : 'User' }}</span>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="text-white-50 small">Email</div>
                                <div class="text-white fw-bold">{{ $user->email }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="text-white-50 small">No. WhatsApp</div>
                                <div class="text-white fw-bold">{{ $user->no_wa ?? '-' }}</div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-white-50 small">Alamat</div>
                                <div class="text-white fw-bold">{{ $user->alamat ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body Profil -->
            <div class="card-body p-5">
                <!-- Toggle Edit Profil -->
                <div class="mb-3">
                    <button class="btn btn-primary" id="toggleEditBtn">
                        <i class="fas fa-pen"></i> Edit Profil
                    </button>
                </div>

                <div id="editProfilForm" class="collapse">
                    <h5 class="fw-bold text-primary mb-4">Edit Profil</h5>
                    <form action="{{ route('user.profil.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">No. WhatsApp</label>
                                <input type="text" class="form-control" value="{{ $user->no_wa ?? '-' }}" readonly disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $user->alamat) }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                    </form>
                </div>

                <hr>
                <!-- Toggle Keamanan -->
                <div class="mb-3">
                    <button class="btn btn-warning" id="toggleSecurityBtn">
                        <i class="fas fa-lock"></i> Keamanan
                    </button>
                </div>

                <div id="keamananForm" class="collapse">
                    <h5 class="fw-bold text-primary mt-3">Keamanan</h5>
                    <form action="{{ route('user.profil.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password Lama</label>
                                <input type="password" name="current_password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Konfirmasi password baru">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Foto -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Upload Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.profil.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto</label>
                        <input type="file" name="photo" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle Edit Profil dengan Bootstrap Collapse
    document.getElementById('toggleEditBtn').addEventListener('click', function() {
        const target = document.getElementById('editProfilForm');
        const bsCollapse = new bootstrap.Collapse(target, {
            toggle: true
        });
        // Ubah teks tombol
        if (target.classList.contains('show')) {
            this.innerHTML = '<i class="fas fa-times"></i> Tutup Edit Profil';
        } else {
            this.innerHTML = '<i class="fas fa-pen"></i> Edit Profil';
        }
    });

    // Toggle Keamanan dengan Bootstrap Collapse
    document.getElementById('toggleSecurityBtn').addEventListener('click', function() {
        const target = document.getElementById('keamananForm');
        const bsCollapse = new bootstrap.Collapse(target, {
            toggle: true
        });
        // Ubah teks tombol
        if (target.classList.contains('show')) {
            this.innerHTML = '<i class="fas fa-times"></i> Tutup Keamanan';
        } else {
            this.innerHTML = '<i class="fas fa-lock"></i> Keamanan';
        }
    });
</script>
@endsection