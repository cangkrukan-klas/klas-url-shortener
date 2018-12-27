@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="alert alert-warning" style="width: 100%; text-align:center;">
            <i class="fas fa-exclamation-circle fa-4x"></i><br>
            <p style="font-size: 18px">Tautan kustom telah digunakan</p>
            <button class="btn btn-primary" onclick="{{ url("/") }}">
                {{ __('Home') }}
            </button>
        </div>
    </div>
@endsection