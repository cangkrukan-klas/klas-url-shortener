@extends('layouts.master')
@section('content')
    <div class="card shadow-sm">
        <div class="card-body bg-light" id="timer" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <div class="row"><div class="col text-primary font-weight-bold align-middle">{{ __('Redirecting...') }}</div><div class="col text-muted text-center align-middle hide-on-med-down">{{ __('Tap for details') }}</div><div class="col"><div class="spinner-border text-primary ml-auto float-right" role="status" aria-hidden="true"></div></div></div>
            <div class="collapse" id="collapseExample"><div class="card" style="margin-top: 2%;"><div class="card-body" style="padding: 10px 10px 10px"><div class="col">{{ $url }}</div></div></div></div>
        </div>
    </div>
@endsection
@section('jsscript')
    <script>let countDown = 5;let x = setInterval(function () {countDown--;if (countDown >= 0 && countDown <= 1) {document.getElementById("timer").innerHTML = '<div class="d-flex align-items-center">' + '<strong>{{ __('Opening page...') }}</strong>' + '<div class="spinner-border text-success ml-auto" role="status" aria-hidden="true"></div></div>' + '<div class="collapse" id="collapseExample">' + '<div class="card card-body" style="margin-top: 2%;">{{ $url }}</div></div>';}if (countDown <= 0) {clearInterval(x);window.location = "{{ $url }}";}}, 1000);</script>
@endsection