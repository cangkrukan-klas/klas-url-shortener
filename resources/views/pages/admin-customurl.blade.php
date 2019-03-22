@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card z-depth-0">
            <div class="card-content">
                <div class="card-title">{{ __('Custom URLs') }}</div>
                <div class="divider"></div>
                <div class="row">
                    <table class="striped">
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
                                <td>
                                    <div id="info-modal{{ $item->no }}" class="modal">
                                        <div class="modal-content" style="word-wrap: break-word">
                                            {{ $item->url }}
                                        </div>
                                        <div class="modal-footer">
                                            <a class="modal-close waves-effect waves-green btn-flat">{{ __('Close') }}</a>
                                        </div>
                                    </div>
                                    <a class="truncate modal-trigger" href="#info-modal{{ $item->no }}">{{ $item->url }}</a>
                                </td>
                                <td><p>{{ $item->customurl }}</p></td>
                                <td><p>{{ $item->created_at }}</p></td>
                                <td>
                                    <div id="edit-modal{{ $item->no }}" class="modal">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.customurl.update') }}" method="POST">
                                                @csrf
                                                <input name="id" value="{{ $item->id }}" hidden>
                                                <input name="created_at" value="{{ $item->created_at_full }}" hidden>
                                                <div class="row">
                                                    <div class="input-field">
                                                        <select id="urlidform" name="url_id" required>
                                                            @foreach($shorturls as $url)
                                                                <option value="{{ $url->id }}" {{ $url->id == $item->url_id ? 'selected' : '' }} >{{ Crypt::decryptString($url->url) }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="urlidform">{{ __('URL ID') }}</label>
                                                    </div>
                                                </div>

                                                <div class="row" id="bg_result">
                                                    <div class="input-field">
                                                        <input id="customurlform" type="text" class="validate"
                                                               name="customurl" minlength="4"
                                                               value="{{ $item->customurl }}">
                                                        <label for="customurlform">{{ __('Custom URL') }}</label>
                                                    </div>
                                                </div>

                                                <div class="row" id="bg_result" hidden>
                                                    {{ date_default_timezone_set("Asia/Jakarta") }}
                                                    <div class="input-field">
                                                        <input id="timeupdatedform" type="text" class="validate"
                                                               name="updated_at" value="{{ date("Y-m-d H:i:s") }}">
                                                        <label for="timeupdatedform">{{ __('Updated at') }}</label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <button class="btn waves-effect waves-light" type="submit"
                                                            name="action">{{ __('Update') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <a class="waves-effect waves-light btn blue modal-trigger"
                                       href="#edit-modal{{ $item->no }}"><i class="material-icons">edit</i></a>

                                    <div id="delete-modal{{ $item->no }}" class="modal">
                                        <div class="modal-content">
                                            <h4>{{ __('Are you sure?') }}</h4>
                                            <p>{{ __('This data cannot be returned after being deleted.') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form class="right"
                                                  action="{{ route('admin.customurl.delete', ['id' =>$item->id]) }}"
                                                  method="GET">
                                                <button class="modal-close waves-effect waves-green btn-flat"
                                                        type="submit">{{ __('Sure, I understand') }}</button>
                                            </form>
                                            <a href="{{ route('admin.customurl') }}"
                                               class="modal-close waves-effect waves-green btn-flat">{{ __('No, cancel') }}</a>
                                        </div>
                                    </div>
                                    <a class="waves-effect waves-light btn red modal-trigger" href="#delete-modal{{ $item->no }}"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
