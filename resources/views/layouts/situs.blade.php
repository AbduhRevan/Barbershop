<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.kepala')
    <title>@yield('judul', 'Beranda') | Roeang Tjoekoer</title>
    @stack('gaya')
</head>
<body>
    @include('partials.simbol')
    @include('partials.header')

    <main>
        @if (session('sukses'))
            <div class="wadah"><div class="alert alert-sukses">{{ session('sukses') }}</div></div>
        @endif
        @yield('isi')
    </main>

    @include('partials.footer')
    @stack('skrip')
</body>
</html>