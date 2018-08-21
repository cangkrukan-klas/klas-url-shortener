@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Data </h3>

                    <p>Admin</p>
                </div>

                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>

                <a href="{{ url("home/admin") }}" class="small-box-footer">Go to
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Data </h3>

                    <p>URL Pendek</p>
                </div>
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <a href="{{ url("home/shorturl") }}" class="small-box-footer">Go to
                    <i class="fa fa-arrow-circle-right"></i>
                </a>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Data </h3>

                    <p>Custom Url</p>
                </div>
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <a href="{{ url("home/customurl") }}" class="small-box-footer">Go to
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-link"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tautan Pendek Dibuat</span>
                    <span class="info-box-number">{{ \App\DataStatistik::where('nama', 'shortlinkgenerate')->first()->nilai }}</span>
                    <span class="info-box-more">Updated at {{ date_format(\App\DataStatistik::where('nama', 'shortlinkgenerate')->first()->updated_at, "d F Y H:i:s") }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-link"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tautan Pendek Custom Dibuat</span>
                    <span class="info-box-number">{{ \App\DataStatistik::where('nama', 'shortlinkcustom')->first()->nilai }}</span>
                    <span class="info-box-more">Updated at {{ date_format(\App\DataStatistik::where('nama', 'shortlinkcustom')->first()->updated_at, "d F Y H:i:s") }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-link"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tautan Pendek Diakses</span>
                    <span class="info-box-number">{{ \App\DataStatistik::where('nama', 'shortlinkakses')->first()->nilai }}</span>
                    <span class="info-box-more">Updated at {{ date_format(\App\DataStatistik::where('nama', 'shortlinkakses')->first()->updated_at, "d F Y H:i:s") }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
