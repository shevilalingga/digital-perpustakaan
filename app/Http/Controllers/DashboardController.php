<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UlasanBuku;
use App\Models\User; // Tambahkan ini untuk akses model User
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk enkripsi password

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        
        // Jika yang login adalah admin atau petugas, ambil semua data ulasan terbaru
        if ($user->role == 'administrator' || $user->role == 'petugas') {
            $ulasan = UlasanBuku::with(['user', 'buku'])->latest()->get();
            
            return view('dashboard', compact('user', 'ulasan'));
        }

        return view('dashboard', compact('user'));
    }

    // FUNGSI BARU: Untuk menyimpan data petugas yang didaftarkan melalui Dashboard
    public function storePetugas(Request $request) 
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
        ]);

        // Simpan ke database
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password otomatis dienkripsi
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'role' => 'petugas', // Set otomatis sebagai petugas
        ]);

        return redirect()->route('dashboard')->with('success', 'Petugas baru berhasil didaftarkan!');
    }
}