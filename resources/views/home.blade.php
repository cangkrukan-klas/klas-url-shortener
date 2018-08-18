@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Data</h3>

                    <p>Akses</p>
                </div>
                <div class="icon">
                    <i class="fa fa-address-book"></i>
                </div>
                <a href="{{ url("home/akses") }}" class="small-box-footer">Go to
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <!-- /.box-header -->
                <div class="box-header">
                    <i class="fa fa-bookmark"></i>
                    Admin List
                </div>
                <div class="box-body table-responsive">
                    <table id="table-ruang" class="table table-bordered">
                        <thead id="tableHeader">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </thead>
                        <p hidden>{{ $i = 0 }}</p>
                        <tbody>
                        @foreach(DB::select('select * from users') as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box -->
            <!-- /.col -->
        </div>
    </div>
@endsection
