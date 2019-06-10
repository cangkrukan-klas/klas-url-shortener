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

                            <div class="form-group" id="formDivURLInput">
                                <label for="formURL">{{ __('URL') }}</label>
                                <input type="text" class="form-control" id="formURLInput"
                                       value="Loading ...">
                            </div>

                            <div class="form-group" id="formDivShortURL">
                                <label for="formURL">{{ __('Short URL') }}</label>
                                <input type="text" class="form-control" id="formShortURL"
                                       value="Loading ...">
                            </div>

                            <div class="form-group" id="formDivURLSelect">
                                <label for="formURL">{{ __('URL') }}</label>
                                <select id="formURL" name="url_id" class="form-control">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="formCustomURL">{{ __('Custom URL') }}</label>
                                <input type="text" class="form-control" id="formCustomURL"
                                       name="customurl" minlength="4"
                                       value="Loading ..." required>
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
        <!-- /.modal edit-->

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
                        <p>{{ __('This data cannot be returned after being deleted.') }}</p>
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
                    <table id="customurl-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 3%">{{ __('No') }}</th>
                            <th style="width: 40%">{{ __('URL') }}</th>
                            <th style="width: 20%">{{ __('Custom URL') }}</th>
                            <th style="width: 20%">{{ __('Date') }}</th>
                            <th style="width: 10%">{{ __('Option') }}</th>
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
                    url: '{{ route('admin.customurl.get') }}',
                    data: "{}",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    cache: true,
                    success: function (data) {
                        let trHTML;

                        $.each(data, function (i, item) {

                            trHTML += '<tr><td>' + (i + 1) + '</td>';
                            trHTML += '<td>' + item.url + '</td>';
                            trHTML += '<td>' + item.customurl + '</td>';
                            trHTML += '<td>' + item.created_at + '</td>';
                            trHTML += '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewEditModal" data-type="view" data-url="' + item.url + '" data-shorturl="' + item.shorturl + '" data-customurl="' + item.customurl + '" data-updatedat="' + item.updated_at + '"><i class="fas fa-eye"></i></button>';
                            trHTML += '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewEditModal" data-type="edit" data-id="' + item.id + '" data-urlid="' + item.url_id + '" data-customurl="' + item.customurl + '"><i class="fas fa-pencil-alt"></i></button>';
                            trHTML += '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="' + item.id + '"><i class="fas fa-trash-alt"></i></button>';
                            trHTML += '</td></tr>';
                        });
                        $('#tbl_body').empty().append(trHTML);
                        oTable = $('#customurl-table').DataTable();
                    },

                    error: function (msg) {
                        alert(msg.responseText);
                    }
                });

            function getOptionWithValue(sel, val) {
                let opt;
                for ( let i = 0, len = sel.options.length; i < len; i++ ) {
                    opt = sel.options[i];
                    if ( opt.value === val ) {
                        break;
                    }
                }
                return opt;
            }

            $('#viewEditModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let url = button.data('url');
                let type = button.data('type');
                let customurl = button.data('customurl');
                let modal = $(this);
                if (type === "view") {
                    let shorturl = button.data('shorturl');
                    let updated_at = button.data('updatedat');
                    modal.find('#modalTitle').empty().append("View");
                    modal.find('#formDivURLInput').attr('hidden', false);
                    modal.find('#formDivShortURL').attr('hidden', false);
                    modal.find('#formDivURLSelect').attr('hidden', true);
                    modal.find('#formSubmit').attr('hidden', true);
                    modal.find('#formDivUpdatedAt').attr('hidden', false);
                    modal.find('#formURLInput').attr('value', url);
                    modal.find('#formShortURL').attr('value', shorturl);
                    modal.find('#formUpdatedAt').attr('value', updated_at);
                } else {
                    let url_id = button.data('urlid');
                    modal.find('#formSubmit').attr('hidden', false);
                    modal.find('#formDivURLSelect').attr('hidden', false);
                    modal.find('#modalTitle').empty().append("Edit");
                    modal.find('#formDivURLInput').attr('hidden', true);
                    modal.find('#formDivShortURL').attr('hidden', true);
                    modal.find('#formDivUpdatedAt').attr('hidden', true);
                    $.ajax(
                        {
                            type: "GET",
                            url: '{{ route('admin.shorturl.get') }}',
                            data: "{}",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            cache: true,
                            success: function (data) {
                                var trHTML = '';

                                $.each(data, function (i, item) {
                                    console.log(item.id);
                                    console.log(url_id);
                                    if (item.id === url_id) {
                                        trHTML += '<option value="' + item.id + '" selected>' + item.url + '</option>';
                                    } else {
                                        trHTML += '<option value="' + item.id + '">' + item.url + '</option>';
                                    }
                                });
                                console.log(trHTML);
                                $('#formURL').empty().append(trHTML);
                            },

                            error: function (msg) {
                                alert(msg.responseText);
                            }
                        });
                }
                modal.find('#formCustomURL').attr('value', customurl);
            });

            $('#deleteModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let id = button.data('id');
                let modal = $(this);
                modal.find('#btnDelYes').attr('href', '/customurl/delete/' + id);
            });
        });
    </script>
@endsection