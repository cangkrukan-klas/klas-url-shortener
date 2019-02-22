@extends('layouts.master')
@section('content')

    <div class="card shadow-sm">
        <div class="card-body" id="timer" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
             aria-controls="collapseExample">
            <div class="d-flex align-items-center">
                <strong>Mengarahkan...</strong>
                <div class="spinner-border text-primary ml-auto" role="status" aria-hidden="true"></div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="card card-body" style="margin-top: 2%;">
                    {{ $url }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsscript')
    <script>
        // Set the date we're counting down to
        let countDown = 5;
        // Update the count down every 1 second
        let x = setInterval(function () {
            countDown--;
            // Output the result in an element with id="demo"
            // document.getElementById("timer").innerHTML = "Mengarahkan ... (" + countDown + "d)";
            // If the count down is over, write some text
            if (countDown <= 1) {
                document.getElementById("timer").innerHTML = "" +
                    "<div class=\"d-flex align-items-center\">\n" +
                    "<strong>Membuka halaman...</strong>\n" +
                    "<div class=\"spinner-border text-success ml-auto\" role=\"status\" aria-hidden=\"true\"></div></div>" +
                    "<div class=\"collapse\" id=\"collapseExample\">\n" +
                    "<div class=\"card card-body\" style=\"margin-top: 2%;\">{{ $url }}</div></div>";
            }
            if (countDown <= 0) {
                clearInterval(x);
                window.location = "{{ $url }}";
            }
        }, 1000);
    </script>
@endsection