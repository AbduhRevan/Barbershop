<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatusBooking extends Model
{
    protected $table = 'riwayat_status_booking';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return ['waktu_perubahan' => 'datetime'];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }

    public function pengubah(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'diubah_oleh', 'id_pengguna');
    }
}