<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Bantuan - OPET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            min-height: 100vh;
            padding: 20px;
        }
        .container-custom {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 600;
        }
        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container-custom">
    <a href="{{ route('user.home') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>

    <h2 class="fw-bold text-primary mb-4">Riwayat Bantuan</h2>

    <div class="row">
        @foreach($laporans as $l)
        <div class="col-md-12 mb-3">
            <div class="card p-3 shadow-sm">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>No. WhatsApp:</strong> {{ $l->no_wa }}</p>
                        <p><strong>Deskripsi:</strong> {{ $l->deskripsi }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge {{ $l->status == 'Selesai' ? 'bg-success' : 'bg-warning' }}">
                                {{ $l->status ?? 'Belum Ditangani' }}
                            </span>
                        </p>
                        <p><strong>Dikirim:</strong> {{ $l->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>