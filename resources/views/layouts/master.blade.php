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
    <link type="text/css" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/brands.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/solid.min.css') }}" rel="stylesheet">

</head>
<body id="app">
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light hide-on-lg-up">
        <a class="navbar-brand" href="https://klas.or.id"><img height="54px" width="auto" alt="KLAS LOGO"
                                                               src="{{ asset('img/logo.png') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/cangkrukan-klas/klas-url-shortener">
                        <i class="fab fa-github"></i>
                        GitHub Repository
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://klas.or.id">Tentang kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Tautan pendek dibuat
                        : {{ (\App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai) + (\App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai) }}</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        <div class="row hide-on-med-down">
            <div class="col-12 text-center"><a href="https://klas.or.id"><img alt="KLAS LOGO"
                                                                               src="{{ asset('img/logo.png') }}"
                                                                               width="158px"
                                                                               height="100px"></a></div>
        </div>
        <div class="row">
            <div class="col-12 text-center text-title"><h2>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</h2></div>
        </div>
        <div class="row">
            <div class="col-12 text-center text-description"><p>oleh Kelompok Linux Arek Suroboyo</p></div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 offset-sm-0 offset-md-0 offset-lg-2 text-left">
                <main style="margin-top: 0;">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->
<footer class="fixed-bottom card-footer hide-on-med-down">
    <div class="row text-center">
        <div class="col-sm-4 col-md-4 col-lg-4">2018</div>
        <div class="col-sm-4 col-md-4 col-lg-4">Tautan pendek dibuat
            : {{ (\App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai) + (\App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai) }}</div>
        <div class="col-sm-4 col-md-4 col-lg-4"><span class="text-muted"><a
                        href="https://github.com/cangkrukan-klas/klas-url-shortener"><img alt="Github Repository"
                                                                                          src="{{ asset("img/github/GitHub-Mark-32px_compressed.png") }}"
                                                                                          width="32px"
                                                                                          height="32px"></a></span>
        </div>
    </div>
</footer>
<script type="text/javascript" src="{{ asset('js/jquery.slim.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fontawesome.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/brands.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/solid.min.js') }}"></script>
@yield('jsscript')
</body>
</html>
