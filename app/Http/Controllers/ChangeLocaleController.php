<?php

namespace App\Http\Controllers;

use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Routing\Router;

class ChangeLocaleController extends Controller
{
    public function setLocale(Request $request, $user = null)
    {

        if (in_array($request->lang, array_keys(config('app.supported_locales')))) {

            app()->setLocale($request->lang);

            Session::put('locale', $request->lang);
            Session::save();

        } else {

            Session(['locale' => config('app.fallback_locale')]);
        }

        $previousUrl = \URL::previous();

        $tmp = explode('/',$previousUrl);

        $tmp[3]= app()->getLocale();
        $url = implode('/',$tmp);
//                dd($url);

        return redirect()->away($url);
//        $url = implode($tmp);
//
//        return Redirect::away($url);
//        $routeName = Route::getRoutes()->match(app('request')->create(\URL::previous()))->getName();
////        dd( $routeName );
//        return redirect()->route($routeName,app()->getLocale());

//        dd(\URL::previous()->getName);
//        dd('here');
//        app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName()
//        dd(Route::getRoutes()->match(app('request')->create(\URL::previous()))->getName());
//        return redirect()->back()->getTargetUrl().app();
//        return back();

//        return redirect()->to('/' . app()->getLocale());
    }
}
