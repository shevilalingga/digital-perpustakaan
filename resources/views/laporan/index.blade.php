@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-4 d-print-none">
        <div class="card-header bg-white">
            <h4 class="mb-0">Filter Laporan</h4>
        </div>
        <div class="card-body">
            <form action="{{ url()->current() }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="{{ request('tgl_selesai') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url()->current() }}" class="btn btn-danger me-2">Reset</a>
                    <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-white text-center py-3">
            <h4 class="mb-0">Laporan Seluruh Peminjaman</h4>
            @if(request('tgl_mulai') && request('tgl_selesai'))
                <p class="mb-0 text-muted">Periode: {{ request('tgl_mulai') }} s/d {{ request('tgl_selesai') }}</p>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->user->nama_lengkap }}</td>
                            <td>{{ $data->buku->judul }}</td>
                            <td>{{ $data->tanggal_peminjaman }}</td>
                            <td>{{ $data->tanggal_pengembalian }}</td>
                            <td>
                                <span class="badge {{ $data->status_peminjaman == 'dipinjam' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($data->status_peminjaman) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        
                        @if($laporan->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data laporan yang sesuai filter.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        /* Sembunyikan semua elemen kecuali tabel laporan */
        .navbar, .btn, .card-header button, .d-print-none, form {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0;
            margin: 0;
        }
        table {
            width: 100% !important;
            border-collapse: collapse;
        }
    }
</style>
@endsection