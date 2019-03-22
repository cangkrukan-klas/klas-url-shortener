@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card z-depth-0">
            <div class="card-content">
                <div class="card-title">{{ __("Dashboard") }}</div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    <span class="badge">{{ \App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai }}</span>
                                    {{ __("Short URLs") }}
                                </div>
                                <div class="card-action">
                                    <a href="{{ route('admin.shorturl') }}">{{ __("Go to") }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    <span class="badge">{{ \App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai }}</span>
                                    {{ __("Custom URLs") }}
                                </div>
                                <div class="card-action">
                                    <a href="{{ route('admin.customurl') }}">{{ __("Go to") }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    <span class="badge">{{ \App\DataStatistik::query()->where('nama', 'shortlinkakses')->first()->nilai }}</span>
                                    {{ __("Accessed") }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
