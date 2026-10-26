@extends('layouts.auth')

@section('judul', 'Daftar')
@section('overline', 'Akun baru')
@section('judul_panel', 'Daftar sekali, booking kapan saja.')

@section('ilustrasi')
    @include('partials.ilustrasi-2')
@endsection

@section('isi')
    <h2>Daftar Akun</h2>
    <p class="muted">Nomor WhatsApp dipakai agar kami bisa menghubungimu soal status booking.</p>

    <form method="POST" action="{{ route('daftar.proses') }}" novalidate>
        @csrf

        <div class="lapangan">
            <label for="nama">Nama</label>
            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" autofocus>
            @error('nama') <p class="galat">{{ $message }}</p> @enderror
        </div>

        <div class="lapangan">
            <label for="nomor_whatsapp">Nomor WhatsApp</label>
            <input id="nomor_whatsapp" type="tel" name="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}" placeholder="08xxxxxxxxxx">
            @error('nomor_whatsapp') <p class="galat">{{ $message }}</p> @enderror
        </div>

        <div class="lapangan">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
            @error('email') <p class="galat">{{ $message }}</p> @enderror
        </div>

        <div class="lapangan">
            <label for="kata_sandi">Kata sandi</label>
            <input id="kata_sandi" type="password" name="kata_sandi">
            @error('kata_sandi') <p class="galat">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-penuh">Daftar</button>
    </form>

    <p class="muted teks-tengah">Sudah punya akun? <a href="{{ route('masuk') }}">Masuk</a></p>
@endsection