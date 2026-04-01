@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">Detail Buku</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                
                <h3 class="fw-bold">{{ $buku->judul }}</h3>
                <p class="mb-2">
                    <strong>Kategori:</strong> 
                    @foreach($buku->kategori_relasi as $relasi)
                        <span class="badge bg-info text-dark">{{ $relasi->kategori->nama_kategori }}</span>
                    @endforeach
                </p>
                <p class="mb-2"><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                <p class="mb-2"><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
                <p class="mb-4"><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>

                @if(auth()->user()->role == 'peminjam')
                <div class="d-grid gap-2 mt-4">
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                        <button type="submit" class="btn btn-success w-100 fw-bold">Pinjam Buku Ini</button>
                    </form>

                    <form action="{{ route('koleksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                        <button type="submit" class="btn btn-warning w-100 fw-bold text-dark">Tambahkan ke Koleksi Pribadi</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-7">
        @if(auth()->user()->role == 'peminjam')
        <div class="card shadow mb-4">
            <div class="card-header bg-white fw-bold">Berikan Ulasan & Rating</div>
            <div class="card-body">
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                    <div class="mb-3">
                        <label>Ulasan Anda</label>
                        <textarea name="ulasan" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Rating (1 - 5)</label>
                        <select name="rating" class="form-select" required>
                            <option value="5">5 - Sangat Bagus</option>
                            <option value="4">4 - Bagus</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Buruk</option>
                            <option value="1">1 - Sangat Buruk</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </form>
            </div>
        </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-white fw-bold">Ulasan Pembaca</div>
            <div class="card-body">
                @foreach($buku->ulasan as $u)
                <div class="border-bottom mb-3 pb-2">
                    <h6 class="fw-bold mb-1">{{ $u->user->nama_lengkap }} <span class="badge bg-secondary">Rating: {{ $u->rating }}/5</span></h6>
                    <p class="mb-0 text-muted">{{ $u->ulasan }}</p>
                </div>
                @endforeach
                @if($buku->ulasan->isEmpty())
                <p class="text-center text-muted">Belum ada ulasan untuk buku ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection