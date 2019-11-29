<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Auth\JwtGuard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Models\User', function ($app) {
            return new User();
        });

        // add custom guard provider
        Auth::provider('custom', function ($app, array $config) {
            return new UserProvider($app->make('App\Models\User'));
        });

//        // add custom guard
//        Auth::extend('jwt', function ($app, $name, array $config) {
//            $guard = new JwtGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
//            $app->refresh('request', $guard, 'setRequest');
//            return $guard;
//        });
    }
}
