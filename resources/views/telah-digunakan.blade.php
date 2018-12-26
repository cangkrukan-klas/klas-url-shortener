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
        <div class="row justify-content-center">
            <div class="alert alert-warning" style="width: 100%; text-align:center;">
                <i class="fas fa-exclamation-circle fa-4x"></i><br>
                <p style="font-size: 18px">Tautan kustom telah digunakan</p>
            </div>
        </div>
    </div>
@endsection