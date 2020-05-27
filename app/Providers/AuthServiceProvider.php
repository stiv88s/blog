<?php

namespace App\Providers;

use App\Model\Tag;
use App\Model\User;
use App\Policies\AdminPolicy;
use App\Policies\BlockedUsersPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Model\Tag' => TagPolicy::class,
        'App\Model\User' => UserPolicy::class,
        'App\Model\Role' => RolePolicy::class,
        'App\Model\Post' => PostPolicy::class,
        'App\Model\Permission' => PermissionPolicy::class,
        'App\Model\Category' => CategoryPolicy::class,
        'App\Model\BlockedUsers' => BlockedUsersPolicy::class,
        'App\Model\Admin' => AdminPolicy::class


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('block_user','App\Policies\BlockedUsersPolicy@block');
        Gate::define('unblock_user','App\Policies\BlockedUsersPolicy@unblock');

//        Gate::define('tag', TagPolicy::class);
    }
}
