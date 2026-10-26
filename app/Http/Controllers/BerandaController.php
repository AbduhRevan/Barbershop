<?php

namespace App\Http\Controllers;

use App\Models\KategoriLayanan;
use App\Models\Paket;
use App\Models\Review;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(): View
    {
        $kategori = KategoriLayanan::orderBy('id_kategori')->get();

        $paket = Paket::aktif()
            ->with('layanan')
            ->orderBy('harga_non_member')
            ->get();

        $ulasan = Review::disetujui()
            ->with('booking.pelanggan')
            ->latest('dibuat_pada')
            ->limit(3)
            ->get();

        return view('beranda', compact('kategori', 'paket', 'ulasan'));
    }
}
