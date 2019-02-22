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
    <style> body {display: flex;min-height: 100vh;flex-direction: column;}  main {flex: 1 0 auto;}  .dropdown-custom {top: 56px !important;width: 100% !important;height: auto !important;}</style>
</head>
<body id="app">
<header>
    <div class="navbar-fixed hide-on-med-and-up">
        <nav class="teal z-depth-0">
            <div class="nav-wrapper container">
                <a href="https://klas.or.id" class="brand-logo center"><img height="54px" width="auto" alt="KLAS LOGO"
                                                                            src="{{ asset('img/logo.png') }}"></a>
                <a href="#" data-target='dropdown1' class='dropdown-trigger left'><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>

    <ul id='dropdown1' class='dropdown-content dropdown-custom'>
        <li><a class="valign-wrapper" style="display: flex;" href="https://github.com/cangkrukan-klas/klas-url-shortener">
                <img alt="Github Repository" style="padding: 2px;" width="30px" height="auto" src="{{ asset("img/github/GitHub-Mark-32px.png") }}">
                GitHub Repository
            </a>
        </li>
        <li><a href="https://klas.or.id">Tentang kami</a> </li>
        <li class="divider" tabindex="-1"></li>
        <li><a href="#!">Tautan pendek dibuat : {{ (\App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai) + (\App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai) }}</a></li>
    </ul>
</header>
<main>
    <div class="container valign-wrapper">
        <div class="row center-align" style="padding-top: 6%;">
            <div class="col s12 m12 l12">
                <div class="row center-align hide-on-small-only">
                    <a href="https://klas.or.id"><img class="responsive-img" alt="KLAS LOGO"
                                                      src="{{ asset('img/logo.png') }}" width="158px" height="100px"></a>
                </div>
                <div class="row center-align flow-text">
                    <h4>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</h4>
                    <p class="hide-on-small-only">oleh Kelompok Linux Arek Suroboyo</p>
                </div>
                <div class="col s12 m8 l8 offset-s0 offset-m2 offset-l2 left-align">
                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div></main>
<!-- Footer -->
<footer class="footer-copyright">
    <div class="row valign-wrapper center-align hide-on-small-only">
        <div class="col s4 m4 l4">2018</div>
        <div class="col s4 m4 l4">Tautan pendek dibuat
            : {{ (\App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai) + (\App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai) }}</div>
        <div class="col s4 m4 l4"><span class="text-muted"><a
                        href="https://github.com/cangkrukan-klas/klas-url-shortener"><img alt="Github Repository" src="{{ asset("img/github/GitHub-Mark-32px_compressed.png") }}" width="32px" height="32px"></a></span></div>
    </div>
</footer>
<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('jsscript')
</body>
</html>
