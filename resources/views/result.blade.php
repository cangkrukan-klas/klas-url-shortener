@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 offset-md-3">
            <img class="img-logo" src="{{ asset('img/logo.png') }}" height="100%" width="auto">
        </div>
    </div>
    <div class="row justify-content-center">
        <h2><b>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</b></h2>
        <p style="font-size: 18px;">oleh Kelompok Linux Arek Suroboyo</p>
    </div>

    <div class="form-group row">
        <label for="urlform" class="col-sm-2 col-form-label text-md-right">{{ __('URL') }}</label>

        <div class="col-md-8">
            <input id="urlform" type="url" class="form-control" name="url" value="{{ $result['url'] }}">
        </div>
    </div>

    <div class="form-group row" id="bg_result">
        <label for="resultform"
               class="col-sm-2 col-form-label text-md-right">{{ __('Short URL') }}</label>

        <div class="col-md-8">
            <div class="input-group mb-3">
                <input id="resultform" aria-describedby="basic-addon3" type="text" class="form-control" name="result" value="https://{{ env('APP_DOMAIN') . "/" . ($result['customurl'] == "" ? $result['shorturl'] : $result['customurl']) }}">
                <div class="input-group-append">
                    <button id="btn-copy" class="btn btn-outline-secondary" onclick="copytoclipboard()"
                            type="button" data-toggle="tooltip" data-placement="top"
                            title="Copy to clipboard" style="height: 37.03px; width: auto;">
                        <span><i class="fa fa-copy"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0 justify-content-center">
        <div class="col-md-8 offset-md-6" id="bg_btn">
            <a class="btn btn-primary" href="{{ url("/") }}">
                {{ __('Home') }}
            </a>
        </div>
    </div>
@endsection

@section('jsscript')
    <script>
        function copytoclipboard() {
            var copyText = document.getElementById("resultform");
            copyText.select();
            document.execCommand("copy");
            $('#btn-copy').tooltip('title="Copied: ' + copyText.value + '"');
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection