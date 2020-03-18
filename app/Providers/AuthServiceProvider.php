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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define Gate for Admin
        Gate::define('isAdmin',function($user){
            return $user->role = 'admin';
        });

        // Define Gate for Editor
        Gate::define('isAdmin',function($user){
            return $user->role = 'editor';
        });

        // Define Gate for Gues
        Gate::define('isAdmin',function($user){
            return $user->role = 'guest';
        });
    }
}
