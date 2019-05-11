@extends('layouts.master')
@section('content')
    <div class="card shadow-sm">
        <div class="card-body bg-light">
            <div class="row text-center" style="padding-bottom: 15px"><div class="col"><span class="text-title align-middle" style="font-size: 1.4rem">{{ __('Your Short URL') }}</span></div></div>
            <div class=" row form-group"><div class="input-group col-sm-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2"><input aria-label="" id="urlshortform" type="text" class="form-control" name="shorturl" value="https://{{ env('APP_DOMAIN') . "/" . ($result['customurl'] == "" ? $result['shorturl'] : $result['customurl']) }}" contenteditable="false" aria-describedby="urlHelp"><div class="input-group-append"><div class="input-group-text" style="padding: 0;"><button class="btn" style="padding: 0 20px 0 20px;" onclick="copytoclipboard()"><i class="fa fa-copy"></i></button></div></div></div></div>
            <div class="row form-group"><div class="col-2 mx-auto"><button type="submit" class="btn btn-primary" onclick="window.location = '{{ url('/') }}';">{{ __('Beranda') }}</button></div></div>
        </div>
    </div>
@endsection
@section('jsscript')
    <script>
        function copytoclipboard() {let copyText = document.getElementById("urlshortform");copyText.select();document.execCommand("copy");document.getElementById('urlHelp').innerHTML = "Berhasil disalin!";}
    </script>
@endsection