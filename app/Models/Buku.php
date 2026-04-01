<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = ['judul', 'penulis', 'penerbit', 'tahun_terbit'];

    public function kategori_relasi() {
        return $this->hasMany(KategoriBukuRelasi::class, 'buku_id');
    }

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public function ulasan() {
        return $this->hasMany(UlasanBuku::class, 'buku_id');
    }

    public function koleksi() {
        return $this->hasMany(KoleksiPribadi::class, 'buku_id');
    }
}