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
     * Decrypt the string
     *
     * @param $string
     * @return mixed
     */
    private function decrypt($string) {
        return Crypt::decryptString($string);
    }

    /**
     * Encrypt the string
     *
     * @param $string
     * @return mixed
     */
    private function encrypt($string) {
        return Crypt::encryptString($string);
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
        return view('pages/admin-shorturl');
    }

    public function shorturl_get() {
        $data = [];
        $short_urls = ShortUrl::with('custom_url')->get();
        $short_urls->map(function ($short_url) {
            return $short_url->custom_url;
        });
        foreach ($short_urls as $item) {
            $obj = new \stdClass();
            $obj->id = $item->id;
            $obj->url = $this->decrypt($item->url);
            $obj->shorturl = $this->decrypt($item->shorturl);
            $customurl = "";
            foreach ($item->custom_url as $subitem) {
                $customurl .= $this->decrypt($subitem->customurl) . ',';
            }
            $obj->customurl = $customurl;
            $obj->created_at = date("j F Y", strtotime($item->created_at));
            $obj->updated_at = date("j F Y", strtotime($item->updated_at));
            array_push($data, $obj);
        }
        return response()->json($data, 200);
    }

    public function shorturl_get_chart() {
        $data_url_short = [0,0,0,0,0,0,0,0,0,0,0,0];
        $data_url_custom = [0,0,0,0,0,0,0,0,0,0,0,0];
        $short_urls = ShortUrl::all();
        $custom_urls = CustomUrl::all();
        foreach ($short_urls as $item) {
            if (date('Y', strtotime($item->created_at)) == date('Y')) {
                $idx = date('n', strtotime($item->created_at));
                $data_url_short[$idx - 1] += 1;
            }
        }
        foreach ($custom_urls as $item) {
            if (date('Y', strtotime($item->created_at)) == date('Y')) {
                $idx = date('n', strtotime($item->created_at));
                $data_url_custom[$idx - 1] += 1;
            }
        }
        return response()->json(['shorturl' => $data_url_short, 'customurl' => $data_url_custom], 200);
    }

    public function customurl()
    {
        return view('pages/admin-customurl');
    }

    public function customurl_get() {
        $data = array();
        $custom_urls = CustomUrl::all();
        foreach ($custom_urls as $item) {
                $obj = new \stdClass();
                $obj->id = $item->id;
                $obj->url_id = $item->url_id;
                $obj->url = $this->decrypt(ShortUrl::query()->find($item->url_id)->url);
                $obj->shorturl = $this->decrypt(ShortUrl::query()->find($item->url_id)->shorturl);
                $obj->customurl = $this->decrypt($item->customurl);
                $obj->created_at = date("j F Y", strtotime($item->created_at));
                $obj->updated_at = date("j F Y", strtotime($item->updated_at));
                array_push($data, $obj);
        }

        return response()->json($data, 200);
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

    public function update_customurl(Request $request)
    {
        $id = $request->get('id');
        $url_id = $request->get('url_id');
        $customurl = $request->get('customurl');
        $created_at = $request->get('created_at');
        $updated_at = $request->get('updated_at');
        $parse = parse_url($customurl);

        if (isset($parse['scheme'])) {
            $customurl = str_replace(array($parse['scheme'], "://", $parse['host']), "", $customurl);
        }
        $customurl = preg_replace("/[^a-zA-Z0-9 \. \-]/", "", $customurl);
        if ($customurl == "home" || $customurl == "login" || $customurl == "register") {
            return redirect(route('admin.shorturl_insert'));
        }

        $cusurl = CustomUrl::find($id);
        $cusurl->url_id = $url_id;
        $cusurl->customurl = Crypt::encryptString($customurl);
        $cusurl->created_at = $created_at;
        $cusurl->updated_at = $updated_at;
        $cusurl->save();

        return redirect(route('admin.customurl'))->with("success", "Tautan kustom telah disunting!");
    }
}
