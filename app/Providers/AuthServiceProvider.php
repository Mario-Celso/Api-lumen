<?php

namespace App\Providers;

use App\Services\TokenManagement\TokenHandler;

use Illuminate\Support\ServiceProvider;

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
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        $this->app['auth']->viaRequest('api', function ($request) {
            //Token passed
            $token = $request

                ->header('Authorization') ? substr($request
                ->header('Authorization'), 7) : $request
                ->input('token');

            //Call the TokenHandler that returns a user if authorized or null

            $tokenHandler = new TokenHandler();

            $user = $tokenHandler->handle($token);

            return $user;
        });
    }
}
