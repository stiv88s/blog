<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChangeLocaleController extends Controller
{
    public function setLocale(Request $request)
    {

        if (in_array($request->lang, array_keys(config('app.supported_locales')))) {

            app()->setLocale($request->lang);

            Session::put('locale',$request->lang);
            Session::save();

        } else {

            Session(['locale' => config('app.fallback_locale')]);
        }

        return redirect()->to('/' . app()->getLocale());
    }
}
