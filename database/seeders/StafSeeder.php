<?php

namespace Database\Seeders;

use App\Models\Staf;
use Illuminate\Database\Seeder;

class StafSeeder extends Seeder
{
    public function run(): void
    {
        // Nama dan jadwal adalah CONTOH (09.00 sampai 21.00 setiap hari).
        $staf = [
            ['Capster Satu', 'capster', 'L'],
            ['Capster Dua', 'capster', 'L'],
            ['Terapis Pria Satu', 'terapis', 'L'],
            ['Terapis Wanita Satu', 'terapis', 'P'],
            ['Terapis Wanita Dua', 'terapis', 'P'],
        ];

        foreach ($staf as [$nama, $jenis, $kelamin]) {
            $s = Staf::create([
                'nama_staf' => $nama,
                'jenis_staf' => $jenis,
                'jenis_kelamin' => $kelamin,
            ]);

            foreach (range(1, 7) as $hari) {
                $s->jadwalKerja()->create([
                    'hari' => $hari,
                    'jam_mulai' => '09:00:00',
                    'jam_selesai' => '21:00:00',
                ]);
            }
        }
    }
}
