<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Judul extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa(): BelongsTo {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pembimbing(): HasOne {
        return $this->HasOne(Pembimbing::class);
    }
}
