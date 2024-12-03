<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function pembimbing(): HasOne {
        return $this->hasOne(Pembimbing::class);
    }

    public function dospem1()
    {
        return $this->belongsTo(Dosen::class, 'dospem1_id');
    }

    public function dospem2()
    {
        return $this->belongsTo(Dosen::class, 'dospem2_id');
    }

}
