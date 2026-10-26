<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.kepala')
    <title>@yield('judul') | Roeang Tjoekoer</title>
</head>
<body>
    @include('partials.simbol')

    <div class="panel">
        <aside class="panel-samping">
            <a href="{{ route('beranda') }}" class="logo">
                <span class="tiang"></span><strong>ROEANG TJOEKOER</strong>
            </a>

            <nav class="panel-menu">
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.booking') }}" class="{{ request()->routeIs('admin.booking') ? 'aktif' : '' }}">Booking</a>
                    <a href="#">Transaksi</a>
                    <a href="#">Layanan &amp; Paket</a>
                    <a href="#">Staf</a>
                    <a href="#">Membership</a>
                    <a href="#">Review</a>
                @else
                    <a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'aktif' : '' }}">Dashboard</a>
                    <a href="#">Laporan Pendapatan</a>
                    <a href="#">Statistik Layanan</a>
                    <a href="#">Monitoring Member</a>
                @endif
            </nav>

            <div class="pengguna-info">
                <strong>{{ auth()->user()->nama }}</strong>
                <div class="muted">{{ ucfirst(auth()->user()->peran) }}</div>
                <form method="POST" action="{{ route('keluar') }}" style="margin-top:12px">
                    @csrf
                    <button type="submit" class="btn btn-garis btn-kecil">Keluar</button>
                </form>
            </div>
        </aside>

        <section class="panel-isi">
            @if (session('sukses'))
                <div class="alert alert-sukses">{{ session('sukses') }}</div>
            @endif
            @yield('isi')
        </section>
    </div>
</body>
</html>