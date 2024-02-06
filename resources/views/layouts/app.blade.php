<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.jpeg') }}" type="image/x-icon">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('extra-style')
</head>

<body class="sb-nav-fixed bg-light">
    <nav class="sb-topnav navbar navbar-expand navbar-white bg-white">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-primary" href="#">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="50" class="d-inline-block align-text-center">
            <span class="h6 fw-bold">{{ env('APP_NAME') }}</span>
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-outline-primary btn-sm rounded-pill order-lg-0 me-4 me-lg-0 order-1" id="sidebarToggle"
            href="#!">
            <i class="bi bi-text-indent-right"></i>
        </button>

        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-md-0 my-2">

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="navbarDropdown" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person"></i>{{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item d-flex items-align-center gap-2" href="{{ url('profile', []) }}">
                            <i class="bi bi-gear"></i>Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item d-flex items-align-center gap-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion bg-white" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Home</div>

                        <a class="nav-link {{ Request::is('home') ? 'bg-primary text-white' : '' }}"
                            href="{{ url('/home') }}">
                            <i class="bi bi-house"></i>
                            <span class="ms-2">Dashboard</span>
                        </a>

                        <div class="sb-sidenav-menu-heading">Menu Utama</div>

                        @if (auth()->user()->level == 'admin')
                            @include('layouts._nav_admin')
                        @endif

                        @if (auth()->user()->level == 'pegawai')
                            @include('layouts._nav_pegawai')
                        @endif
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small text-muted">User Login:</div>
                    <span class="fw-semibold">
                        {{ ucwords(auth()->user()->level) }}
                    </span>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid my-4 px-4">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <div class="d-flex flex-column">
                                <h1 class="fw-bold">@yield('title')</h1>
                                <ol class="breadcrumb text-muted">
                                    @yield('breadcrumb')
                                </ol>
                            </div>
                            <div class="d-flex gap-3">
                                @yield('button-action')
                            </div>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </main>

            <footer class="mt-auto bg-white py-4">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">
                            Powered by <strong class="text-primary">{{ env('APP_COPYRIGHT') }}</strong> &copy;
                            {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-semibold" id="logoutModalLabel">Konfirmasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Keluar Dari Aplikasi Ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak,
                        Batalkan!</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Yes, Keluar!
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @yield('extra-script')
</body>

</html>
