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

        <div class="modal fade" id="viewEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST" id="formSection">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalTitle"></h4>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input name="id" id="formID" value="" hidden>
                            <div class="form-group">
                                <label for="formURL">{{ __('URL') }}</label>
                                <input type="text" class="form-control" id="formURL"
                                       name="url" value="Loading ..."
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="formShortURL">{{ __('Short URL') }}</label>
                                <input type="text" class="form-control" id="formShortURL"
                                       name="shorturl" minlength="3"
                                       value="Loading ..." required>
                            </div>

                            <div class="form-group" id="formDivCustomURL">
                                <label for="formCustomURL">{{ __('Custom URL') }}</label>
                                <input type="text" class="form-control" id="formCustomURL" value="Loading ...">
                            </div>

                            <div class="form-group" id="formDivUpdatedAt">
                                <label hidden>{{ date_default_timezone_set("Asia/Jakarta") }}</label>
                                <label for="formUpdatedAt">{{ __('Updated at') }}</label>
                                <input type="text" class="form-control" id="formUpdatedAt"
                                       name="updated_at" value="{{ date("Y-m-d H:i:s") }}"
                                       required>
                            </div>

                        </div>
                        <div class="modal-footer" id="formSubmit">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal view edit-->

        <div class="modal fade" id="deleteModal">
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
                        <a id="btnDelYes" class="right btn btn-primary" href="">{{ __('Sure, I understand') }}</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal delete -->

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="shorturl-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('No') }}</th>
                            <th>{{ __('URL') }}</th>
                            <th>{{ __('Short URL') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Option') }}</th>
                        </tr>
                        </thead>
                        <tbody id="tbl_body">
                        <tr>
                            <td colspan="5">Loading</td>
                        </tr>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax(
                {
                    type: "GET",
                    url: '{{ route('admin.shorturl.get') }}',
                    data: "{}",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    cache: true,
                    success: function (data) {
                        var trHTML;

                        $.each(data, function (i, item) {

                            trHTML += '<tr><td>' + (i + 1) + '</td>';
                            trHTML += '<td>' + item.url + '</td>';
                            trHTML += '<td>' + item.shorturl + '</td>';
                            trHTML += '<td>' + item.created_at + '</td>';
                            trHTML += '<td>' + '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewEditModal" data-type="view" data-url="' + item.url + '" data-shorturl="' + item.shorturl + '" data-customurl="' + item.customurl + '" data-updatedat="' + item.updated_at + '"><i class="fas fa-eye"></i></button>' +
                                '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewEditModal" data-type="edit" data-id="' + item.id + '" data-url="' + item.url + '" data-shorturl="' + item.shorturl + '"><i class="fas fa-pencil-alt"></i></button>';
                            trHTML += '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="' + item.id + '"><i class="fas fa-trash-alt"></i></button>';
                            trHTML += '</td></tr>';
                        });
                        $('#tbl_body').empty().append(trHTML);
                        oTable = $('#shorturl-table').DataTable();
                    },

                    error: function (msg) {
                        alert(msg.responseText);
                    }
                });

            $('#viewEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var url = button.data('url');
                var shorturl = button.data('shorturl');
                var type = button.data('type');
                var modal = $(this);
                if (type === "edit") {
                    modal.find('#formDivUpdatedAt').attr('hidden', true);
                    modal.find('#formDivCustomURL').attr('hidden', true);
                    modal.find('#formSubmit').attr('hidden', false);
                    modal.find('#modalTitle').empty().append('Edit');
                    modal.find('#formID').attr('value', id);
                    modal.find('#formSection').attr('action', '{{ route('admin.shorturl.update') }}' + '?id=' + id);
                } else {
                    modal.find('#formDivUpdatedAt').attr('hidden', false);
                    modal.find('#formDivCustomURL').attr('hidden', false);
                    modal.find('#formSubmit').attr('hidden', true);
                    modal.find('#modalTitle').empty().append('View');
                    var updated_at = button.data('updatedat');
                    var customurl = button.data('customurl');
                    if (customurl === "") {
                        customurl = "{{ __("No data.") }}";
                    } else {
                        customurl = customurl.substr(0, customurl.length - 1);
                    }
                    modal.find('#formUpdatedAt').attr('value', updated_at);
                    modal.find('#formCustomURL').attr('value', customurl);
                }
                modal.find('#formURL').attr('value', url);
                modal.find('#formShortURL').attr('value', shorturl);
            });

            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#btnDelYes').attr('href', '/shorturl/delete/' + id);
            });
        });
    </script>
@endsection