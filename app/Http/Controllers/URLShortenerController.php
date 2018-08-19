<?php

namespace App\Http\Controllers;

use App\CustomUrl;
use App\DataStatistik;
use App\ShortUrl;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class URLShortenerController extends Controller
{
//url = url.replace("http", "")
//url = url.replace("s://", "")
//url = url.replace("://", "")
//url = url.replace("www.", "")
//if url.endswith('/'):
//url = url[:-1]

    function randomString($length = 3) {
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
        $doGenerate = 0;
        $result = "";
        $result_2 = "";
        $url = $request->get('url');
        $customurl = $request->get('customurl');

        // Check the url in database
        try {
            $su_q = ShortUrl::where('url', $url)->firstOrFail();
        } catch (QueryException $e) {
            $doGenerate = 1;
        } catch (ModelNotFoundException $e) {
            $doGenerate = 1;
        }
        if ($doGenerate == 0) {
            $result = $su_q->shorturl;
        } else {
            // Generate
            $urlRand = $this->randomString();
            $su_q = new ShortUrl;
            $su_q->url = $url;
            $su_q->shorturl = $urlRand;
            try {
                $su_q->save();
                $result = $urlRand;
                try {
                    $stat = DataStatistik::where('nama', 'shortlinkgenerate')->firstOrFail();
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
                return redirect('/');
            }
        }

        if ($customurl != "" || $customurl != null) {
            $isNewCusUrl = 0;
            try {
                $cu_q = CustomUrl::where('customurl', $customurl)->firstOrFail();
            } catch (QueryException $e) {
                $isNewCusUrl = 1;
            } catch (ModelNotFoundException $e) {
                $isNewCusUrl = 1;
            }

            if ($isNewCusUrl == 0) {
                $result_2 = $cu_q->customurl;
            } else {
                $newCusUrl = new CustomUrl;
                $newCusUrl->url_id = $su_q->id;
                $newCusUrl->customurl = $customurl;
                try {
                    $newCusUrl->save();
                    $result_2 = $customurl;
                    try {
                        $stat = DataStatistik::where('nama', 'shortlinkcustom')->firstOrFail();
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
                    return redirect('/');
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
        $page = "redirect";
        try {
            $su_q = ShortUrl::where('shorturl', $shorturl)->firstOrFail();
            $url = $su_q->url;
        } catch (\Exception $e) {
            try {
                $su_q = CustomUrl::where('customurl', $shorturl)->firstOrFail();
                $su_q = ShortUrl::findOrFail($su_q->id);
                $url = $su_q->url;
            } catch (\Exception $e) {
                $page = "404";
            }
        }
//        return Response(['url' => $url, 'page' => $page]); // for debugging only
        if ($url != "") {
            try {
                $stat = DataStatistik::where('nama', 'shortlinkakses')->firstOrFail();
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
        return view($page, ['url' => $url]);
    }
}
