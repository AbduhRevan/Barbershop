<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SegmenBooking extends Model
{
    protected $table = 'segmen_booking';
    protected $primaryKey = 'id_segmen';
    public $timestamps = false;
    protected $guarded = [];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'id_staf', 'id_staf');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailBooking::class, 'id_segmen', 'id_segmen');
    }
}
