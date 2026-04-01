<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user->role == 'peminjam') {
            $peminjaman = Peminjaman::where('user_id', $user->id)->with('buku')->get();
            $buku = Buku::all();
            return view('peminjaman.index_peminjam', compact('peminjaman', 'buku'));
        } else {
            $peminjaman = Peminjaman::with(['user', 'buku'])->get();
            return view('peminjaman.index_admin', compact('peminjaman'));
        }
    }

    public function store(Request $request) {
        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => now()->addDays(7), // Pinjam 7 hari
            'status_peminjaman' => 'dipinjam'
        ]);
        return redirect('/peminjaman')->with('success', 'Buku berhasil dipinjam');
    }

    public function kembalikan($id) {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status_peminjaman' => 'dikembalikan']);
        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}