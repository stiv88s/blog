<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ActivatedMiddleware
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
        if (Auth::user()->status == 0) {
            Auth::logout();
            Session::flash('status', 'You have been disabled, please contact administrator');
            return redirect('/');
        }

        if (Auth::user()->active_to && Auth::user()->status == 1) {
            $date = Carbon::now();
            $newDate = $date->setTimezone('+03:00');
            $blockedTime = Auth::user()->active_to;
            $needed = $newDate->format('Y-m-d H:i:s');

            if ($needed >= $blockedTime) {
                Auth::user()->status = 0;
                Auth::user()->save();
                Session::flash('status', 'You have been disabled, please contact administrator');
                Auth::logout();
                return redirect('/');
            }
        }

        return $next($request);
    }
}
