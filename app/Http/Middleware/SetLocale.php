<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Session::has('locale')){
            $desiredLocale = $request->segment(1);
            $locale = locale()->isSupported($desiredLocale) ? $desiredLocale : locale()->fallback();
            locale()->set($locale);
            Session(['locale'=> $locale]);
        }else {

            $locale = Session::get('locale');
            locale()->set($locale);

        };

        return $next($request);
    }

}
