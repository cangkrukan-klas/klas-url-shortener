@extends('layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <img class="img-logo" alt="KLAS LOGO" src="{{ asset('img/logo.png') }}" height="100%" width="auto">
        </div>
        <div class="row justify-content-center">
            <h2><b>PEMENDEK TAUTAN SEDERHANA DAN CEPAT</b></h2>
            <p style="font-size: 18px;">oleh Kelompok Linux Arek Suroboyo</p>
        </div>
        <form>
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
                    <div class="input-group">
                        <input id="resultform" aria-describedby="basic-addon3" type="text" class="form-control" name="result" value="https://{{ env('APP_DOMAIN') . "/" . ($result['customurl'] == "" ? $result['shorturl'] : $result['customurl']) }}">
                        <div class="input-group-append">
                            <button id="btn-copy" class="btn btn-outline-secondary" onclick="copytoclipboard()"
                                    type="button" data-toggle="tooltip" data-placement="top"
                                    title="Copy to clipboard" style="height: 36px; width: auto;">
                                <span><i class="fa fa-copy"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0 justify-content-center">
                <div class="col-md-8 offset-md-6" id="bg_btn">
                    <button class="btn btn-primary" onclick="{{ url("/") }}">
                        {{ __('Home') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('jsscript')
    <script>
        function copytoclipboard() {
            let copyText = document.getElementById("resultform");
            copyText.select();
            document.execCommand("copy");
            $('#btn-copy').tooltip('title="Copied: ' + copyText.value + '"');
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection