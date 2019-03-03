@extends('layouts.master')
@section('content')
    @if(isset($error))
        <div class="alert alert-danger alert-dismissible fade show justify-content-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Kesalahan!</strong> {{ $error }}
        </div>

        <div class="card shadow-sm">
            <div class="card-body bg-light justify-content-center">
                Buat tautan pendek anda disini gratis
                <div class="row">
                    <div class="col-3 mx-auto">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 16px 10px 16px" onclick="window.location = '{{ url('/') }}';">
                            {{ __('Buat Sekarang') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="card shadow-sm">
        <div class="card-body bg-light">
            <form method="POST" action="{{ action('URLShortenerController@doShort')  }}" aria-label="{{ __('URL Shortener') }}">
                @csrf
                <div class="form-group">
                    <label for="urlform">Tautan</label>
                    <input id="urlform" type="url" class="form-control" name="url" value="{{ isset($url) ? $url : "" }}"
                           placeholder="https://" aria-describedby="urlHelp" required autofocus>
                    <small id="urlHelp" class="form-text text-muted">Masukkan tautan yang ingin Anda singkat.</small>
                </div>

                <div class="form-group">
                    <label for="customurlform">Tautan Pendek Kustom (opsional)</label>
                    <div class="row justify-content-center" id="customurlform" style="padding-left: 0; padding-right: 0;">
                        <div class="input-group col">
                            <div class="input-group-prepend">
                                <div class="input-group-text">https://s.klas.or.id/</div>
                            </div>
                            <input type="text" class="form-control" name="customurl" minlength="4"
                                   placeholder="cangkruk'an-2019 (contoh)">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-2 mx-auto">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection
@section('jsscript')
    @if(isset($error))
        <script>$('.alert').alert()</script>
    @endif
@endsection