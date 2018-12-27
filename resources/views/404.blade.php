@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="alert alert-danger" style="width: 100%; text-align:center;">
            <i class="fas fa-times-circle fa-4x"></i>
            <p style="font-size: 18px"><br>Periksa kembali tautan anda, tautan tidak dapat ditemukan.</p>
            <a class="btn btn-primary" href="{{ url("/") }}">
                {{ __('Home') }}
            </a>
        </div>
    </div>
@endsection