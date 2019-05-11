@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __('Short URLs') }}
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-table"></i> {{ __('Short URLs') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="shorturl-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('No') }}</th>
                            {{--<th>ID</th>--}}
                            <th>{{ __('URL') }}</th>
                            <th>{{ __('Short URL') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Option') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->no }}</td>
                                {{--<td>{{ $item->id }}</td>--}}
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->shorturl }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="modal fade" id="delete-modal{{ $item->no }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">{{ __('Are you sure?') }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{ __('This data cannot be returned after being deleted. By deleting short link data, you will also <strong> delete custom links that have the same link </strong>.') }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                            data-dismiss="modal">{{ __('No, cancel') }}</button>
                                                    <form class="right"
                                                          action="{{ route('admin.shorturl.delete', ['id' =>$item->id]) }}"
                                                          method="GET">
                                                        <button type="submit"
                                                                class="btn btn-primary">{{ __('Sure, I understand') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <button type="button" class="btn btn-default bg-red" data-toggle="modal"
                                            data-target="#delete-modal{{ $item->no }}">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('jsscript')
    <script>
        $(document).ready(function () {
            $('#shorturl-table').DataTable();
        });
    </script>
@endsection