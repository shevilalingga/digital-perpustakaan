<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UlasanBuku;
use Illuminate\Support\Facades\Auth;

class UlasanBukuController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'buku_id' => 'required',
            'ulasan' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        UlasanBuku::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan');
    }
}