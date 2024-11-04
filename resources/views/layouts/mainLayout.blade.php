<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(13, 13, 14)">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sales Master</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" {{ Request::is('admin/home') ? 'active' : '' }} aria-current="page"
                            href="/admin/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" {{ Request::is('admin/kategori') ? 'active' : '' }}
                            href="/admin/kategori">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" {{ Request::is('admin/barang') ? 'active' : '' }}
                            href="/admin/barang">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" {{ Request::is('admin/transaksi') ? 'active' : '' }}
                            href="/admin/transaksi">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        {{-- isi dari konten --}}
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
