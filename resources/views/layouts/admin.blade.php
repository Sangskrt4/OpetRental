<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPET Rental - Admin</title>
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
        .sidebar {
            background: white;
            min-height: 100vh;
            border-radius: 0 20px 20px 0;
            padding: 20px;
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
            min-height: 90vh;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-2 p-0">
            <div class="sidebar">
                <div class="mb-4 text-center">
                    <h4 class="fw-bold">OPET</h4>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('admin.kendaraan.index') }}" class="sidebar-item">
                    <i class="fas fa-car"></i> Data Kendaraan
                </a>
                <a href="{{ route('admin.penyewa.index') }}" class="sidebar-item">
                    <i class="fas fa-users"></i> Data Penyewa
                </a>
                <a href="{{ route('admin.booking.index') }}" class="sidebar-item">
                    <i class="fas fa-clipboard-list"></i> Data Booking
                </a>
                <a href="{{ route('admin.payment.index') }}" class="sidebar-item">
                    <i class="fas fa-money-bill-wave"></i> Data Pembayaran
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="sidebar-item">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>

                <!-- TAMBAHKAN INI -->
                <a href="{{ route('admin.data-user') }}" class="sidebar-item">
                    <i class="fas fa-users"></i> Data User
                </a>

                <!-- Profil Admin -->
                <a href="{{ route('admin.profil') }}" class="sidebar-item">
                    <i class="fas fa-user-shield"></i> Profil Admin
                </a>

                <!-- LOGOUT FORM -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="sidebar-item text-danger" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>