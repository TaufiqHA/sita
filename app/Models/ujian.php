<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ujian extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function ujianMunaqasya()
    {
        return $this->hasOne(UjianMunaqasya::class);
    }

    protected $casts = [
        'verifikasi' => 'boolean',
    ];

}
