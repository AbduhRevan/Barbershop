<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'durasi_menit' => 'integer',
            'harga_member' => 'decimal:2',
            'harga_non_member' => 'decimal:2',
        ];
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', 'aktif');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriLayanan::class, 'id_kategori', 'id_kategori');
    }

    public function paket(): BelongsToMany
    {
        return $this->belongsToMany(Paket::class, 'detail_paket', 'id_layanan', 'id_paket');
    }

    public function detailBooking(): HasMany
    {
        return $this->hasMany(DetailBooking::class, 'id_layanan', 'id_layanan');
    }

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'id_layanan', 'id_layanan');
    }
}
