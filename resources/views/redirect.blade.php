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
            <div class="card-header" id="timer">Mengarahkan</div>
            <div class="row" style="padding-top: 20px;">
                <label for="tujuan" class="col-sm-2 col-form-label text-md-right">Tujuan</label>
                <div class="col-md-9">
                    <textarea id="tujuan" type="text" class="form-control" readonly>{{ $url }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsscript')
    <script>
        // Set the date we're counting down to
        var countDown = 4;

        // Update the count down every 1 second
        var x = setInterval(function() {

            countDown--;

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = "Mengarahkan ... (" + countDown + "d)";

            // If the count down is over, write some text
            if (countDown <= 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Membuka ..";
                window.location = "{{ $url }}";
            }
        }, 1000);
    </script>
@endsection