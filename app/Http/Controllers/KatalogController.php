<?php

namespace App\Http\Controllers;

use App\Models\KategoriLayanan;
use App\Models\Paket;
use Illuminate\View\View;

class KatalogController extends Controller
{
    public function index(): View
    {
        $kategori = KategoriLayanan::with([
            'layanan' => fn($query) => $query->aktif()->orderBy('id_layanan'),
        ])->orderBy('id_kategori')->get();

        $paket = Paket::aktif()
            ->with('layanan')
            ->orderBy('harga_non_member')
            ->get();

        return view('katalog', compact('kategori', 'paket'));
    }
}
