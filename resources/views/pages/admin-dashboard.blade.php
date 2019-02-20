@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card z-depth-0">
            <div class="card-content">
                <div class="card-title">Dashboard</div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    <span class="badge">{{ \App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai }}</span>
                                    Tautan Pendek
                                </div>
                                <div class="card-action">
                                    <a href="{{ route('admin.shorturl') }}">See</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    <span class="badge">{{ \App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai }}</span>
                                    Tautan Kustom
                                </div>
                                <div class="card-action">
                                    <a href="{{ route('admin.customurl') }}">See</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    <span class="badge">{{ \App\DataStatistik::query()->where('nama', 'shortlinkakses')->first()->nilai }}</span>
                                    Tautan Diakses
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
