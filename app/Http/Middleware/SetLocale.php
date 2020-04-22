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
            Session::save();
        }

        return $next($request);
    }

}
