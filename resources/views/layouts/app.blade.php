<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="icon" href="{{ asset('img/logo-32x32.png') }}" sizes="32x32">
    <title>URL Shortener by KLAS</title>

    <!-- Styles -->
    <link type="text/css" href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.css') }}" media="screen,projection"/>
    <link type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }

        header, main, footer {
            padding-left: 300px;
        }

        @media only screen and (max-width : 992px) {
            header, main, footer {
                padding-left: 0;
            }
        }
    </style>
</head>
<body id="app">
<header>
    <nav class="navbar-fixed teal z-depth-0">
        <div class="nav-wrapper">
            <a href="#" data-target='slide-out' class='sidenav-trigger show-on-small show-on-medium-and-up left'><i class="material-icons">menu</i></a>
            <span class="white-text center" style="margin-top: 0; margin-bottom: 0; width: 100%;">Halaman Admin s.klas.or.id</span>
            <span class="right"><a href="{{ url('logout') }}" class="btn waves-effect waves-light red">Logout</a></span>
        </div>
    </nav>

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><div class="user-view">
                <div class="background teal"></div>
                <img class="circle" src="{{ asset("img/logo-192x192.png") }}">
                <span class="white-text name">Admin</span>
                <span class="white-text email">admin@example.com</span>
            </div></li>
        <li><a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="material-icons">dashboard</i>Dasboard</a></li>
        <li><a href="{{ route('admin.shorturl') }}" class="waves-effect"><i class="material-icons">table</i>Tautan Pendek</a></li>
        <li><a href="{{ route('admin.customurl') }}" class="waves-effect"><i class="material-icons">table</i>Tautan Custom</a></li>
        <li><a href="{{ route('admin.shorturl.insert.page') }}" class="waves-effect"><i class="material-icons">add</i>Tambah Data</a></li>
        <li><a href="{{ route('admin.customurl.insert.page') }}" class="waves-effect"><i class="material-icons">add</i>Tambah Data (Kustom)</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">Opsi</a></li>
        <li><a href="{{ url('logout') }}" class="waves-effect">Logout</a></li>
    </ul>
</header>
<main>
    @yield('content')
</main>
<!-- Footer -->
<footer></footer>
<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('jsscript')
</body>
</html>
