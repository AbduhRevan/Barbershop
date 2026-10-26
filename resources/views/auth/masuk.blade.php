@extends('layouts.auth')

@section('judul', 'Masuk')
@section('overline', 'Selamat datang kembali')
@section('judul_panel', 'Masuk untuk booking dan pantau jadwalmu.')

@section('ilustrasi')
    @include('partials.ilustrasi-1')
@endsection

@section('isi')
    <h2>Masuk</h2>
    <p class="muted">Gunakan email dan kata sandimu.</p>

    @if (session('sukses'))
        <div class="alert alert-sukses">{{ session('sukses') }}</div>
    @endif

    <form method="POST" action="{{ route('masuk.proses') }}" novalidate>
        @csrf

        <div class="lapangan">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autofocus>
            @error('email') <p class="galat">{{ $message }}</p> @enderror
        </div>

        <div class="lapangan" x-data="{ tampil: false }">
            <label for="kata_sandi">Kata sandi</label>
            <input id="kata_sandi" name="kata_sandi" x-bind:type="tampil ? 'text' : 'password'" type="password">
            @error('kata_sandi') <p class="galat">{{ $message }}</p> @enderror
            <button type="button" class="tautan" x-on:click="tampil = !tampil" x-text="tampil ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'">Tampilkan kata sandi</button>
        </div>

        <button type="submit" class="btn btn-penuh">Masuk</button>
    </form>

    <p class="muted teks-tengah">Belum punya akun? <a href="{{ route('daftar') }}">Daftar</a></p>
@endsection