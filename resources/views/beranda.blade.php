@extends('layouts.situs')

@section('judul', 'Beranda')

@section('isi')
    @php
        $tujuanBooking = auth()->check() ? '#' : route('masuk');
        // [ikon, warna ikon, warna latar, kelas tambahan]
        $galeri = [
            ['pl', '#12224a', '#dfe6f5', 'baris-2'],
            ['sc', '#ffffff', '#12224a', ''],
            ['lf', '#c8202b', '#fbeced', ''],
            ['st', '#12224a', '#eef2fb', 'baris-2'],
            ['cp', '#ffffff', '#c8202b', ''],
            ['cb', '#c8202b', '#dfe6f5', ''],
        ];
    @endphp

    {{-- Hero dengan slider --}}
    <section class="wadah hero">
        <div class="hero-teks">
            <div class="overline">Barbershop &amp; terapi &middot; Sawangan, Depok</div>
            <h1>Rapi di luar, segar di dalam.</h1>
            <p class="muted hero-pengantar">Potong rambut dan terapi relaksasi dalam satu tempat. Booking online, pilih staf, lalu pantau statusnya.</p>
            <div class="hero-aksi">
                <a href="{{ $tujuanBooking }}" class="btn">Booking Sekarang</a>
                <a href="{{ route('katalog') }}" class="btn btn-garis">Lihat Layanan</a>
            </div>
        </div>

        <div class="slider"
             x-data="{ i: 0, label: ['Hair Cut &amp; Care', 'Massage &amp; Therapy', 'Bekam &amp; Magic Touch'] }"
             x-init="setInterval(() => i = (i + 1) % 3, 5000)">
            <div class="slide" :class="{ 'aktif': i === 0 }">@include('partials.ilustrasi-1')</div>
            <div class="slide" :class="{ 'aktif': i === 1 }">@include('partials.ilustrasi-2')</div>
            <div class="slide" :class="{ 'aktif': i === 2 }">@include('partials.ilustrasi-3')</div>

            <div class="slider-label" x-text="label[i]"></div>
            <div class="slider-kontrol">
                <button type="button" class="slider-tombol" aria-label="Sebelumnya" @click="i = (i + 2) % 3">&lsaquo;</button>
                <template x-for="k in [0, 1, 2]" :key="k">
                    <button type="button" class="slider-titik" :class="{ 'aktif': i === k }" aria-label="Slide" @click="i = k"></button>
                </template>
                <button type="button" class="slider-tombol" aria-label="Berikutnya" @click="i = (i + 1) % 3">&rsaquo;</button>
            </div>
        </div>
    </section>

    {{-- Layanan (kategori dari basis data) --}}
    <section class="wadah bagian">
        <div class="overline rv">Layanan kami</div>
        <h2 class="rv">Satu tempat untuk rapi dan segar</h2>
        <div class="kisi-4">
            @foreach ($kategori as $k)
                @php $h = \App\Support\Format::hiasanKategori($k->nama_kategori); @endphp
                <a href="{{ route('katalog', ['kategori' => $k->id_kategori]) }}"
                   class="kartu-kategori lift rv {{ $loop->even ? 'tint-merah' : 'tint-biru' }}">
                    <svg viewBox="0 0 100 100" width="64" height="64" aria-hidden="true"><use href="#{{ $h['simbol'] }}"/></svg>
                    <div>
                        <h3>{{ $k->nama_kategori }}</h3>
                        <p>{{ $h['deskripsi'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Galeri --}}
    <section id="galeri" class="wadah bagian">
        <div class="overline rv">Galeri</div>
        <h2 class="rv">Suasana dan hasil layanan</h2>
        <div class="galeri">
            @foreach ($galeri as [$simbol, $warna, $latar, $kelas])
                <div class="petak rv {{ $kelas }}" style="background: {{ $latar }}; color: {{ $warna }}">
                    <svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice" aria-hidden="true"><use href="#{{ $simbol }}" x="18" y="15" width="64" height="70"/></svg>
                </div>
            @endforeach
        </div>
        <p class="muted catatan">Ilustrasi contoh. Ganti dengan foto asli Roeang Tjoekoer.</p>
    </section>

    {{-- Paket (dari basis data) --}}
    <section id="paket" class="wadah bagian" x-data="{ member: false }">
        <div class="judul-baris">
            <div>
                <div class="overline rv">Paket</div>
                <h2 class="rv">Paket hemat</h2>
            </div>
            <div class="saklar">
                <button type="button" :class="{ 'aktif': !member }" @click="member = false">Non-member</button>
                <button type="button" :class="{ 'aktif': member }" @click="member = true">Member</button>
            </div>
        </div>
        <div class="kisi-4">
            @foreach ($paket as $p)
                <div class="kartu-paket lift rv {{ $p->nama_paket === 'Platinum' ? 'sorot' : '' }}">
                    <h3>{{ $p->nama_paket }}</h3>
                    <p class="muted">{{ $p->deskripsi }}</p>
                    <div class="muted kecil" x-text="member ? 'Harga member' : 'Harga non-member'">Harga non-member</div>
                    <div class="harga" x-show="!member">{{ \App\Support\Format::rupiah($p->harga_non_member) }}</div>
                    <div class="harga" x-show="member" x-cloak>{{ \App\Support\Format::rupiah($p->harga_member) }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Keuntungan member --}}
    <section class="wadah bagian">
        <div class="member-sorot rv">
            <div style="flex:1">
                <div class="overline overline-terang">Keuntungan member</div>
                <h2>Jadi member, harga lebih hemat.</h2>
                <p>Status member diatur oleh Admin setelah kamu mendaftar di Roeang Tjoekoer.</p>
            </div>
            <div class="member-daftar">
                <div>Harga khusus member untuk layanan dan paket</div>
                <div>Riwayat booking dan status tersimpan di akunmu</div>
                <div>Promo member [sesuai ketentuan yang berlaku]</div>
            </div>
        </div>
    </section>

    {{-- Cara booking --}}
    <section class="wadah bagian">
        <div class="overline rv">Cara booking</div>
        <h2 class="rv">Tiga langkah mudah</h2>
        <div class="kisi-3">
            <div class="kartu-langkah lift rv"><div class="nomor-langkah">01</div><h3>Pilih layanan</h3><p class="muted">Pilih layanan atau paket beserta tanggal kunjungan.</p></div>
            <div class="kartu-langkah lift rv"><div class="nomor-langkah">02</div><h3>Pilih staf dan jam</h3><p class="muted">Hanya jam yang tersedia yang ditampilkan.</p></div>
            <div class="kartu-langkah lift rv"><div class="nomor-langkah">03</div><h3>Tunggu persetujuan</h3><p class="muted">Admin menyetujui, lalu kamu pantau statusnya.</p></div>
        </div>
    </section>

    {{-- Ulasan (yang sudah disetujui Admin) --}}
    <section class="wadah bagian">
        <div class="overline rv">Ulasan</div>
        <h2 class="rv">Kata pelanggan</h2>
        <div class="kisi-3">
            @forelse ($ulasan as $u)
                <div class="kartu-ulasan lift rv">
                    <div class="bintang">{{ $u->rating }}/5</div>
                    <p>{{ $u->ulasan ?: 'Pelanggan tidak menuliskan ulasan.' }}</p>
                    <strong>{{ $u->booking->pelanggan->nama ?? 'Pelanggan' }}</strong>
                </div>
            @empty
                <div class="kartu-ulasan"><p class="muted">Belum ada ulasan yang ditampilkan.</p></div>
            @endforelse
        </div>
    </section>

    {{-- Lokasi --}}
    <section id="lokasi" class="wadah bagian">
        <div class="lokasi rv">
            <div>
                <div class="overline">Lokasi</div>
                <h2>Kunjungi kami</h2>
                <p class="muted" style="line-height:2">
                    Ruko Royal, Jl. Sawangan Permai No.B2/B, Kota Depok<br>
                    Jam operasional: [JAM OPERASIONAL]<br>
                    WhatsApp: [NOMOR WHATSAPP]
                </p>
            </div>
            <div class="peta">
                <svg viewBox="0 0 400 300" style="width:100%;height:100%" aria-hidden="true">
                    <path d="M0 90H400M0 200H400M110 0V300M280 0V300" stroke="#fff" stroke-width="14"/>
                    <path d="M200 120c-22 0-38 16-38 36 0 26 38 62 38 62s38-36 38-62c0-20-16-36-38-36z" fill="#c8202b"/>
                    <circle cx="200" cy="156" r="13" fill="#fff"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- Ajakan booking --}}
    <section class="wadah bagian">
        <div class="ajakan rv">
            <h2>Siap booking?</h2>
            <p class="muted">Masuk atau daftar, lalu pilih jadwalmu.</p>
            <a href="{{ $tujuanBooking }}" class="btn">Booking Sekarang</a>
        </div>
    </section>
@endsection