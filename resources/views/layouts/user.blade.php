<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPET Rental - User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            min-height: 100vh;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: white;
            width: 250px;
            padding: 20px;
            border-radius: 0 20px 20px 0;
            flex-shrink: 0;
        }
        .sidebar-item {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            color: #333;
            text-decoration: none;
            display: block;
            font-weight: 600;
        }
        .sidebar-item:hover, .sidebar-item.active {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: white;
        }
        .sidebar-item i {
            margin-right: 10px;
        }
        .main-content {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
            flex-grow: 1;
            min-height: 90vh;
        }
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                border-radius: 0 0 20px 20px;
                margin-bottom: 20px;
                padding: 15px;
            }
            .sidebar-item {
                display: inline-block;
                padding: 10px 15px;
                margin: 0 5px;
            }
            .sidebar .d-flex {
                flex-wrap: wrap;
                justify-content: center;
            }
            .main-content {
                margin: 0 10px 20px 10px;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="mb-4 text-center">
            <h4 class="fw-bold text-primary">OPET</h4>
        </div>
        <a href="{{ route('user.home') }}" class="sidebar-item active">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('user.booking') }}" class="sidebar-item">
            <i class="fas fa-book"></i> Booking
        </a>
        <a href="{{ route('user.riwayat') }}" class="sidebar-item">
            <i class="fas fa-history"></i> Riwayat Pesanan
        </a>
        <a href="{{ route('user.bantuan') }}" class="sidebar-item">
            <i class="fas fa-headset"></i> Bantuan
        </a>
        <a href="{{ route('user.profil') }}" class="sidebar-item">
            <i class="fas fa-user"></i> Profil
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="sidebar-item text-danger" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Footer -->
<footer class="mt-auto" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); color: white; padding: 40px 0 20px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">OPET Rental</h5>
                <p class="small">Optimal Performa Ekspres Transport</p>
                <p class="small">Solusi transportasi cepat, aman, dan terpercaya untuk kebutuhan Anda.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Kantor Pusat</h5>
                <p class="small">Jln. Boulevard, Washington DC, United States</p>
                <h5 class="fw-bold mt-3">Kantor Cabang</h5>
                <p class="small">Jl. Kolam, Kenangan Baru, Kabupaten Deli Serdang, Sumatera Utara</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Kontak</h5>
                <p class="small"><i class="fas fa-phone"></i> +62 896-XXXX-XXXX</p>
                <p class="small"><i class="fas fa-envelope"></i> admin@opet.com</p>
                <p class="small"><i class="fab fa-instagram"></i> @OpetRental_id</p>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.2);">
        <div class="text-center">
            <small>&copy; {{ date('Y') }} OPET Rental. All rights reserved.</small>
        </div>
    </div>
</footer>
</body>
</html>