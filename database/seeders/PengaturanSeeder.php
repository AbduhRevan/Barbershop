<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        Pengaturan::create([
            'kunci' => 'batas_konfirmasi_jam',
            'nilai' => '24',
            'keterangan' => 'Batas konfirmasi jadwal baru: jam sejak jadwal ditawarkan',
        ]);

        Pengaturan::create([
            'kunci' => 'batas_sebelum_jadwal_jam',
            'nilai' => '2',
            'keterangan' => 'Batas konfirmasi jadwal baru: jam sebelum jam mulai jadwal baru',
        ]);
    }
}
