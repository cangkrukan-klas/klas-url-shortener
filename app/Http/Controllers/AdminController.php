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

    public function insert_shorturl_page() {
        return view('pages/admin-insert-data');
    }

    public function delete_shorturl($id)
    {
        if (Auth::check()) {
            try {
                $del = ShortUrl::query()->find($id)->delete();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return redirect(route('admin.shorturl'));
    }

    public function delete_customurl($id)
    {
        if (Auth::check()) {
            try {
                $del = CustomUrl::query()->find($id)->delete();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return redirect(route('admin.customurl'));
    }

    public function insert_shorturl(Request $request)
    {
        $is_new_short_url = 1;
        $is_new_custom_url = 1;

        // Get the data
        $url = $request->get('url');
        $shorturl = $request->get('shorturl');
        $customurl = $request->get('customurl');
        if ($customurl == "") {
            $is_new_custom_url = 0;
        }
        $created_at = $request->get('created_at');
        $parse = parse_url($customurl);

        if (isset($parse['scheme'])) {
            $customurl = str_replace(array($parse['scheme'], "://", $parse['host']), "", $customurl);
        }
        $customurl = preg_replace("/[^a-zA-Z0-9 \. \-]/", "", $customurl);
        if ($customurl == "home" || $customurl == "login" || $customurl == "register") {
            return redirect(route('admin.shorturl.insert.page'));
        }
        # Check the URL
        $url_id = 0;
        $short_url_query_all = ShortUrl::all();
        foreach ($short_url_query_all as $item) {
            if (Crypt::decryptString($item->url) == $url) {
                $url_id = $item->id;
                $is_new_short_url = 0;
                if ($customurl != "" || $customurl != null) {
                    foreach ($item->custom_url as $cus_item) {
                        if (Crypt::decryptString($cus_item->customurl) == $customurl) {
                            return redirect(route('admin.shorturl.insert.page'))->with("error", "Tautan kustom telah digunakan!");
                        }
                    }
                }
                break;
            }
        }
        // Generate
        if ($is_new_short_url == 1) {
            $check_shorturl = $shorturl;
            foreach ($short_url_query_all as $item) {
                if (Crypt::decryptString($item->shorturl) == $check_shorturl) {
                    return redirect(route('admin.shorturl.insert.page'))->with("error", "Tautan kustom telah digunakan!");
                }
            }
            $new_short_url = new ShortUrl;
            $new_short_url->url = Crypt::encryptString($url);
            $new_short_url->shorturl = Crypt::encryptString($check_shorturl);
            if ($created_at != "") {
                $new_short_url->created_at = $created_at;
                $new_short_url->updated_at = $created_at;
            }
            $new_short_url->save();
            $url_id = $new_short_url->id;
        }
        if ($is_new_custom_url == 1) {
            $new_custom_url = new CustomUrl;
            $new_custom_url->url_id = $url_id;
            $new_custom_url->customurl = Crypt::encryptString($customurl);
            if ($created_at != "") {
                $new_custom_url->created_at = $created_at;
                $new_custom_url->updated_at = $created_at;
            }
            $new_custom_url->save();
        }

        return redirect(route('admin.shorturl.insert'))->with("success", "Tautan pendek telah ditambahkan!");
    }

    public function insert_customurl_page() {
        return view('pages/admin-insert-data-custom');
    }

    public function insert_customurl(Request $request) {
        $url_id = $request->get('url_id');
        $customurl = $request->get('customurl');
        $created_at = $request->get('created_at');
        $parse = parse_url($customurl);

        if (isset($parse['scheme'])) {
            $customurl = str_replace(array($parse['scheme'], "://", $parse['host']), "", $customurl);
        }
        $customurl = preg_replace("/[^a-zA-Z0-9 \. \-]/", "", $customurl);
        if ($customurl == "home" || $customurl == "login" || $customurl == "register") {
            return redirect(route('admin.shorturl_insert'));
        }

        $new_custom_url = new CustomUrl;
        $new_custom_url->url_id = $url_id;
        $new_custom_url->customurl = Crypt::encryptString($customurl);
        if ($created_at != "") {
            $new_custom_url->created_at = $created_at;
            $new_custom_url->updated_at = $created_at;
        }
        $new_custom_url->save();
        return redirect(route('admin.customurl.insert'))->with("success", "Tautan kustom telah ditambahkan!");
    }
}
