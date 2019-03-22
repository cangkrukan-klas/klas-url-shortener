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
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
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
<header {{ \Request::is('admin/*') ? '' : 'hidden' }}>
    <nav class="navbar-fixed teal z-depth-0">
        <div class="nav-wrapper">
            <a href="#" data-target='slide-out' class='sidenav-trigger show-on-small show-on-medium-and-up left'><i class="material-icons">menu</i></a>
            <span class="white-text center"
                  style="margin-top: 0; margin-bottom: 0; width: 100%;">{{ __('Admin Page') }}</span>
            <span class="right"><a href="{{ url('logout') }}"
                                   class="btn waves-effect waves-light red">{{ __('Logout') }}</a></span>
        </div>
    </nav>

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><div class="user-view">
                <div class="background teal"></div>
                <img class="circle" src="{{ asset("img/logo-192x192.png") }}">
                <span class="white-text name">{{ \Auth::user()['name'] }}</span>
                <span class="white-text email">{{ \Auth::user()['email'] }}</span>
            </div></li>
        <li class="{{ (\Route::current()->getName() == 'admin.dashboard') ? 'active' : '' }}"><a
                    href="{{ route('admin.dashboard') }}" class="waves-effect"><i
                        class="material-icons">dashboard</i>{{ __('Dashboard') }}</a></li>
        <li class="{{ \Route::current()->getName() == 'admin.shorturl' ? 'active' : '' }}"><a
                    href="{{ route('admin.shorturl') }}" class="waves-effect"><i
                        class="material-icons">table</i>{{ __('Short URLs') }}</a></li>
        <li class="{{ \Route::current()->getName() == 'admin.customurl' ? 'active' : '' }}"><a
                    href="{{ route('admin.customurl') }}" class="waves-effect"><i
                        class="material-icons">table</i>{{ __('Custom URLs') }}</a></li>
        <li class="{{ \Route::current()->getName() == 'admin.shorturl.insert.page' ? 'active' : '' }}"><a
                    href="{{ route('admin.shorturl.insert.page') }}" class="waves-effect"><i
                        class="material-icons">add</i>{{ __('Add Short URL') }}</a></li>
        <li class="{{ \Route::current()->getName() == 'admin.customurl.insert.page' ? 'active' : '' }}"><a
                    href="{{ route('admin.customurl.insert.page') }}" class="waves-effect"><i
                        class="material-icons">add</i>{{ __('Add Custom URL') }}</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">{{ __('Setting') }}</a></li>
        <li {{ session()->get('locale') == 'en' ? 'hidden' : '' }}><a class="waves-effect"
                                                                      href="/en/?next=admin/dashboard">English</a></li>
        <li {{ session()->get('locale') == 'id' ? 'hidden' : '' }}><a class="waves-effect"
                                                                      href="/id/?next=admin/dashboard">Bahasa
                Indonesia</a></li>
        <li><a href="{{ url('logout') }}" class="waves-effect">{{ __('Logout') }}</a></li>
    </ul>
</header>
<main style="{{ \Request::is('admin/*') ? "" : "padding-left: 0 !important" }}">
    @yield('content')
</main>
<!-- Footer -->
<footer></footer>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    M.AutoInit();
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });
</script>
@yield('jsscript')
</body>
</html>
