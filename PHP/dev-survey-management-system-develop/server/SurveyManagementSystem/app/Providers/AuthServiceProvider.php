<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //管理者
        Gate::define('admin', function ($user) {
            return ($user->auth_id == 1);
        });

        //編集者
        Gate::define('edit', function ($user) {
            return ($user->auth_id == 1 || $user->auth_id == 2);
        });
    }
}
