<?php

namespace App\Providers;

use App\Service\Permissions\Permission;
use App\Service\Wheathers\Wheather;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('permission', function () {
            return new Permission();
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
