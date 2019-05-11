<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function set_id(Request $request)
    {
        $locale = "id";
        $this->index($locale);
        if (isset($request->next)) {
            return redirect($request->next);
        }
        return redirect('/');
    }

    public function set_en(Request $request)
    {
        $locale = "en";
        $this->index($locale);
        if (isset($request->next)) {
            return redirect($request->next);
        }
        return redirect('/');
    }

    public function index($locale)
    {
        App::setLocale($locale);
        //store the locale in session so that the middleware can register it
        // dd($locale);
        session()->put('locale', $locale);
    }
}
