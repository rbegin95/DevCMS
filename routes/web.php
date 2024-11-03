<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannedController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Housekeeping\CreateArticlesController;
use App\Http\Controllers\Housekeeping\DashboardController;
use App\Http\Controllers\Housekeeping\UsersController;
use App\Http\Controllers\HousekeepingController;
use App\Http\Controllers\HousekeepingAuthController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Housekeeping\SiteSupportController;
use App\Http\Controllers\NitroController;


/* Index Page */
Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/banned', BannedController::class, '__invoke')->name('banned');

/* Me Page */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'auth.session',
    'banned',
])->group(function () {
    Route::get('/me', [NewsController::class, 'dashboard'])->name('dashboard');
});

/* Nitro Client */
Route::get('/client', NitroController::class)->name('nitro-client');


/* Community Pages */
Route::get('/community', [CommunityController::class, 'index'])->name('community');
Route::get('/articles', [NewsController::class, 'AllArticles'])->name('AllArticles');
Route::get('/articles/{id}-{name?}', [NewsController::class, 'GetRecents'])->name('articles.show');
Route::post('/comments', [NewsController::class, 'storeComment'])->name('comments.store');
Route::get('/community/gotw', [CommunityController::class, 'GOTW'])->name('gotw');
Route::get('/community/leaderboards', [CommunityController::class, 'MostStuff'])->name('leaderboards');
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/community/online-players', [UserController::class, 'onlinePlayers'])->name('players');
Route::get('/community/staff', [StaffController::class, 'index'])->name('staff');

/* Marketplace Pages */
Route::get('/marketplace', function () {
    return view('marketplace');
})->name('marketplace');

/* Store Pages */
Route::get('/store', function () {
    return view('store');
})->name('store');

/* Help Pages */
Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/help/dev-way', function () {
    return view('theway');
})->name('theway');

Route::get('help/tickets/create', [SupportController::class, 'create'])->name('tickets.create');
Route::post('help/tickets', [SupportController::class, 'store'])->name('tickets.store');

/* HouseKeeping */

Route::prefix('housekeeping')->group(function () {
    Route::get('login', [HousekeepingAuthController::class, 'showLoginForm'])->name('housekeeping.login');
    Route::post('login', [HousekeepingAuthController::class, 'login'])->name('housekeeping.login.submit');
    Route::post('logout', [HousekeepingAuthController::class, 'logout'])->name('housekeeping.logout');

    Route::middleware(['housekeeping.auth', 'rank:5'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('housekeeping.index');

        Route::get('users', [UsersController::class, 'index'])->name('housekeeping.users.index');
        Route::get('users/search', [UsersController::class, 'search'])->name('housekeeping.users.search');
        Route::get('users/clones/{user}', [UsersController::class, 'clones'])->name('housekeeping.users.clones');
        Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('housekeeping.users.edit');
        Route::put('users/{user}', [UsersController::class, 'update'])->name('housekeeping.users.update');
        Route::post('users/{user}/ban', [UsersController::class, 'banUser'])->name('housekeeping.banUser');

        Route::post('/hotel/hotel-alert', [HousekeepingController::class, 'sendHotelAlert'])->name('housekeeping.hotel.alert');
            
        Route::get('/support-tickets', [SiteSupportController::class, 'index'])->name('housekeeping.support.siteticket');
        Route::get('/support-tickets/{id}', [SiteSupportController::class, 'show'])->name('housekeeping.support.show');
        Route::post('/support-tickets/handle', [SiteSupportController::class, 'handle'])->name('housekeeping.support.handle');



        Route::resource('articles', CreateArticlesController::class)->names([
            'index' => 'housekeeping.articles.index',
            'create' => 'housekeeping.articles.create',
            'store' => 'housekeeping.articles.store',
            'show' => 'housekeeping.articles.show',
            'edit' => 'housekeeping.articles.edit',
            'update' => 'housekeeping.articles.update',
            'destroy' => 'housekeeping.articles.destroy',
        ]);
    });
});