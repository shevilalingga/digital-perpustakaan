<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBukuRelasi extends Model
{
    protected $table = 'kategori_buku_relasi';
    protected $fillable = ['buku_id', 'kategori_id'];

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function kategori() {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }
}