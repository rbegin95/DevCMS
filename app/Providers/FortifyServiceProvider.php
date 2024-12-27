<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Http\Middleware\Housekeeping\HousekeepingAuthenticate;
use App\Http\Middleware\Housekeeping\CheckRank;
use App\Http\Middleware\BannedMiddleware;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CreatesNewUsers::class, function ($app) {
            return new CreateNewUser($app->make(Request::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {

        $router->aliasMiddleware('auth.session', AuthenticateSession::class);
        $router->aliasMiddleware('housekeeping.auth', HousekeepingAuthenticate::class);
        $router->aliasMiddleware('rank', CheckRank::class);
        $router->aliasMiddleware('banned', BannedMiddleware::class);

        Fortify::loginView(function () {
            return redirect()->route('home'); // Redirects to the homepage instead of loading a login view
}       );

        Fortify::registerView(function () {
            return view('auth.register');
        });
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
