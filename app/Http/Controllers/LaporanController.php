<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index(Request $request) 
    {
        // Query awal dengan relasi user dan buku
        $query = Peminjaman::with(['user', 'buku']);

        // Filter: Tanggal Mulai & Selesai
        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('tanggal_peminjaman', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        // Filter: Status Peminjaman
        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        // Ambil data terbaru
        $laporan = $query->latest()->get();

        return view('laporan.index', compact('laporan'));
    }
}