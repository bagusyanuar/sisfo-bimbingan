<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <title>Document</title>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<nav class="main-header navbar navbar-expand elevation-1">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link navbar-link-item" data-widget="pushmenu" href="#" role="button"><i
                    class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/logout" class="nav-link navbar-link-item">Logout</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <div class="sidebar">
        <a href="/" class="brand-link d-flex align-items-center">
            <img src="{{ asset('assets/icon/logo-bimbingan.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image"
            >
            <span class="brand-text font-weight-light" style="font-size: 12px;">SMK MUHAMMADIYAH 1</span>
        </a>
        <div class="my-sidebar-menu">
            <ul class="nav nav-sidebar nav-pills flex-column">
                <nav class="mt-2 nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                    <li class="nav-item">
                        <a href="/"
                           class="nav-link">
                            <i class="fa fa-tachometer nav-icon" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    @if(auth()->user()->role == 'admin')
                        <li class="nav-header" style="padding: 0.5rem 1rem 0.5rem 1rem;">
                            Master Data
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Pengguna
                                    <i class="right fa fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Admin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/guru"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Guru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/siswa"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Siswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-database"></i>
                                <p>
                                    Data
                                    <i class="right fa fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/jurusan"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Jurusan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kelas"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Kelas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>
                                    Pengajuan
                                    <i class="right fa fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/pengajuan-berkas"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Pengajuan Berkas</p>
                                    </a>
                                </li>
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a href="/pengajuan-laporan"--}}
                                {{--                                       class="nav-link">--}}
                                {{--                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>--}}
                                {{--                                        <p>Pengajuan Laporan</p>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>
                                <p>
                                    Laporan
                                    <i class="right fa fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/laporan-bimbingan-proses"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Proses Bimbingan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laporan-bimbingan-selesai"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Bimbingan Selesai</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laporan-konsultasi"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Konsultasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(auth()->user()->role == 'siswa')
                        <li class="nav-item">
                            <a href="/berkas"
                               class="nav-link">
                                <i class="fa fa-sticky-note nav-icon" aria-hidden="true"></i>
                                <p>Pengajuan Berkas</p>
                            </a>
                        </li>
                        @if(Helpers::checkBerkas())
                            <li class="nav-item">
                                <a href="/pengajuan"
                                   class="nav-link">
                                    <i class="fa fa-briefcase nav-icon" aria-hidden="true"></i>
                                    <p>Pengajuan Judul</p>
                                </a>
                            </li>
                        @endif
                        @if(Helpers::checkJudul())
                            <li class="nav-item">
                                <a href="/konsultasi"
                                   class="nav-link">
                                    <i class="fa fa-briefcase nav-icon" aria-hidden="true"></i>
                                    <p>Konsultasi</p>
                                </a>
                            </li>
                        @endif
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="/password-reset"--}}
                        {{--                               class="nav-link">--}}
                        {{--                                <i class="fa fa-lock nav-icon" aria-hidden="true"></i>--}}
                        {{--                                <p>Ganti Password</p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    @endif
                    @if(auth()->user()->role == 'guru')

                        <li class="nav-item">
                            <a href="/siswa-bimbingan"
                               class="nav-link">
                                <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                                <p>Siswa Bimbingan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/konsultasi-guru"
                               class="nav-link">
                                <i class="fa fa-briefcase nav-icon" aria-hidden="true"></i>
                                <p>Konsultasi</p>
                            </a>
                        </li>
                    @endif

                </nav>
            </ul>
        </div>
    </div>
</aside>
<div class="content-wrapper p-3">
    @yield('content-title')
    @yield('content')
</div>
<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset ('/adminlte/js/adminlte.js') }}"></script>
<script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>
@yield('js')
</body>
</html>
