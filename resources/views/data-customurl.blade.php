@extends('layouts.master')

@section('content')
    <div class="box box-info">

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped" width="100%">
                    <thead id="tableHeader">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>URL</th>
                        <th>Short URL</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <p hidden>{{ $i = 0 }}</p>
                    <tbody>
                    @foreach(DB::select('select * from custom_urls') as $data)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ (\App\ShortUrl::find($data->url_id)->url) }}</td>
                            <td>https://s.klas.or.id/{{ $data->customurl }}</td>
                            <td>{{ date_format(date_create($data->created_at), "d F Y") }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->

        <!-- /.box-footer -->
    </div>
    <!-- /.box -->

@endsection