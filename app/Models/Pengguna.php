<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = null;

    protected $guarded = [];
    protected $hidden = ['kata_sandi'];
    protected $rememberTokenName = '';

    protected function casts(): array
    {
        return [
            'kata_sandi' => 'hashed',
            'tanggal_mulai_member' => 'date',
            'tanggal_berakhir_member' => 'date',
        ];
    }

    public function getAuthPassword(): string
    {
        return $this->kata_sandi;
    }

    public function getAuthPasswordName(): string
    {
        return 'kata_sandi';
    }

    public function isPelanggan(): bool
    {
        return $this->peran === 'pelanggan';
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    public function isOwner(): bool
    {
        return $this->peran === 'owner';
    }

    public function isMember(): bool
    {
        return $this->status_member === 'member';
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'id_pelanggan', 'id_pengguna');
    }
}
