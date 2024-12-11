<?php

namespace App\Models;

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
        return $this->HasOne(Pembimbing::class);
    }

    public function pembimbingHasil(): HasOne {
        return $this->hasOne(PembimbingHasil::class);
    }

    public function proposal(): HasOne {
        return $this->hasOne(PengajuanProposal::class);
    }
}
