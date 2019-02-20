@extends('layouts.master')
@section('content')
    <form method="POST" action="{{ action('URLShortenerController@doShort')  }}" aria-label="{{ __('URL Shortener') }}">
        @csrf
        <div class="row">
            <div class="input-field">
                <input id="urlform" type="url" class="validate" name="url" value="{{ isset($url) ? $url : "" }}" aria-errormessage="Masukkan tautan yang ingin Anda singkat" required autofocus>
                <label for="urlform">{{ __('Tautan') }}</label>
            </div>
        </div>

        <div class="row" id="bg_result">
            <div class="input-field">
                <div class="col" style="padding: 0"><h6>https://s.klas.or.id/</h6></div>
                <div class="col " style="padding: 0"><input id="customurlform" type="text" class="validate" name="customurl" minlength="4" maxlength="40"
                                        placeholder="                (opsional)"></div>
            </div>
        </div>

        <div class="row">
            <button class="btn waves-effect waves-light" type="submit" name="action">Short</button>
        </div>
    </form>
@endsection
@section('jsscript')
    @if(isset($error))
        <script>M.toast({html: '{{ $error }}', classes: 'red', displayLength: 10000})</script>
    @endif
@endsection