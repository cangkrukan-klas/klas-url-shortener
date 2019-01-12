<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <main class="py-4" style="margin-top: 4%;">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <a href="https://klas.or.id"><img class="img-logo" alt="KLAS LOGO"
                                                                  src="{{ asset('img/logo.png') }}" height="100%"
                                                                  width="auto"></a>
                            </div>
                            <div class="row justify-content-center">
                                <h2><b>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</b></h2>
                                <p style="font-size: 18px;">oleh Kelompok Linux Arek Suroboyo</p>
                            </div>
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="float-right">
                2018
            </div>
            <div class="row justify-content-md-center" style="margin-bottom: 0;">
                <div class="col-md-5">
                    <span class="text-muted"><a href="https://github.com/fadhilyori/klas-url-shortener"><img alt="GitHub Logo"
                                                                                               height="24px"
                                                                                               width="auto"
                                                                                               src="{{ asset('img/github/GitHub_Logo.png') }}"></a></span>
                </div>
                <div class="col-md-7">
                    Tautan pendek dibuat
                    : {{ (\App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai) + (\App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai) }}
                </div>
            </div>
        </div>
    </footer>
</div>
@yield('jsscript')
</body>
</html>
