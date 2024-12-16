<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjianMunaqasya extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
