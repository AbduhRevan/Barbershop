<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paket extends Model
{
    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'harga_member' => 'decimal:2',
            'harga_non_member' => 'decimal:2',
        ];
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', 'aktif');
    }

    public function layanan(): BelongsToMany
    {
        return $this->belongsToMany(Layanan::class, 'detail_paket', 'id_paket', 'id_layanan');
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'id_paket', 'id_paket');
    }
}
