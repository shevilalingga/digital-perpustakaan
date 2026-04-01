@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Buku</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
            Tambah Buku Baru
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBukuModal{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editBukuModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Buku</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                
                            </div>
                            <form action="{{ route('buku.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body text-dark"> <div class="mb-3">
        <label class="form-label fw-bold">Judul Buku</label>
        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku (contoh: Harry Potter)" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-bold">Penulis</label>
        <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis buku" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-bold">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" placeholder="Masukkan nama penerbit" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-bold">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024" required>
    </div> 
</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('buku.store') }}" method="POST">
                @csrf
               <div class="modal-body text-dark">
        <div class="mb-3">
            <label class="fw-bold">Judul Buku</label>
            <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Buku" required>
        </div>
        <div class="mb-3">
            <label class="fw-bold">Penulis</label>
            <input type="text" name="penulis" class="form-control" placeholder="Nama Penulis" required>
        </div>
        <div class="mb-3">
            <label class="fw-bold">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" placeholder="Nama Penerbit" required>
        </div>
        <div class="mb-3">
            <label class="fw-bold">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Buku</button>
    </div>
            </form>
        </div>
    </div>
</div>
@endsection