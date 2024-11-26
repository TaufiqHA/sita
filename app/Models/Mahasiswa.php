<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'nama', 'email', 'nim', 'alamat', 'sks', 'password', // Kolom-kolom di tabel mahasiswa
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
