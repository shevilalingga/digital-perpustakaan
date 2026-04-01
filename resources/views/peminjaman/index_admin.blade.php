@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white">
        <h4 class="mb-0">Daftar Peminjaman Aktif (Admin & Petugas)</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tenggat Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->user->nama_lengkap }}</td>
                        <td>{{ $p->buku->judul }}</td>
                        <td>{{ $p->tanggal_peminjaman }}</td>
                        <td>{{ $p->tanggal_pengembalian }}</td>
                        <td>
                            @if($p->status_peminjaman == 'dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status_peminjaman == 'dipinjam')
                            <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pengembalian buku dari pengguna ini?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Tandai Kembali</button>
                            </form>
                            @else
                            <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if($peminjaman->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">Saat ini tidak ada data peminjaman.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection