<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembimbing extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa(): BelongsTo {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function judul(): BelongsTo {
        return $this->belongsTo(Judul::class);
    }

    public function dospem1(): BelongsTo {
        return $this->belongsTo(Dosen::class, 'dospem1_id');
    }

    public function dospem2(): BelongsTo {
        return $this->belongsTo(Dosen::class, 'dospem2_id');
    }
}
