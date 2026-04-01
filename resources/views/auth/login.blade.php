@extends('layouts.app')

@section('content')
<style>
    /* Container Utama dengan Background Soft agar Glassmorphism terlihat */
    .login-container {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Background gradasi lembut antara Peach dan Pink */
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    /* Efek Glassmorphism Pink Cerah */
    .card-glass {
        background: rgba(255, 182, 193, 0.4); /* Pink Muda Transparan */
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 30px;
        color: #4a4a4a; /* Teks abu gelap agar kontras */
    }

    .card-header-glass {
        background: rgba(255, 255, 255, 0.2) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 30px 30px 0 0 !important;
        padding: 30px;
        color: #d81b60; /* Deep Pink untuk header */
        text-shadow: 1px 1px 2px rgba(255,255,255,0.5);
    }

    /* Styling Label */
    .form-label-custom {
        font-weight: 600;
        color: #ad1457; /* Pink tua */
        margin-bottom: 8px;
        display: block;
        letter-spacing: 0.5px;
    }

    /* Input Field Glassmorphism Terang */
    .form-control-glass {
        background: rgba(255, 255, 255, 0.8) !important;
        border: 1px solid #ffc1e3 !important;
        color: #880e4f !important;
        border-radius: 12px;
        padding: 12px 15px;
        transition: 0.3s;
    }

    .form-control-glass:focus {
        background: #ffffff !important;
        box-shadow: 0 0 15px rgba(255, 105, 180, 0.3);
        border-color: #ff69b4 !important;
        outline: none;
    }

    .form-control-glass::placeholder {
        color: #f06292 !important;
    }

    /* Tombol Gradasi Pink ke Peach */
    .btn-gradasi {
        background: linear-gradient(45deg, #ff85a2 0%, #ffc1a1 100%);
        border: none;
        color: white !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 13px;
        transition: all 0.4s ease;
        box-shadow: 0 4px 15px rgba(255, 133, 162, 0.3);
    }

    .btn-gradasi:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 133, 162, 0.4);
        filter: brightness(1.05);
    }

    /* Link & Alert */
    .link-registrasi {
        color: #ad1457;
        text-decoration: none;
        font-weight: 700;
        border-bottom: 2px solid #ff85a2;
        transition: 0.3s;
    }

    .link-registrasi:hover {
        color: #ff4081;
        border-bottom-color: #ff4081;
    }

    .alert-custom {
        background: rgba(255, 255, 255, 0.4);
        border: 1px solid rgba(255, 182, 193, 0.5);
        color: #ad1457;
        border-radius: 12px;
    }
</style>

<div class="login-container">
    <div class="col-md-10 col-lg-4 px-3">
        <div class="card card-glass shadow-lg border-0">
            <div class="card-header card-header-glass text-center">
                <h4 class="mb-0 fw-bold">LOGIN APLIKASI</h4>
            </div>
            <div class="card-body p-4 p-md-5">
                
                @if(session('success'))
                    <div class="alert alert-custom shadow-sm rounded-3 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-custom border-danger shadow-sm rounded-3 mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label-custom">Username</label>
                        <input type="text" name="username" class="form-control form-control-glass" placeholder="Masukkan ID Anda" required autofocus>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label-custom">Password</label>
                        <input type="password" name="password" class="form-control form-control-glass" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-gradasi w-100 rounded-pill mt-2 shadow">
                        MASUK SEKARANG
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="text-white opacity-75">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="link-registrasi">Registrasi Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection