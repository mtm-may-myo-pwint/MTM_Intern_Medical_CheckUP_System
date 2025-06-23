<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
   
    public function boot(): void
    {
        /**
         * Gate to authorize only admin users
         */
        Gate::define('is_admin', function ($user) {
            return $user->is_admin;
        });
    }
}
