<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'kunci';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    /** Ambil nilai parameter, atau nilai bawaan jika belum ada. */
    public static function ambil(string $kunci, mixed $bawaan = null): mixed
    {
        return static::query()->where('kunci', $kunci)->value('nilai') ?? $bawaan;
    }
}
