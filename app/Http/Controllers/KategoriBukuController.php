<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBuku;

class KategoriBukuController extends Controller
{
    public function index() {
        $kategori = KategoriBuku::all();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request) {
        $request->validate(['nama_kategori' => 'required']);
        KategoriBuku::create($request->all());
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $kategori = KategoriBuku::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id) {
        KategoriBuku::destroy($id);
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}