<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id_review';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = null;

    protected $guarded = [];

    protected function casts(): array
    {
        return ['dimoderasi_pada' => 'datetime'];
    }

    public function scopeDisetujui(Builder $query): Builder
    {
        return $query->where('status_moderasi', 'disetujui');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'dimoderasi_oleh', 'id_pengguna');
    }
}
