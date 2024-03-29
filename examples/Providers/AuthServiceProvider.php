<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Seblhaire\Specialauth\Models\User;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {

        Gate::define('is_admin', function ($user) {
            return $user->hasRole('administrator');
        });

        Gate::define('is_contributor', function ($user) {
            return $user->hasRole('contributor');
        });
    }
}
