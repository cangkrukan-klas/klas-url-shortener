@extends('layouts.app')

@section('content')
    <div class="container valign-wrapper hide-on-small-and-down" style="padding: 6%;">
        <div class="z-depth-5 grey lighten-4 row" id="inibro"
             style="display: inline-block; padding: 32px 64px 0 64px; border: 1px solid #EEE;">
            <div class="center">
                <div style="font-size: 32px;">{{ __('Register') }}</div>
            </div>

            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf

                <div class='row'>
                    <div class='col s12'>
                    </div>
                </div>

                <div class="row input-field">
                    <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required>
                    <label for="name">{{ __('Name') }}</label>
                </div>

                <div class="row input-field">
                    <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                    <label for="email">{{ __('E-Mail Address') }}</label>
                </div>

                <div class="row input-field">
                    <input id="password" type="password" class="validate" name="password" value="{{ old('password') }}" required>
                    <label for="password">{{ __('Password') }}</label>
                </div>

                <div class="row input-field">
                    <input id="password-confirm" type="password" class="validate" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit" name="action">{{ __('Register') }}</button>
                </div>

                <div class="row">
                    <span>Sudah punya akun ? <a href="{{ route('login') }}">Masuk disini</a></span>
                </div>
            </form>
        </div>
    </div>
    <div class="hide-on-med-and-up">
        <nav class="navbar-fixed-top teal z-depth-0">
            <div class="nav-wrapper">
                <div class="nav-title center-align" style="display: block; padding: 0;">{{ __('Register') }}</div>
            </div>
        </nav>
        <div class="section"></div>
        <div class="container">
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf

                <div class='row'>
                    <div class='col s12'>
                    </div>
                </div>

                <div class="row input-field">
                    <input id="name" type="email" class="validate" name="name" value="{{ old('name') }}" required>
                    <label for="name">{{ __('Name') }}</label>
                </div>

                <div class="row input-field">
                    <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                    <label for="email">{{ __('E-Mail Address') }}</label>
                </div>

                <div class="row input-field">
                    <input id="password" type="password" class="validate" name="password" value="{{ old('password') }}" required>
                    <label for="password">{{ __('Password') }}</label>
                </div>

                <div class="row input-field">
                    <input id="password-confirm" type="password" class="validate" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit" name="action">{{ __('Register') }}</button>
                </div>

                <div class="row">
                    <span>{{ __('Already have an account?') }} <a
                                href="{{ route('login') }}">{{ __('Sign in here') }}</a></span>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('jsscript')
<script>
    // Set the date we're counting down to
    let countDown = 9;
    let data = ["z-depth-5", "z-depth-4", "z-depth-3", "z-depth-2", "z-depth-1", "z-depth-0"];
    let i = 0;
    // Update the count down every 1 second
    let x = setInterval(function () {
        countDown--;
        // Output the result in an element with id="demo"
        if (countDown<5) {
            if ( document.getElementById("inibro").classList.contains(data[i]) ) {
                document.getElementById("inibro").classList.replace(data[i], data[i-1]);
            }
            i--;
        } else {
            if ( document.getElementById("inibro").classList.contains(data[i]) ) {
                document.getElementById("inibro").classList.replace(data[i], data[i+1]);
            }
            i++;
        }
        // If the count down is over, write some text
        if (countDown <= 0) {
            clearInterval(x);
            if ( document.getElementById("inibro").classList.contains(data[i]) ) {
                document.getElementById("inibro").classList.replace(data[i], "z-depth-5");
            }
        }
    }, 100);
</script>
@endsection