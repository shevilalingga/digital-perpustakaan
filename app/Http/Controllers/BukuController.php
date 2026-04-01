<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\KategoriBukuRelasi;

class BukuController extends Controller
{
    public function index() {
        $buku = Buku::with('kategori_relasi.kategori')->get();
        $kategori = KategoriBuku::all();
        return view('buku.index', compact('buku', 'kategori'));
    }

    public function store(Request $request) {
        $buku = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        if ($request->kategori_id) {
            KategoriBukuRelasi::create([
                'buku_id' => $buku->id,
                'kategori_id' => $request->kategori_id
            ]);
        }

        return redirect('/buku')->with('success', 'Buku beserta kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $buku = Buku::findOrFail($id);
        $buku->update($request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit']));

        if ($request->kategori_id) {
            // Hapus relasi lama, ganti yang baru
            KategoriBukuRelasi::where('buku_id', $id)->delete();
            KategoriBukuRelasi::create([
                'buku_id' => $id,
                'kategori_id' => $request->kategori_id
            ]);
        }

        return redirect('/buku')->with('success', 'Buku berhasil diubah');
    }

    public function destroy($id) {
        Buku::destroy($id);
        return redirect('/buku')->with('success', 'Buku berhasil dihapus');
    }

    // Fungsi baru untuk melihat detail buku, ulasan, dan form tambah ke koleksi
    public function show($id) {
        $buku = Buku::with(['kategori_relasi.kategori', 'ulasan.user'])->findOrFail($id);
        return view('buku.detail', compact('buku'));
    }
}