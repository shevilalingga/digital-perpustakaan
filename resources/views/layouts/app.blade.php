<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Mengubah latar belakang seluruh halaman */
    body {
        /* Background gradasi lembut antara Peach dan Pink */
        background: linear-gradient(135deg, #fff5f5 0%, #ffecd2 100%) !important;
        min-height: 100vh;
    }

    /* Navigasi Gradasi Pink ke Peach */
    .navbar-custom {
        /* Menggunakan gradasi Pink (Hot Pink Soft) ke Peach */
        background: linear-gradient(45deg, #ff85a2 0%, #ffc1a1 100%) !important;
        border-bottom: 3px solid #f06292;
        box-shadow: 0 4px 15px rgba(255, 133, 162, 0.2);
    }

    /* Warna teks navigasi */
    .navbar-dark .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        transition: 0.3s;
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        color: #ffffff;
        text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }

    /* Tombol Logout agar senada dengan tema Pink */
    .btn-logout {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: white;
        border-radius: 20px;
        padding: 5px 20px;
        transition: 0.3s;
    }

    .btn-logout:hover {
        background: #ad1457; /* Deep Pink saat hover */
        border-color: #ad1457;
        color: white;
        box-shadow: 0 4px 10px rgba(173, 20, 87, 0.3);
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Perpustakaan Digital</a>
            @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/buku">Daftar Buku</a></li>
                    
                    
                    @if(auth()->user()->role == 'administrator' || auth()->user()->role == 'petugas')
                    <li class="nav-item"><a class="nav-link" href="/kategori">Kategori Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="/laporan">Laporan</a></li>
                    @endif

                    <li class="nav-item"><a class="nav-link" href="/peminjaman">Peminjaman</a></li>

                    @if(auth()->user()->role == 'peminjam')
                    <li class="nav-item"><a class="nav-link" href="/koleksi">Koleksi Pribadi</a></li>
                    @endif
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-logout btn-sm px-3 rounded-pill" type="submit">Logout</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>