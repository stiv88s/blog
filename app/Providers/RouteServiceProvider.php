<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\Passport;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/admin/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapWebRoutesLocale();
        $this->mapApiAuthRoutes();

        //
    }


    protected function mapWebRoutesLocale()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->domain(config('app.host'))
            ->group(function () {
                base_path('routes/web.php');
                Route::bind('locale', function ($value) {
                    if (!in_array($value, array_keys(config('app.supported_locales')))) {
                        abort(404);
                    }
                });
            });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */

//require base_path('routes/api.php');
    protected function mapApiAuthRoutes()
    {
        Route::middleware('api')
            ->domain('api.' . config('app.host'))
            ->namespace($this->namespace)
//            base_path('routes/api.php')
            ->group(function (){
                Passport::routes();
            });
    }
//    protected function mapApiPassportRoutes()
//    {
//        Route::prefix('api')
//            ->middleware('api')
//            ->namespace($this->namespace)
////            base_path('routes/api.php')
//            ->group(function (){
//                Passport::routes();
//            });
//    }
    protected function mapApiRoutes(){
        Route::prefix('api/v1')
            ->middleware('api')
            ->domain('api' . config('app.host'))
            ->as('api1.')
            ->namespace($this->namespace)
            ->group(function (){
                require base_path('routes/api.php');

            });

    }
}
