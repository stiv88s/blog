<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PostMiddleware
{

    protected $guard1;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $guards = ['web', 'admin'];
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $this->guard1 = $guard;
                return $next($request);
            }
        }

        if (!$this->guard1) {

            return redirect('/');
        }
    }
}
