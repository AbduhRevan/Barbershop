<?php

namespace App\Support;

class Format
{
    /** Hiasan tampilan tiap kategori layanan: ikon ilustrasi dan deskripsi singkat. */
    private const HIASAN = [
        'Hair Cut & Care' => [
            'simbol' => 'sc',
            'deskripsi' => 'Potong rambut, coloring, perming, perawatan rambut, dan shaving.',
        ],
        'Skin Care' => [
            'simbol' => 'lf',
            'deskripsi' => 'Face mask, acne care, dan face acupressure.',
        ],
        'Massage & Therapy' => [
            'simbol' => 'st',
            'deskripsi' => 'Happy foot, full body massage, serta bekam basah dan kering.',
        ],
        'Magic Touch' => [
            'simbol' => 'cp',
            'deskripsi' => 'Pijat lembut khusus wanita, ibu, anak, dan bayi oleh terapis wanita.',
        ],
    ];

    /** Contoh: 50000 menjadi "Rp 50.000". */
    public static function rupiah(float|int|string|null $angka): string
    {
        return 'Rp ' . number_format((float) $angka, 0, ',', '.');
    }

    public static function hiasanKategori(string $nama): array
    {
        return self::HIASAN[$nama] ?? ['simbol' => 'sc', 'deskripsi' => ''];
    }
}
