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
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->

    <!-- /.box-footer -->
</div>
<!-- /.box -->

@endsection