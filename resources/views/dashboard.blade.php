@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow border-0 border-start border-primary border-5">
            <div class="card-body">
                <h2 class="fw-bold">Selamat Datang, {{ $user->nama_lengkap }}!</h2>
                <p class="mb-0 text-muted">Anda login sebagai: <span class="badge bg-primary fs-6">{{ strtoupper($user->role) }}</span></p>
            </div>
        </div>
    </div>

    @if(auth()->user()->role == 'administrator' || auth()->user()->role == 'petugas')
    
    <div class="col-md-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span class="mb-0 h5">Pantauan Ulasan Pengguna Terkini</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Buku yang Diulas</th>
                                <th>Isi Ulasan</th>
                                <th>Rating</th>
                                <th>Waktu Ulasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($ulasan)
                                @foreach($ulasan as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $u->user->nama_lengkap }}</td>
                                    <td>{{ $u->buku->judul }}</td>
                                    <td>{{ $u->ulasan }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark fs-6">
                                            ⭐ {{ $u->rating }} / 5
                                        </span>
                                    </td>
                                    <td>{{ $u->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                                @endforeach
                                
                                @if($ulasan->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">Belum ada ulasan dari pengguna saat ini.</td>
                                </tr>
                                @endif
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection