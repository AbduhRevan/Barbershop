<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['Admin Roeang Tjoekoer', 'admin@roeang.test', '081200000001', 'admin', 'non_member'],
            ['Owner Roeang Tjoekoer', 'owner@roeang.test', '081200000002', 'owner', 'non_member'],
            ['Pelanggan Contoh', 'pelanggan@roeang.test', '081200000003', 'pelanggan', 'non_member'],
            ['Member Contoh', 'member@roeang.test', '081200000004', 'pelanggan', 'member'],
        ];

        foreach ($akun as [$nama, $email, $wa, $peran, $status]) {
            Pengguna::create([
                'nama' => $nama,
                'email' => $email,
                'nomor_whatsapp' => $wa,
                'kata_sandi' => 'password123',
                'peran' => $peran,
                'status_member' => $status,
                'tanggal_mulai_member' => $status === 'member' ? now()->toDateString() : null,
            ]);
        }
    }
}
