@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __("Dashboard") }}
                <small>{{ __('Some info') }}</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-tachometer-alt"></i> {{ __('Dashboard') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ \App\DataStatistik::query()->where('nama', 'shortlinkgenerate')->first()->nilai }}</h3>

                                    <p>{{ __("Short URLs") }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-link"></i>
                                </div>
                                <a href="{{ route('admin.shorturl') }}" class="small-box-footer">{{ __('More info') }}
                                    <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green-gradient">
                                <div class="inner">
                                    <h3>{{ \App\DataStatistik::query()->where('nama', 'shortlinkcustom')->first()->nilai }}</h3>

                                    <p>{{ __("Custom URLs") }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-link"></i>
                                </div>
                                <a href="{{ route('admin.customurl') }}" class="small-box-footer">{{ __('More info') }}
                                    <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-navy">
                                <div class="inner">
                                    <h3>{{ \App\DataStatistik::query()->where('nama', 'shortlinkakses')->first()->nilai }}</h3>

                                    <p>{{ __("Accessed") }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-link"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
