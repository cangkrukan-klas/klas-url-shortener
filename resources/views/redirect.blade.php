@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="alert alert-success" style="width: 100%; text-align:center;">
            <i class="fas fa-check-circle fa-4x"></i>
            <p style="font-size: 18px" id="timer"><br>Mengarahkan</p>
            <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80ch;">{{ $url }}</p>
        </div>
    </div>
@endsection

@section('jsscript')
    <script>
        // Set the date we're counting down to
        let countDown = 4;
        // Update the count down every 1 second
        let x = setInterval(function () {
            countDown--;
            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = "<br>Mengarahkan ... (" + countDown + "d)";
            // If the count down is over, write some text
            if (countDown <= 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "<br>Membuka ..";
                window.location = "{{ $url }}";
            }
        }, 1000);
    </script>
@endsection