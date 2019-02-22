@extends('layouts.master')
@section('content')
    @if(isset($error))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Kesalahan!</strong> {{ $error }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
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
                    <div class="col-auto" id="customurlform" style="padding-left: 0; padding-right: 0;">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">https://s.klas.or.id/</div>
                            </div>
                            <input type="text" class="validate" name="customurl" minlength="4"
                                   placeholder="cangkruk'an-2019">
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
@endsection
@section('jsscript')
    @if(isset($error))
        <script>$('.alert').alert()</script>
    @endif
@endsection