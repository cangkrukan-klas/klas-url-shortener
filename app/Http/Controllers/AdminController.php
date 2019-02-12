<?php

namespace App\Http\Controllers;

use App\CustomUrl;
use App\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/admin-dashboard');
    }

    public function shorturl()
    {
        $data = [];
        $i = 1;
        $short_urls = ShortUrl::with('custom_url')->get();
        $short_urls->map(function ($short_url) {
            return $short_url->custom_url;
        });
        foreach ($short_urls as $item) {
            $obj = new \stdClass();
            $obj->no = $i++;
            $obj->id = $item->id;
            $obj->url = Crypt::decryptString($item->url);
            $obj->shorturl = Crypt::decryptString($item->shorturl);
            $obj->created_at = date("j F Y", strtotime($item->created_at));
            array_push($data, $obj);
        }

        return view('pages/admin-shorturl', ['data' => $data]);
    }

    public function customurl()
    {
        $data = array();
        $i = 1;
        $short_urls = ShortUrl::with('custom_url')->get();
        $short_urls->map(function ($short_url) {
            return $short_url->custom_url;
        });
        foreach ($short_urls as $item) {
            foreach ($item->custom_url as $cus_item) {
                $obj = new \stdClass();
                $obj->no = $i++;
                $obj->id = $cus_item->id;
                $obj->url = Crypt::decryptString($item->url);
                $obj->customurl = Crypt::decryptString($cus_item->customurl);
                $obj->created_at = date("j F Y", strtotime($cus_item->created_at));
                array_push($data, $obj);
            }
        }
        return view('pages/admin-customurl', ['data' => $data]);
    }

    public function delete_shorturl($id) {
        if (Auth::check()) {
            try {
                $del = ShortUrl::query()->find($id)->delete();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return redirect(route('admin.shorturl'));
    }

    public function delete_customurl($id) {
        if (Auth::check()) {
            try {
                $del = CustomUrl::query()->find($id)->delete();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return redirect(route('admin.customurl'));
    }
}
