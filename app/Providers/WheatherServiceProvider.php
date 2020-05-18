<?php

namespace App\Providers;

use App\Service\Wheathers\Wheather;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class WheatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('wheather', function () {
            return new Wheather();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
