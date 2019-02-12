@extends('layouts.master')
@section('content')
        <ul class="collapsible">
            <li>
                <div class="collapsible-header valign-wrapper">
                    <p id="timer">Mengarahkan</p>
                    <span class="badge"><i class="material-icons">send</i></span></div>
                <div class="collapsible-body"><p>{{ $url }}</p></div>
            </li>
        </ul>
@endsection

@section('jsscript')
    <script>
        // Set the date we're counting down to
        let countDown = 4;
        // Update the count down every 1 second
        let x = setInterval(function () {
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