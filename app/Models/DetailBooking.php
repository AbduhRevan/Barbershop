<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBooking extends Model
{
    protected $table = 'detail_booking';
    protected $primaryKey = 'id_detail_booking';
    public $timestamps = false;
    protected $guarded = [];

    public function segmen(): BelongsTo
    {
        return $this->belongsTo(SegmenBooking::class, 'id_segmen', 'id_segmen');
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
