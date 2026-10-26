<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use App\Models\Layanan;
use App\Models\Paket;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [];
        foreach (['Hair Cut & Care', 'Skin Care', 'Massage & Therapy', 'Magic Touch'] as $nama) {
            $kategori[$nama] = KategoriLayanan::create(['nama_kategori' => $nama])->id_kategori;
        }

        // [kategori, nama, jenis staf, syarat staf, durasi (menit), harga]
        // Harga dari brosur. Durasi layanan rambut dan wajah, harga Keramas, Creambath,
        // dan seluruh Magic Touch adalah CONTOH: ubah sesuai kondisi sebenarnya.
        $umum = 'umum';
        $wanita = 'khusus_terapis_wanita';
        $layanan = [
            ['Hair Cut & Care', 'Basic Hair Cut', 'capster', $umum, 45, 50000],
            ['Hair Cut & Care', 'Keramas', 'capster', $umum, 15, 10000],
            ['Hair Cut & Care', 'Creambath', 'capster', $umum, 30, 30000],
            ['Hair Cut & Care', 'Coloring / Perming', 'capster', $umum, 120, 200000],
            ['Hair Cut & Care', 'Basic Hair Care', 'capster', $umum, 30, 50000],
            ['Hair Cut & Care', 'Expert Hair Care', 'capster', $umum, 45, 100000],
            ['Hair Cut & Care', 'Shaving Routine', 'capster', $umum, 15, 15000],
            ['Skin Care', 'Face Mask', 'capster', $umum, 30, 40000],
            ['Skin Care', 'Acne Care', 'capster', $umum, 30, 40000],
            ['Skin Care', 'Face Accupressure', 'terapis', $umum, 30, 40000],
            ['Massage & Therapy', 'Happy Foot (60 menit)', 'terapis', $umum, 60, 45000],
            ['Massage & Therapy', 'Happy Foot (90 menit)', 'terapis', $umum, 90, 90000],
            ['Massage & Therapy', 'Happy Back & Foot (60 menit)', 'terapis', $umum, 60, 90000],
            ['Massage & Therapy', 'Happy Back & Foot (90 menit)', 'terapis', $umum, 90, 120000],
            ['Massage & Therapy', 'Full Body Massage (60 menit)', 'terapis', $umum, 60, 120000],
            ['Massage & Therapy', 'Full Body Massage (90 menit)', 'terapis', $umum, 90, 160000],
            ['Massage & Therapy', 'Full Body Massage (120 menit)', 'terapis', $umum, 120, 200000],
            ['Massage & Therapy', 'Bekam Basah (90 menit)', 'terapis', $umum, 90, 200000],
            ['Massage & Therapy', 'Bekam Kering (60 menit)', 'terapis', $umum, 60, 50000],
            ['Magic Touch', 'Pijat Wanita', 'terapis', $wanita, 60, 100000],
            ['Magic Touch', 'Pijat Ibu', 'terapis', $wanita, 60, 100000],
            ['Magic Touch', 'Pijat Anak', 'terapis', $wanita, 45, 80000],
            ['Magic Touch', 'Pijat Bayi', 'terapis', $wanita, 30, 70000],
        ];

        foreach ($layanan as [$kat, $nama, $jenis, $syarat, $durasi, $harga]) {
            Layanan::create([
                'id_kategori' => $kategori[$kat],
                'nama_layanan' => $nama,
                'jenis_staf' => $jenis,
                'syarat_staf' => $syarat,
                'durasi_menit' => $durasi,
                'harga_member' => $harga,
                'harga_non_member' => $harga,
            ]);
        }

        // [nama, deskripsi, harga member, harga non-member, isi paket] (harga dan isi dari brosur)
        $paket = [
            ['Basic', 'Hair Cut + Keramas', 40000, 50000, ['Basic Hair Cut', 'Keramas']],
            ['Silver', 'Basic + Face Mask', 70000, 90000, ['Basic Hair Cut', 'Keramas', 'Face Mask']],
            ['Gold', 'Silver + Creambath', 110000, 140000, ['Basic Hair Cut', 'Keramas', 'Face Mask', 'Creambath']],
            ['Platinum', 'Gold + Happy Foot 60 menit', 150000, 180000, ['Basic Hair Cut', 'Keramas', 'Face Mask', 'Creambath', 'Happy Foot (60 menit)']],
        ];

        foreach ($paket as [$nama, $deskripsi, $member, $non, $isi]) {
            $p = Paket::create([
                'nama_paket' => $nama,
                'deskripsi' => $deskripsi,
                'harga_member' => $member,
                'harga_non_member' => $non,
            ]);
            $p->layanan()->attach(Layanan::whereIn('nama_layanan', $isi)->pluck('id_layanan'));
        }
    }
}
