<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends User
{
    use Notifiable;

    protected $fillable = [
        'name', 'nim', 'email', 'sks', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function judul(): HasMany {
        return $this->hasMany(Judul::class);
    }
}
