<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogNotifikasi extends Model
{
    protected $table = 'log_notifikasi';
    protected $primaryKey = 'id_log';
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'waktu_disusun' => 'datetime',
            'waktu_dibuka' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_admin', 'id_pengguna');
    }
}
