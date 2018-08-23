<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon"
          href="https://i0.wp.com/klas.or.id/wp-content/uploads/2015/10/cropped-g4067.png?fit=32%2C32&amp;ssl=1"
          sizes="32x32">
    <link rel="icon"
          href="https://i1.wp.com/klas.or.id/wp-content/uploads/2015/10/cropped-g4067.png?fit=192%2C192&amp;ssl=1"
          sizes="192x192">
    <title>URL Shortener by KLAS</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
            font-family: Nunito, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif;
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
            font-family: Nunito, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif;
            line-height: 1.1;
            font-weight: bolder;
            color: inherit;
        }
    </style>
</head>
<body>
<div id="app">
    <main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 offset-1">
                <main class="py-4" style="margin-top: 4%;">
                    @yield('content')
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
                    <span class="text-muted">by <a href="https://github.com/fadhilyori">Fadhil Yori Hibatullah</a></span>
                </div>
                <div class="col-md-7">
                    Tautan pendek dibuat : {{ (\App\DataStatistik::where('nama', 'shortlinkgenerate')->first()->nilai) + (\App\DataStatistik::where('nama', 'shortlinkcustom')->first()->nilai) }}
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('jsscript')
</body>
</html>
