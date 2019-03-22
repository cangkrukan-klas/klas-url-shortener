@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __('Custom URLs') }}
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-table"></i> {{ __('Custom URLs') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="shorturl-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 3%">{{ __('No') }}</th>
                            {{--<th>ID</th>--}}
                            <th style="width: 40%">{{ __('URL') }}</th>
                            <th style="width: 20%">{{ __('Custom URL') }}</th>
                            <th style="width: 20%">{{ __('Date') }}</th>
                            <th style="width: 10%">{{ __('Option') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td><p>{{ $item->no }}</p></td>
                                {{--<td>{{ $item->id }}</td>--}}
                                <td>{{ $item->url }}</td>
                                <td><p>{{ $item->customurl }}</p></td>
                                <td><p>{{ $item->created_at }}</p></td>
                                <td>
                                    <div class="modal fade" id="edit-modal{{ $item->no }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.customurl.update') }}" method="POST">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">{{ __('Are you sure?') }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        @csrf
                                                        <input name="id" value="{{ $item->id }}" hidden>
                                                        <input name="created_at" value="{{ $item->created_at_full }}"
                                                               hidden>
                                                        <div class="form-group">
                                                            <label for="urlidform">{{ __('URL ID') }}</label>
                                                            <select id="urlidform" name="url_id" class="form-control"
                                                                    required>
                                                                @foreach($shorturls as $url)
                                                                    <option value="{{ $url->id }}" {{ $url->id == $item->url_id ? 'selected' : '' }} >{{ Crypt::decryptString($url->url) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="customurlform">{{ __('Custom URL') }}</label>
                                                            <input type="text" class="form-control" id="customurlform"
                                                                   name="customurl" minlength="4"
                                                                   value="{{ $item->customurl }}" required>
                                                        </div>

                                                        <div class="form-group" hidden>
                                                            {{ date_default_timezone_set("Asia/Jakarta") }}
                                                            <label for="timeupdatedform">{{ __('Updated at') }}</label>
                                                            <input type="text" class="form-control" id="timeupdatedform"
                                                                   name="updated_at" value="{{ date("Y-m-d H:i:s") }}"
                                                                   required>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal edit-->

                                    <button type="button" class="btn btn-default bg-blue" data-toggle="modal"
                                            data-target="#edit-modal{{ $item->no }}">
                                        <span class="fa fa-pencil-alt"></span>
                                    </button>

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
                                                    <p>{{ __('This data cannot be returned after being deleted.') }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                            data-dismiss="modal">{{ __('No, cancel') }}</button>
                                                    <form class="right"
                                                          action="{{ route('admin.customurl.delete', ['id' =>$item->id]) }}"
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
                                    <!-- /.modal delete -->

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