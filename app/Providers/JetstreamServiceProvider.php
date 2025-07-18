<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Fortify::loginView(function () {
            // Redirect expired sessions to the homepage
            return redirect()->route('home');
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        //Jetstream::defaultApiTokenPermissions(['read']);

        /*Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);*/
    }
}
