<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staf extends Model
{
    protected $table = 'staf';
    protected $primaryKey = 'id_staf';
    public $timestamps = false;
    protected $guarded = [];

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', 'aktif');
    }

    public function jadwalKerja(): HasMany
    {
        return $this->hasMany(JadwalKerja::class, 'id_staf', 'id_staf');
    }

    public function libur(): HasMany
    {
        return $this->hasMany(LiburStaf::class, 'id_staf', 'id_staf');
    }

    public function segmen(): HasMany
    {
        return $this->hasMany(SegmenBooking::class, 'id_staf', 'id_staf');
    }
}
