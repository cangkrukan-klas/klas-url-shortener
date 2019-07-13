<?php
namespace App\Http\Controllers;

use App\CustomUrl;
use App\DataStatistik;
use App\ShortUrl;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class URLShortenerController extends Controller
{
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
     * Remove URL Pattern like http://domain.com
     * Also remove unwanted char like '.' and '-'
     *
     * @param $string
     * @return string|string[]|null
     */
    private function removeUnwantedString($string) {
        $parse = parse_url($string);
        if (isset($parse['scheme'])) {
            $string = str_replace(array($parse['scheme'], "://", $parse['host']), "", $string);
        }
        $cleanString = preg_replace("/[^a-zA-Z0-9 \. \-]/", "", $string);
        return $cleanString;
    }

    /**
     * Check if the URL exist
     *
     * @param $url
     * @return array
     */
    private function findUrl($url) {
        if ($url != null || $url != "") {
            $shorturl_q = ShortUrl::all();
            if (count($shorturl_q) != 0) {
                foreach ($shorturl_q as $item) {
                    if ($this->decrypt($item->url) == $url) {
                        return ["found" => true, "id" => $item->id, "shorturl" => $item->shorturl];
                    }
                }
            }
        }
        return ["found" => false, "id" => 0, "shorturl" => ""];
    }

    /**
     * Check if the custom string that is use in custom URL already exist or not
     *
     * @param $string
     * @return array
     */
    private function findCustomUrl($customurl) {
        if ($customurl != null || $customurl != "") {
            $customurl_q = CustomUrl::all();
            if (count($customurl_q) != 0) {
                foreach ($customurl_q as $item) {
                    if ($this->decrypt($item->customurl) == $customurl) {
                        return ["found" => true, "id" => $item->id, "url_id" => $item->url_id, "customurl" => $item->customurl];
                    }
                }
            }
        }
        return ["found" => false, "id" => 0, "url_id" => 0, "customurl" => ""];
    }

    /**
     * Generate Random String with default length = 3
     *
     * @param int $length
     * @return string
     */
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

    /**
     * Generate Random String that not used yet
     *
     * @return string
     */
    private function generateUnexistRandomString() {
        $data = ShortUrl::all();
        $rand_string = $this->randomString();
        foreach ($data as $item) {
            if ($this->decrypt($item->shorturl) == $rand_string) {
                $this->generateUnexistRandomString();
                break;
            }
        }
        return $rand_string;
    }

    private function incrementStatistic($column) {
        try {
            $stat = DataStatistik::query()->where('nama', '=', $column)->firstOrFail();
            $stat->update([
                'nama' => $stat->nama,
                'nilai' => $stat->nilai + 1
            ]);
        } catch (QueryException $queryException) {
            return false;
        }
        return true;
    }

    /**
     * Build short url
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doShort(Request $request)
    {
        $token = $request->get('_token');
        $url = $request->get('url');
        $customurl = $request->get('customurl');

        if ($url != "" && $url != null) {
            $url_check = $this->findUrl($url);
            if (!$url_check['found']) {
                $newShortUrl = new ShortUrl;
                $newShortUrl->url = $this->encrypt($url);
                $newShortUrl->shorturl = $this->encrypt($this->generateUnexistRandomString());
                $newShortUrl->save();
                $url_check['found'] = true;
                $url_check['id'] = $newShortUrl->id;
                $url_check['shorturl'] = $newShortUrl->shorturl;
                $this->incrementStatistic('shortlinkgenerate');
            }
        } else {
            if ($token != "") {
                return redirect(route('home'));
            } else {
                return response()->json([
                    "error" => true,
                    "message" => "Need url, shorturl, and customurl parameter!",
                    "data" => [
                        "url" => "",
                        "shorturl" => "",
                        "customurl" => ""
                    ]
                ]);
            }
        }

        if ($customurl != "" && $customurl != null) {
            $customurl = $this->removeUnwantedString($customurl);

            if ($customurl == "home" || $customurl == "login" || $customurl == "register") {
                if ($token != "") {
                    return view('pages/home')->with("error", "Tautan kustom tidak dapat digunakan!");
                } else {
                    return response()->json([
                        "error" => true,
                        "message" => "Tautan kustom tidak dapat digunakan!",
                        "data" => [
                            "url" => $url,
                            "customurl" => $customurl
                        ]
                    ]);
                }
            }

            $customurl_check = $this->findCustomUrl($customurl);

            if (!$customurl_check['found']) {
                $newCustomUrl = new CustomUrl;
                $newCustomUrl->url_id = $url_check['id'];
                $newCustomUrl->customurl = $this->encrypt($customurl);
                $newCustomUrl->save();
                $customurl_check['found'] = true;
                $customurl_check['url_id'] = $newCustomUrl->url_id;
                $customurl_check['id'] = $newCustomUrl->id;
                $customurl_check['customurl'] = $newCustomUrl->customurl;
                $this->incrementStatistic('shortlinkcustom');
            } else {
                if ($customurl_check['url_id'] != $url_check['id']) {
                    if ($token != "") {
                        return view('pages/home', ['url' => $url])->with("error", "Tautan kustom telah digunakan!");
                    } else {
                        return response()->json([
                            "error" => true,
                            "message" => "Tautan kustom telah digunakan!",
                            "data" => [
                                "url" => $url,
                                "customurl" => $customurl
                            ]
                        ]);
                    }
                }
            }
        }

        if ($token != "") {
            return view('pages/result', ['result' => [
                'url' => $url,
                'shorturl' => $this->decrypt($url_check['shorturl']),
                'customurl' => isset($customurl_check) ? $this->decrypt($customurl_check['customurl']) : ""
            ]]);
        } else {
            return response()->json([
                "error" => false,
                "message" => "success",
                "data" => [
                    "url" => $url,
                    "shorturl" => $this->decrypt($url_check['shorturl']),
                    "customurl" => isset($customurl_check) ? $this->decrypt($customurl_check['customurl']) : ""
                ]
            ]);
        }
    }

    /**
     * Redirect to the URL
     *
     * @param $shorturl
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function go($shorturl)
    {
        $url = "";
        $short_urls = ShortUrl::with('custom_url')->get();
        foreach ($short_urls as $item) {
            foreach ($item->custom_url as $cus_item) {
                if ($this->decrypt($cus_item->customurl) == $shorturl) {
                    $url = $this->decrypt($item->url);
                    break 2;
                }
            }
            if ($this->decrypt($item->shorturl) == $shorturl) {
                $url = $this->decrypt($item->url);
                break;
            }
        }
        if ($url == "") {
            return view('pages/home')->with("error", "Tautan pendek yang anda masukkan tidak ditemukan");
        }
        if ($url != "") {
            $this->incrementStatistic('shortlinkakses');
        }
        return view('pages/redirect', ['url' => $url]);
    }
}