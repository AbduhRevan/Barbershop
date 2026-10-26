<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiburStaf extends Model
{
    protected $table = 'libur_staf';
    protected $primaryKey = 'id_libur';
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'id_staf', 'id_staf');
    }
}
