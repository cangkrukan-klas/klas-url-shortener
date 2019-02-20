@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card z-depth-0">
            <div class="card-content">
                <div class="card-title">Tambah data manual</div>
                <div class="divider"></div>
                <div class="row">
                    <form action="{{ route('admin.customurl.insert') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="input-field">
                                <input id="urlidform" type="text" class="validate" name="url_id" value="{{ isset($url_id) ? $url_id : "" }}" required autofocus>
                                <label for="urlidform">{{ __('URL ID') }}</label>
                            </div>
                        </div>

                        <div class="row" id="bg_result">
                            <div class="input-field">
                                <input id="customurlform" type="text" class="validate" name="customurl" minlength="4">
                                <label for="customurlform">{{ __('Custom URL') }}</label>
                            </div>
                        </div>

                        <div class="row" id="bg_result">
                            <div class="input-field">
                                <input id="timecreatedform" type="text" class="validate" name="created_at">
                                <label for="timecreatedform">{{ __('Created at') }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Input</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsscript')
<script>
    $(document).ready(function(){
        $('.modal').modal();
    });
    @if(isset($error))
        M.toast({html: '{{ $error }}', classes: 'red', displayLength: 10000});
    @elseif(isset($success))
        M.toast({html: '{{ $success }}', classes: 'green', displayLength: 3000});
    @endif
</script>
@endsection