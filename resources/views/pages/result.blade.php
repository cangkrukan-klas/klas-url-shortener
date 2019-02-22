@extends('layouts.master')
@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
                <div class="form-group">
                    <label for="urlform">Tautan</label>
                    <input id="urlform" type="url" class="form-control" name="url" value="{{ $result['url'] }}"
                           placeholder="https://">
                </div>

            <div class="form-group">
                <label for="urlshortform">Tautan Pendek Anda</label>
                <input id="urlshortform" onclick="copytoclipboard()" type="text" class="form-control" name="shorturl" value="https://{{ env('APP_DOMAIN') . "/" . ($result['customurl'] == "" ? $result['shorturl'] : $result['customurl']) }}" contenteditable="false" aria-describedby="urlHelp">
                <small id="urlHelp" class="form-text">Klik untuk menyalin.</small>
            </div>

            <div class="form-group">
                <div class="col-2 mx-auto">
                    <button type="submit" class="btn btn-primary" onclick="window.location = '{{ url('/') }}';">
                        {{ __('Home') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsscript')
    <script>
        function copytoclipboard() {
            let copyText = document.getElementById("urlshortform");
            copyText.select();
            document.execCommand("copy");
            document.getElementById('urlHelp').innerHTML = "Berhasil disalin!";
        }
    </script>
@endsection