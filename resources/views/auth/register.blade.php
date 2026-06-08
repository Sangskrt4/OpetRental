<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - OPET Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 500px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .register-card h3 {
            color: #2563eb;
            font-weight: bold;
            text-align: center;
        }
        .register-card .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        .register-card .btn-primary {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
        }
        .register-card .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h3 class="mb-4">Daftar Akun</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Nama Pengguna baru" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Kata sandi" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang kata sandi" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Login</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>