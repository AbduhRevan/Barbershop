<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.kepala')
    <title>@yield('judul') | Roeang Tjoekoer</title>
</head>
<body>
    @include('partials.simbol')

    <div class="auth">
        <div class="auth-panel">
            <a href="{{ route('beranda') }}" class="logo">
                <span class="tiang"></span><strong>ROEANG TJOEKOER</strong>
            </a>
            <div>
                <div class="overline">@yield('overline')</div>
                <h1>@yield('judul_panel')</h1>
            </div>
            <div class="auth-ilustrasi">@yield('ilustrasi')</div>
        </div>

        <div class="auth-isi">
            <div class="auth-kotak">@yield('isi')</div>
        </div>
    </div>
</body>
</html>