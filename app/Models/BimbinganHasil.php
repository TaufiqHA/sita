<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BimbinganHasil extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function judul()
    {
        return $this->belongsTo(Judul::class);
    }

    public function dospem1()
    {
        return $this->belongsTo(User::class, 'dospem1_id');
    }

    public function dospem2()
    {
        return $this->belongsTo(User::class, 'dospem2_id');
    }
}
