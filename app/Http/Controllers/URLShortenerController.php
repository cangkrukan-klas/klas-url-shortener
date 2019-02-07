<?php

namespace App\Http\Controllers;

use App\CustomUrl;
use App\DataStatistik;
use App\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class URLShortenerController extends Controller
{

    protected function randomString($length = 3) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function doShort(Request $request) {
        // Melakukan pemendekan link
        $doGenerate = 1;
        $result_2 = "";
        $url = $request->get('url');
        $customurl = $request->get('customurl');
        $parse = parse_url($customurl);
        if (isset($parse['scheme'])) {
            $customurl = str_replace(array($parse['scheme'], "://", $parse['host']), "", $customurl);
        }
        $customurl = preg_replace("/[^a-zA-Z0-9 \. \-]/", "", $customurl);
        if ($customurl == "home" || $customurl == "login" || $customurl == "register") {
            return view('welcome')->with("error", "Tautan kustom telah digunakan!");
        }

        // Check the url in database
        $url_id = 0;
        foreach (ShortUrl::all() as $item) {
            if (Crypt::decryptString($item->url) == $url) {
                $doGenerate = 0;
                $result = Crypt::decryptString($item->shorturl);
                $url_id = $item->id;
                break;
            }
        }
        if ($doGenerate == 1) {
            // Generate
            $new_short_url = new ShortUrl;
            $new_short_url->url = Crypt::encryptString($url);
            $new_short_url->shorturl = Crypt::encryptString($this->randomString());
            try {
                $new_short_url->save();
                $result = Crypt::decryptString($new_short_url->shorturl);
                $url_id = $new_short_url->id;
                try {
                    $stat = DataStatistik::query()->where('nama', 'shortlinkgenerate')->firstOrFail();
                    $stat->update([
                        'nama' => $stat->nama,
                        'nilai' => $stat->nilai + 1
                    ]);
                } catch (\Exception $e) {
                    $stat = new DataStatistik;
                    $stat->nama = 'shortlinkgenerate';
                    $stat->nilai = 1;
                    $stat->save();
                }
            } catch (\Exception $e) {
                return $e->getMessage() . "<br> at line " . $e->getLine();
            }
        }

        // Custom URL Section

        if ($customurl != "" || $customurl != null) {
            $isNewCusUrl = 1;
            foreach (CustomUrl::all() as $item) {
                if (Crypt::decryptString($item->customurl) == $customurl) {
                    return view('welcome')->with("error", "Tautan kustom telah digunakan!");
                }
            }

            if ($isNewCusUrl == 1) {
                $new_custom_url = new CustomUrl;
                $new_custom_url->url_id = $url_id;
                $new_custom_url->customurl = Crypt::encryptString($customurl);
                try {
                    $new_custom_url->save();
                    $result_2 = $customurl;
                    try {
                        $stat = DataStatistik::query()->where('nama', 'shortlinkcustom')->firstOrFail();
                        $stat->update([
                            'nama' => $stat->nama,
                            'nilai' => $stat->nilai + 1
                        ]);
                    } catch (\Exception $e) {
                        $stat = new DataStatistik;
                        $stat->nama = 'shortlinkcustom';
                        $stat->nilai = 1;
                        $stat->save();
                    }
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
        }
        $resp = [
            'url' => $url,
            'shorturl' => $result,
            'customurl' => $result_2
        ];

        return view('result', ['result' => $resp]);
    }

    public function go($shorturl) {
        $url = "";
        foreach (ShortUrl::all() as $item) {
            if (Crypt::decryptString($item->shorturl) == $shorturl) {
                $url = Crypt::decryptString($item->url);
            }
        }
        if ($url == "") {
            foreach (CustomUrl::all() as $item) {
                if (Crypt::decryptString($item->customurl) == $shorturl) {
                    $url = Crypt::decryptString(ShortUrl::find($item->url_id)->url);
                }
            }
        }
        if ($url == "") {
            return view('welcome')->with("error", "Tautan pendek yang anda masukkan tidak ditemukan");
        } else {
            try {
                $stat = DataStatistik::query()->where('nama', 'shortlinkakses')->firstOrFail();
                $stat->update([
                    'nama' => $stat->nama,
                    'nilai' => $stat->nilai + 1
                ]);
            } catch (\Exception $e) {
                $stat = new DataStatistik;
                $stat->nama = 'shortlinkakses';
                $stat->nilai = 1;
                $stat->save();
            }
        }
        return view("redirect", ['url' => $url]);
    }
}
