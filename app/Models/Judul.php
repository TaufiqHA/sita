<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judul extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
