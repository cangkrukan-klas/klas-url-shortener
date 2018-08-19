<?php
$_POST = array();
?>
        <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"
          href="https://i0.wp.com/klas.or.id/wp-content/uploads/2015/10/cropped-g4067.png?fit=32%2C32&amp;ssl=1"
          sizes="32x32">
    <link rel="icon"
          href="https://i1.wp.com/klas.or.id/wp-content/uploads/2015/10/cropped-g4067.png?fit=192%2C192&amp;ssl=1"
          sizes="192x192">
    <title>URL Shortener by KLAS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .row {
            margin-bottom: 3%;
        }

        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px; /* Margin bottom by footer height */
            background-color: white;
            font-family: Nunito,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Set the fixed height of the footer here */
            line-height: 60px; /* Vertically center the text there */
            background-color: #f5f5f5;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: Nunito,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif;
            line-height: 1.1;
            font-weight: bolder;
            color: inherit;
        }
    </style>
</head>
<body>
<div id="app">
    @guest
    @else
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                {{--<img src="{{ asset('img/logo.png') }}" height="48px" width="auto">--}}
                {{--</a>--}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    @endguest
    @guest
        <main class="py-4" style="margin-top: 4%;">
            @else
                <main class="py-8">
                    @endguest
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 offset-1">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 offset-md-3">
                                        <img class="img-logo" src="{{ asset('img/logo.png') }}" height="100%" width="auto">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <h2><b>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</b></h2>
                                    <p style="font-size: 18px;">oleh Kelompok Linux Arek Suroboyo</p>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-header" id="timer">Mengarahkan</div>
                                            <div class="row" style="padding-top: 20px;">
                                                <label for="tujuan" class="col-sm-2 col-form-label text-md-right">Tujuan</label>
                                                <div class="col-md-9">
                                                    <textarea id="tujuan" type="text" class="form-control" readonly>{{ $url }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Footer -->
                <footer class="footer">
                    <div class="container">
                        <div class="pull-right">
                            2018
                        </div>
                        <span class="text-muted">by <a href="https://github.com/fadhilyori">Fadhil Yori Hibatullah</a></span>
                    </div>
                </footer>
</div>
<script>
    // Set the date we're counting down to
    var countDown = 6;

    // Update the count down every 1 second
    var x = setInterval(function() {

        countDown--;

        // Output the result in an element with id="demo"
        document.getElementById("timer").innerHTML = "Mengarahkan ... (" + countDown + "d)";

        // If the count down is over, write some text
        if (countDown <= 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "Membuka ..";
            window.location = "{{ $url }}";
        }
    }, 1000);
</script>
</body>
</html>
