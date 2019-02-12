@extends('layouts.master')
@section('content')
        <table class="highlight">
                <thead>
                        <tr>
                                <th>No</th>
                                <th>URL</th>
                                <th>Short URL</th>
                                <th>Custom URL</th>
                        </tr>
                </thead>
                <tbody>
                @php
                        $no = 1;
                        $short_urls = App\ShortUrl::with('custom_url')->get();
                        $short_urls->map(function ($short_url) {
                                return $short_url->custom_url;
                        });
                @endphp
                @foreach($short_urls as $item)
                        <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ Illuminate\Support\Facades\Crypt::decryptString($item->url) }}</td>
                                <td>{{ Illuminate\Support\Facades\Crypt::decryptString($item->shorturl) }}</td>
                                <td>
                                        @foreach($item->custom_url as $cus_item)
                                                {{ isset($cus_item) ? (Illuminate\Support\Facades\Crypt::decryptString($cus_item->customurl) . ", ") : "" }}
                                        @endforeach
                                </td>
                        </tr>
                @endforeach
                </tbody>
        </table>
@endsection