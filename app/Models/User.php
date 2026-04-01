<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'email', 'nama_lengkap', 'alamat', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }
}