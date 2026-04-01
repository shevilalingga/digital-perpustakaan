<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Akun Administrator
        User::updateOrCreate([
            'username' => 'admin',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password'), // Password default: password
            'nama_lengkap' => 'Administrator Utama',
            'alamat' => 'Kantor Perpustakaan Pusat',
            'role' => 'administrator'
        ]);

        // 2. Membuat Akun Petugas (Sebagai tambahan)
        User::updateOrCreate([
            'username' => 'petugas',
            'email' => 'petugas@perpustakaan.com',
            'password' => Hash::make('password'), // Password default: password
            'nama_lengkap' => 'Petugas Jaga',
            'alamat' => 'Meja Layanan Perpustakaan',
            'role' => 'petugas'
        ]);
    }
}