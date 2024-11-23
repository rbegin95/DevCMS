<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Middleware\CheckMaintenanceMode;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
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
        // Share the online users and their count across all views
        View::composer('*', function ($view) {
            $onlineUsers = User::where('online', '1')->get();
            $onlineUserCount = $onlineUsers->count();

            $view->with('onlineUsers', $onlineUsers)
                 ->with('online_user_count', $onlineUserCount);
        });

    $router = $this->app['router'];
    $router->pushMiddlewareToGroup('web', \App\Http\Middleware\CheckMaintenanceMode::class);

    }
}