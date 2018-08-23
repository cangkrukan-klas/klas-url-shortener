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
    <div class="row justify-content-center">
        <div class="card" style="width: 100%;">
            <div class="card-header"><h4></h4></div>

            <div class="card-body">
                <div class="row justify-content-center" id="timer">
                    <div class="col-md-8">
                        <h2>Tautan custom telah terpakai</h2>
                    </div>
                </div>
                <div class="row justify-content-center" id="timer">
                    <div class="col-md-4">
                        <p>Periksa kembali tautan anda</p>
                    </div>
                </div>
                <div class="form-group row mb-0 justify-content-center">
                    <div class="col-md-8 offset-md-6" id="bg_btn">
                        <a class="btn btn-primary" href="{{ url("/") }}">
                            {{ __('Home') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection