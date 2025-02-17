<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pengajuanJudul()
    {
        return $this->hasMany(PengajuanJudul::class);
    }

    public function mahasiswaDetail()
    {
        return $this->hasOne(MahasiswaDetail::class);
    }

    public function judul()
    {
        return $this->hasOne(Judul::class);
    }

    public function bimbinganProposal()
    {
        return $this->hasOne(BimbinganProposal::class, 'user_id');
    }
    
    public function bimbinganHasil()
    {
        return $this->hasOne(BimbinganHasil::class, 'user_id');
    }

    public function bimbinganUjian()
    {
        return $this->hasOne(BimbinganUjian::class, 'user_id');
    }

    public function seminar()
    {
        return $this->hasMany(Seminar::class);
    }

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     if ($panel->getId() === 'admin') {
    //         return Auth::user()->roles->contains('name', 'super_admin');
    //     }elseif ($panel->getId() === 'mahasiswa') {
    //         return Auth::user()->roles->contains('name', 'mahasiswa');
    //     }elseif ($panel->getId() === 'kajur') {
    //         return Auth::user()->roles->contains('name', 'kajur');
    //     }elseif ($panel->getId() === 'sekjur') {
    //         return Auth::user()->roles->contains('name', 'sekjur');
    //     }elseif ($panel->getId() === 'dosen') {
    //         return Auth::user()->roles->contains('name', 'dosen');
    //     }

    //     return true;
    // }
}
