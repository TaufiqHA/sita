<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Dosen extends User
{
    use Notifiable;
    protected $fillable = [
        'name', 'nip', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
