<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - OPET Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .login-card h3 {
            color: #2563eb;
            font-weight: bold;
        }
        .login-card .form-control {
            border-radius: 8px;
            padding: 12px;
            background: #e9ecef;
            border: none;
        }
        .login-card .btn-primary {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: bold;
            width: 100%;
        }
        .login-card .btn-primary:hover {
            opacity: 0.9;
        }
        .logo-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .logo-section h1 {
            font-weight: 900;
            font-size: 3.5rem;
        }
        .logo-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .logo-section .sub {
            font-size: 1rem;
            opacity: 0.7;
        }
        .admin-login {
            position: absolute;
            bottom: 30px;
            left: 30px;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-login:hover {
            opacity: 0.8;
        }
        /* UPDATE LOGO STYLE */
        .logo-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            object-fit: cover;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .logo-img:hover {
            transform: scale(1.05);
        }
        @media (max-width: 768px) {
            .logo-section {
                margin-bottom: 30px;
            }
            .logo-img {
                width: 140px;
                height: 140px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="row align-items-center">
        <!-- LOGO SECTION (KIRI) -->
        <div class="col-md-6 logo-section">
            <!-- Ganti src dengan file logo OPET Anda -->
            <img src="{{ asset('logo-opet.png') }}" alt="OPET Logo" class="logo-img">
            <h1>OPET</h1>
            <p><strong>Optimal Performa Ekspres Transport</strong></p>
            <p class="sub">"Solusi Transportasi Anda, Cepat & Terpercaya."</p>
        </div>

        <!-- LOGIN FORM (KANAN) -->
        <div class="col-md-6">
            <div class="login-card">
                <h3 class="mb-4">Login - Signup</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Masukan Username / Email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">MASUK</button>

                    <div class="mt-3 text-center">
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary">Belum punya akun? Register sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>