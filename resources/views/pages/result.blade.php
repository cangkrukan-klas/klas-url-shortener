@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="input-field">
                <input id="urlform" type="url" class="validate" name="url" value="{{ $result['url'] }}">
                <label for="urlform">{{ __('URL') }}</label>
            </div>
        </div>

        <div class="row" id="bg_result">
            <div class="input-field">
                <input id="resultform" type="text" onclick="copytoclipboard()" class="validate" name="result" value="https://{{ env('APP_DOMAIN') . "/" . ($result['customurl'] == "" ? $result['shorturl'] : $result['customurl']) }}">
                <label for="resultform">{{ __('Short URL') }}</label>
            </div>
        </div>

        <div class="row center-align">
                <button type="submit" class="btn waves-effect waves-light" onclick="window.location = '{{ url('/') }}';">
                    {{ __('Home') }}
                </button>
        </div>
@endsection

@section('jsscript')
    <script>
        function copytoclipboard() {
            let copyText = document.getElementById("resultform");
            copyText.select();
            document.execCommand("copy");
            M.toast({html: 'Tautan pendek telah disalin!', displayLength: 3000})
        }
    </script>
@endsection