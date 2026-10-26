<header class="header">
    <a href="{{ route('beranda') }}" class="logo">
        <span class="tiang"></span><strong>ROEANG TJOEKOER</strong>
    </a>
    <nav class="nav">
        <a href="{{ route('beranda') }}">Beranda</a>
        <a href="{{ route('katalog') }}">Layanan</a>
        @auth
            @if (auth()->user()->isPelanggan())
                <a href="#">Booking</a>
                <a href="#">Riwayat</a>
            @else
                <a href="{{ \App\Http\Controllers\AuthController::tujuan(auth()->user()) }}">Panel</a>
            @endif
            <span class="muted">{{ auth()->user()->nama }}</span>
            <form method="POST" action="{{ route('keluar') }}">
                @csrf
                <button type="submit" class="btn btn-garis btn-kecil">Keluar</button>
            </form>
        @else
            <a href="{{ route('masuk') }}" class="btn btn-garis btn-kecil">Masuk</a>
            <a href="{{ route('masuk') }}" class="btn btn-kecil">Booking</a>
        @endauth
    </nav>
</header>