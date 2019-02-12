<?php

namespace App\Http\Controllers;

use App\CustomUrl;
use App\DataStatistik;
use App\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class URLShortenerController extends Controller
{

    public function doShort(Request $request)
    {
        // Melakukan pemendekan link
        $is_new_short_url = 1;
        $result_custom_url = "";
        $is_new_custom_url = 1;
        $url = $request->get('url');
        $customurl = $request->get('customurl');
        $parse = parse_url($customurl);
        if (isset($parse['scheme'])) {
            $customurl = str_replace(array($parse['scheme'], "://", $parse['host']), "", $customurl);
        }
        $customurl = preg_replace("/[^a-zA-Z0-9 \. \-]/", "", $customurl);
        if ($customurl == "home" || $customurl == "login" || $customurl == "register") {
            return view('pages/home')->with("error", "Tautan kustom tidak dapat digunakan!");
        }
        # Check the URL
        $url_id = 0;
        foreach (ShortUrl::all() as $item) {
            if (Crypt::decryptString($item->url) == $url) {
//                dd(Crypt::decryptString($item->url), $url);
                $url_id = $item->id;
                $is_new_short_url = 0;
                if ($customurl != "" || $customurl != null) {
                    foreach ($item->custom_url as $cus_item) {
                        if (Crypt::decryptString($cus_item->customurl) == $customurl) {
                            return view('pages/home', ['url' => $url])->with("error", "Tautan kustom telah digunakan!");
                        }
                    }
                }
                $result_short_url = Crypt::decryptString($item->shorturl);
                break;
            }
        }
        // Generate
        if ($is_new_short_url == 1) {
            $new_short_url = new ShortUrl;
            $new_short_url->url = Crypt::encryptString($url);
            $new_short_url->shorturl = Crypt::encryptString($this->randomString());
            $new_short_url->save();
            $result_short_url = Crypt::decryptString($new_short_url->shorturl);
            $stat = DataStatistik::query()->where('nama', 'shortlinkgenerate')->firstOrFail();
            $stat->update([
                'nama' => $stat->nama,
                'nilai' => $stat->nilai + 1
            ]);
            $url_id = $new_short_url->id;
        }
        if ($is_new_custom_url == 1) {
            $new_custom_url = new CustomUrl;
            $new_custom_url->url_id = $url_id;
            $new_custom_url->customurl = Crypt::encryptString($customurl);
            $new_custom_url->save();
            $result_custom_url = $customurl;
            $stat = DataStatistik::query()->where('nama', 'shortlinkcustom')->firstOrFail();
            $stat->update([
                'nama' => $stat->nama,
                'nilai' => $stat->nilai + 1
            ]);
        }

        $resp = [
            'url' => $url,
            'shorturl' => $result_short_url,
            'customurl' => $result_custom_url
        ];

        return view('pages/result', ['result' => $resp]);
    }

    protected function randomString($length = 3)
    {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function go($shorturl)
    {
        $url = "";
        $short_urls = ShortUrl::with('custom_url')->get();
        $short_urls->map(function ($short_url) {
            return $short_url->custom_url;
        });
        foreach ($short_urls as $item) {
            foreach ($item->custom_url as $cus_item) {
                if (Crypt::decryptString($cus_item->customurl) == $shorturl) {
                    $url = Crypt::decryptString($item->url);
                    break 2;
                }
            }
            if (Crypt::decryptString($item->shorturl) == $shorturl) {
                $url = Crypt::decryptString($item->url);
                break;
            }
        }
        if ($url == "") {
            return view('pages/home')->with("error", "Tautan pendek yang anda masukkan tidak ditemukan");
        } else {
            $stat = DataStatistik::query()->where('nama', 'shortlinkakses')->first();
            $stat->update([
                'nama' => $stat->nama,
                'nilai' => $stat->nilai + 1
            ]);
        }
        return view('pages/redirect', ['url' => $url]);
    }
}
