@extends('layouts.app')

@section('content')
    <div class="container valign-wrapper" style="padding: 7%;">
        <div class="z-depth-5 grey lighten-4 row" id="inibro"
             style="display: inline-block; padding: 32px 64px 0 64px; border: 1px solid #EEE;">
            <div class="center">
                <div style="font-size: 32px;">{{ __('Login') }}</div>
            </div>

            <form method="POST" class="col s12" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf

                <div class='row'>
                    <div class='col s12'>
                    </div>
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
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" name="remember" value="{{ old('remember') ? 'checked' : '' }}">
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                    </p>
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit" name="action">{{ __('Login') }}</button>
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
