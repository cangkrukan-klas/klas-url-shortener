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
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h1 class="text-center">
                                {{ __('History') }} | <select id="riwayatTahun" onchange="setCurrentYear(this.value)"></select>
                            </h1>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="urlChart" style="height: 400px;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-lg-1"></div>
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

@section('jsscript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script>
        let selectRiwayatTahun = document.getElementById('riwayatTahun');
        let currentYear = new Date().getFullYear();
        let selectHTML = '';
        for (let i = currentYear; i >= 2018; i--) {
            selectHTML += '<option value="' + i + '">' + i + '</option>'
        }
        selectRiwayatTahun.innerHTML = selectHTML;
        let config = {
            type: 'line',
            data: {
                labels: ['{{ __('January') }}', '{{ __('February') }}', '{{ __('March') }}', '{{ __('April') }}', '{{ __('May') }}', '{{ __('June') }}', '{{ __('July') }}', '{{ __('August') }}', '{{ __('September') }}', '{{ __('October') }}', '{{ __('November') }}', '{{ __('December') }}'],
                datasets: [{
                    label: '{{ __('Short URL') }}',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: 'rgba(60,141,188,0.2)',
                    borderColor: 'rgba(60,141,188,0.8)',
                }, {
                    label: '{{ __('Custom URL') }}',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: 'rgba(1,222,0,0.2)',
                    borderColor: 'rgba(1,222,0,0.8)',
                }]
            },
            options: {
                animation: {
                    duration: 2000,
                },
                responsive: true,
            }
        };

        window.onload = function() {
            let context = document.getElementById('urlChart').getContext('2d');
            window.theChart = new Chart(context, config);
            updateData();
        };

        function setCurrentYear(year) {
            currentYear = year;
            updateData();
        }

        function updateData() {
            $.ajax(
                {
                    type: "GET",
                    url: '/admin/shorturl/get/chart/' + currentYear,
                    data: "",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    cache: true,
                    success: function (data) {
                        config.data.datasets[0].data = data.shorturl;
                        config.data.datasets[1].data = data.customurl;
                        window.theChart.update();
                    },

                    error: function (msg) {
                        alert(msg.responseText);
                    }
                });
        }
        let interval = setInterval(function() {
            updateData();
        }, 5000);
    </script>
@endsection
