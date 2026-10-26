<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = null;

    /** Status yang menahan atau mengunci waktu staf. Status lain melepas slot. */
    const STATUS_MEMAKAI_SLOT = ['menunggu_persetujuan', 'disetujui', 'menunggu_konfirmasi'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'tanggal_layanan' => 'date',
            'tanggal_lama' => 'date',
            'batas_konfirmasi' => 'datetime',
        ];
    }

    public function scopeMemakaiSlot(Builder $query): Builder
    {
        return $query->whereIn('status', self::STATUS_MEMAKAI_SLOT);
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pelanggan', 'id_pengguna');
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }

    public function segmen(): HasMany
    {
        return $this->hasMany(SegmenBooking::class, 'id_booking', 'id_booking');
    }

    public function transaksi(): HasOne
    {
        return $this->hasOne(Transaksi::class, 'id_booking', 'id_booking');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'id_booking', 'id_booking');
    }

    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatStatusBooking::class, 'id_booking', 'id_booking');
    }

    public function logNotifikasi(): HasMany
    {
        return $this->hasMany(LogNotifikasi::class, 'id_booking', 'id_booking');
    }
}
