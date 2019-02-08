<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Icons -->
    <link rel="icon"
          href="https://i0.wp.com/klas.or.id/wp-content/uploads/2015/10/cropped-g4067.png?fit=32%2C32&amp;ssl=1"
          sizes="32x32">
    <link rel="icon"
          href="https://i1.wp.com/klas.or.id/wp-content/uploads/2015/10/cropped-g4067.png?fit=192%2C192&amp;ssl=1"
          sizes="192x192">
    <title>URL Shortener by KLAS</title>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.css') }}" media="screen,projection"/>
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
    </style>
</head>
<body id="app">
<header>
    <div class="navbar-fixed hide-on-med-and-up">
        <nav class="teal z-depth-0">
            <div class="nav-wrapper">
                <a href="#" data-target='dropdown1' class='dropdown-trigger'><i class="material-icons">menu</i></a>
                <a href="https://klas.or.id" class="brand-logo"><img height="56px" width="auto" alt="KLAS LOGO"
                                                                                  src="{{ asset('img/logo.png') }}"></a>
            </div>
        </nav>
    </div>

    <ul id='dropdown1' class='dropdown-content'>
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
<main><div class="container valign-wrapper">
        <div class="row center-align" style="padding-top: 6%;">
            <div class="col s12 m12 l12">
                <div class="row center-align hide-on-small-only">
                    <a href="https://klas.or.id"><img class="responsive-img" alt="KLAS LOGO"
                                                      src="{{ asset('img/logo.png') }}"></a>
                </div>
                <div class="row center-align flow-text">
                    <h4>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</h4>
                    <p class="hide-on-small-only">oleh Kelompok Linux Arek Suroboyo</p>
                </div>
                <div class="col s8 m8 l8 offset-s2 offset-m2 offset-l2 left-align">
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
                        href="https://github.com/cangkrukan-klas/klas-url-shortener"><img alt="Github Repository" src="{{ asset("img/github/GitHub-Mark-32px.png") }}"></a></span></div>
    </div>
</footer>
<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
<script>
    M.AutoInit();
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>
@yield('jsscript')
</body>
</html>
