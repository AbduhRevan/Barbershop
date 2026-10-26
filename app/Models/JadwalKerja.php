<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalKerja extends Model
{
    protected $table = 'jadwal_kerja';
    protected $primaryKey = 'id_jadwal';
    public $timestamps = false;
    protected $guarded = [];

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'id_staf', 'id_staf');
    }
}
