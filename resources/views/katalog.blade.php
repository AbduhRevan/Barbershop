@extends('layouts.situs')

@section('judul', 'Layanan & Paket')

@section('isi')
    @php $tujuanBooking = auth()->check() ? '#' : route('masuk'); @endphp

    <div x-data="{ pilih: '{{ request('kategori', 'semua') }}', member: false }">
        <section class="wadah bagian-atas">
            <div class="overline">Katalog</div>
            <h1 class="judul-halaman">Layanan &amp; Paket</h1>
            <p class="muted pengantar">Pilih kategori untuk melihat layanan. Harga paket bisa dilihat untuk member maupun non-member.</p>

            <div class="chip-baris">
                <button type="button" class="chip" :class="{ 'aktif': pilih === 'semua' }" @click="pilih = 'semua'">Semua</button>
                @foreach ($kategori as $k)
                    <button type="button" class="chip" :class="{ 'aktif': pilih === '{{ $k->id_kategori }}' }" @click="pilih = '{{ $k->id_kategori }}'">{{ $k->nama_kategori }}</button>
                @endforeach
            </div>
        </section>

        <section class="wadah bagian">
            <div class="kisi-3">
                @foreach ($kategori as $k)
                    @php $h = \App\Support\Format::hiasanKategori($k->nama_kategori); @endphp
                    @foreach ($k->layanan as $l)
                        <div class="kartu-layanan lift {{ $loop->parent->even ? 'tint-merah' : 'tint-biru' }}"
                             x-show="pilih === 'semua' || pilih === '{{ $k->id_kategori }}'" x-transition.opacity>
                            <div class="kartu-layanan-atas">
                                <svg viewBox="0 0 100 100" width="44" height="44" aria-hidden="true"><use href="#{{ $h['simbol'] }}"/></svg>
                                <div class="label-baris">
                                    <span class="label">{{ $l->durasi_menit }} menit</span>
                                    @if ($l->syarat_staf === 'khusus_terapis_wanita')
                                        <span class="label">Terapis wanita</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <strong>{{ $l->nama_layanan }}</strong>
                                <div class="harga">{{ \App\Support\Format::rupiah($l->harga_non_member) }}</div>
                                @if ((float) $l->harga_member < (float) $l->harga_non_member)
                                    <div class="harga-member">Member {{ \App\Support\Format::rupiah($l->harga_member) }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>

        <section class="wadah bagian">
            <div class="judul-baris">
                <div>
                    <div class="overline">Paket</div>
                    <h2>Paket hemat</h2>
                </div>
                <div class="saklar">
                    <button type="button" :class="{ 'aktif': !member }" @click="member = false">Non-member</button>
                    <button type="button" :class="{ 'aktif': member }" @click="member = true">Member</button>
                </div>
            </div>
            <div class="kisi-4">
                @foreach ($paket as $p)
                    <div class="kartu-paket lift {{ $p->nama_paket === 'Platinum' ? 'sorot' : '' }}">
                        <h3>{{ $p->nama_paket }}</h3>
                        <p class="muted">{{ $p->layanan->pluck('nama_layanan')->implode(', ') }}</p>
                        <div class="muted kecil" x-text="member ? 'Harga member' : 'Harga non-member'">Harga non-member</div>
                        <div class="harga" x-show="!member">{{ \App\Support\Format::rupiah($p->harga_non_member) }}</div>
                        <div class="harga" x-show="member" x-cloak>{{ \App\Support\Format::rupiah($p->harga_member) }}</div>
                        <a href="{{ $tujuanBooking }}" class="btn btn-penuh">Booking paket</a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection