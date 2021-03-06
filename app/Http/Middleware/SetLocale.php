<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;

class SetLocale
{

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;

    }
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $desiredLocale = $request->segment(1);
        if (!$desiredLocale) {

            if (Session::has('locale')) {
                $locale = Session::get('locale');
                locale()->set($locale);
            }
        } else {
            $locale = locale()->isSupported($desiredLocale) ? $desiredLocale : locale()->fallback();
            locale()->set($locale);
            Session::put('locale', $locale);
//            Session::save();
        }

//        delete app()->getlocale in all routes
//        URL::defaults(['locale' => app()->getLocale()]);

        return $next($request);
    }

}
