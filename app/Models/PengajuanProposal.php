<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\Beta;

class PengajuanProposal extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa(): BelongsTo {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function judul(): BelongsTo {
        return $this->belongsTo(Judul::class);
    }
}
