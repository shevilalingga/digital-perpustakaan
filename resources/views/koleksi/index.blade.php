@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white">
        <h4 class="mb-0">Koleksi Pribadi Saya</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach($koleksi as $item)
            <div class="col-md-4 mb-3">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $item->buku->judul }}</h5>
                        <p class="card-text text-muted mb-1">{{ $item->buku->penulis }}</p>
                        <p class="card-text text-muted">{{ $item->buku->tahun_terbit }}</p>
                        
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('buku.show', $item->buku_id) }}" class="btn btn-outline-primary btn-sm">Lihat Buku</a>
                            
                            <form action="{{ route('koleksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Keluarkan buku ini dari koleksi?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus Koleksi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($koleksi->isEmpty())
        <div class="text-center mt-4">
            <h5 class="text-muted">Koleksi Anda masih kosong.</h5>
            <p>Silakan cari buku dan tambahkan ke koleksi pribadi Anda.</p>
        </div>
        @endif
    </div>
</div>
@endsection