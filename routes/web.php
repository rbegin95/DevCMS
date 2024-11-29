<?php

use App\Http\Middleware\RedirectIfUnauthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityCameraWebController;
use App\Http\Controllers\BannedController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffApplicationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\Account\AccountSettingsController;
use App\Http\Controllers\Housekeeping\CreateArticlesController;
use App\Http\Controllers\Housekeeping\DashboardController;
use App\Http\Controllers\Housekeeping\UsersController;
use App\Http\Controllers\Housekeeping\HotelAlertRCONController;
use App\Http\Controllers\Housekeeping\RoomChatlogsController;
use App\Http\Controllers\Housekeeping\PrivateChatlogsController;
use App\Http\Controllers\Housekeeping\BannedUsersController;
use App\Http\Controllers\Housekeeping\GiveBadgeController;
use App\Http\Controllers\Housekeeping\WordfilterController;
use App\Http\Controllers\Housekeeping\CameraWebController;
use App\Http\Controllers\Housekeeping\HousekeepingActivityLogController;
use App\Http\Controllers\Housekeeping\HousekeepingSiteSettingsController;
use App\Http\Controllers\Housekeeping\StaffApplicationsController;
use App\Http\Controllers\Housekeeping\PasswordRestoreController;
use App\Http\Controllers\Housekeeping\PermissionsController;
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
    RedirectIfUnauthenticated::class, // Add your custom middleware here
])->group(function () {
    Route::get('/me', [NewsController::class, 'dashboard'])->name('dashboard');
});

Route::get('/staff-application', [StaffApplicationController::class, 'create'])->name('staff.application');
Route::post('/staff-application', [StaffApplicationController::class, 'store'])->name('staff.application.submit');

/* Maintenance Page */

Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');

/* Account Settings */

Route::middleware(['auth'])->group(function () {
    Route::get('/account/', [AccountSettingsController::class, 'showPreferences'])->name('account.account');
    Route::post('/account/', [AccountSettingsController::class, 'updatePreferences'])->name('account.account.update');

    Route::get('/account/email', [AccountSettingsController::class, 'showEmailForm'])->name('account.email');
    Route::post('/account/email', [AccountSettingsController::class, 'updateEmail'])->name('account.email.update');

    Route::get('/account/password', [AccountSettingsController::class, 'showUpdatePassword'])->name('account.password');
    Route::post('/account/password', [AccountSettingsController::class, 'updatePassword'])->name('account.password.update');

});

/* Nitro Client */
Route::get('/client', NitroController::class)->name('nitro-client');

/* Community Pages */

Route::get('/community', [CommunityController::class, 'index'])->name('community');
Route::get('/articles', [NewsController::class, 'AllArticles'])->name('AllArticles');
Route::get('/articles/{id}-{name}', [NewsController::class, 'GetRecents'])->name('articles.show');
Route::post('/comments', [NewsController::class, 'storeComment'])->name('comments.store');
Route::get('/community/gotw', [CommunityController::class, 'GOTW'])->name('gotw');
Route::get('/community/leaderboards', [CommunityController::class, 'MostStuff'])->name('leaderboards');
Route::get('/community/online-players', [UserController::class, 'onlinePlayers'])->name('players');
Route::get('/community/staff', [StaffController::class, 'index'])->name('staff');

/* Photo Gallery */

Route::get('/gallery', [CommunityController::class, 'gallery'])->name('gallery');
Route::post('/gallery/{photoId}/toggle-like', [CommunityCameraWebController::class, 'toggleLike']);

/* Marketplace Pages */

Route::get('/marketplace', [MarketplaceController::class, 'showMarketplace'])->name('marketplace');

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
    // Main housekeeping entry point
    Route::get('/', function () {
        if (Auth::guard('housekeeping')->check()) {
            // Redirect authenticated users to the dashboard
            return redirect()->route('housekeeping.dashboard');
        }

        // Serve the login form if not authenticated, without changing the URL to /login
        return app()->call('App\Http\Controllers\HousekeepingAuthController@showLoginForm');
    })->name('housekeeping');

    // Explicit GET route for /housekeeping/login
    Route::get('login', [HousekeepingAuthController::class, 'showLoginForm'])->name('housekeeping.login');

    // POST route for handling login submissions
    Route::post('login', [HousekeepingAuthController::class, 'login'])->name('housekeeping.login.submit');

    // POST route for handling logout
    Route::post('logout', [HousekeepingAuthController::class, 'logout'])->name('housekeeping.logout');


    Route::middleware(['auth:housekeeping', 'rank:5'])->group(function () {
        // Dashboard route with the name `housekeeping.dashboard`
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('housekeeping.dashboard');

        /* Hotel Column */ 

        Route::get('users', [UsersController::class, 'index'])->name('housekeeping.users.index');
        Route::get('users/search', [UsersController::class, 'search'])->name('housekeeping.users.search');
        Route::get('users/clones/{user}', [UsersController::class, 'clones'])->name('housekeeping.users.clones');
        Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('housekeeping.users.edit');
        Route::put('users/{user}', [UsersController::class, 'update'])->name('housekeeping.users.update');
        Route::post('users/{user}/ban', [UsersController::class, 'banUser'])->name('housekeeping.banUser');

        Route::get('/hotel/roomchatlogs', [RoomChatlogsController::class, 'getRoomChats'])->name('housekeeping.hotel.roomchatlogs');
        Route::get('/roomchatlogs', [RoomChatlogsController::class, 'getRoomChats'])->name('housekeeping.roomchatlogs');

        Route::get('/hotel/privatechatlogs', [PrivateChatlogsController::class, 'getPrivateChats'])->name('housekeeping.hotel.privatechatlogs');
        Route::get('/privatechatlogs', [PrivateChatlogsController::class, 'getPrivateChats'])->name('housekeeping.privatechatlogs');

        Route::get('/hotel/hotel-alert', [HotelAlertRCONController::class, 'show'])->name('housekeeping.hotel.alert');
        Route::post('/hotel/hotel-alert', [HotelAlertRCONController::class, 'sendHotelAlert'])->name('hotel.alert.send');

        Route::get('/hotel/badges', [GiveBadgeController::class, 'index'])->name('housekeeping.hotel.badges');
        Route::post('/hotel/badges/give', [GiveBadgeController::class, 'giveBadge'])->name('housekeeping.hotel.givebadge');
        Route::delete('/hotel/badges/{id}', [GiveBadgeController::class, 'destroy'])->name('housekeeping.hotel.badges.destroy');

        Route::get('/hotel/wordfilters', [WordFilterController::class, 'index'])->name('housekeeping.hotel.wordfilter');
        Route::post('/wordfilter', [WordFilterController::class, 'store'])->name('housekeeping.hotel.wordfilter.store');
        Route::delete('/wordfilter/{key}', [WordFilterController::class, 'destroy'])->name('housekeeping.hotel.wordfilter.destroy');

        Route::get('/permissions', [PermissionsController::class, 'index'])->name('housekeeping.permissions.index');
        Route::put('/permissions/{rank}', [PermissionsController::class, 'updatePermissions'])->name('housekeeping.permissions.update');


        /* Website Column */
 
        Route::get('/support-tickets', [SiteSupportController::class, 'index'])->name('housekeeping.support.siteticket');
        Route::get('/support-tickets/{id}', [SiteSupportController::class, 'show'])->name('housekeeping.support.show');
        Route::post('/support-tickets/handle', [SiteSupportController::class, 'handle'])->name('housekeeping.support.handle');

        Route::get('/users/bannedusers', [BannedUsersController::class, 'index'])->name('housekeeping.users.bannedusers');
        Route::delete('/users/bannedusers/{id}', [BannedUsersController::class, 'destroy'])->name('housekeeping.users.bannedusers.destroy');

        Route::get('/camera/cameraweb', [CameraWebController::class, 'index'])->name('housekeeping.camera.cameraweb');
        Route::delete('/camera/{id}', [CameraWebController::class, 'destroy'])->name('housekeeping.camera.destroy');

        /* Admin Section Rank 7 ONLY */

        Route::get('/admin/activitylogs', [HousekeepingActivityLogController::class, 'index'])->name('housekeeping.admin.activitylogs');

        Route::get('/admin/sitesettings', [HousekeepingSiteSettingsController::class, 'index'])->name('housekeeping.admin.sitesettings');
        Route::post('/admin/sitesettings', [HousekeepingSiteSettingsController::class, 'updateSiteSettings'])
        ->name('housekeeping.admin.sitesettings.update');

        Route::get('admin/staffapps', [StaffApplicationsController::class, 'index'])->name('housekeeping.admin.staffapps');
        Route::post('admin/staffapps/promote', [StaffApplicationsController::class, 'promote'])->name('housekeeping.admin.staffapps.promote');
        Route::delete('admin/staffapps/reject', [StaffApplicationsController::class, 'reject'])->name('housekeeping.admin.staffapps.reject');

        Route::get('/password-restore', [PasswordRestoreController::class, 'showRestoreForm'])->name('housekeeping.admin.passwordrestore');
        Route::post('/password-restore', [PasswordRestoreController::class, 'restore'])->name('housekeeping.admin.passwordrestore.post');

        Route::resource('articles', CreateArticlesController::class)->names([
            'create' => 'housekeeping.articles.create',
            'store' => 'housekeeping.articles.store',
            'show' => 'housekeeping.articles.show',
            //'edit' => 'housekeeping.articles.edit',
            //'update' => 'housekeeping.articles.update',
            //'destroy' => 'housekeeping.articles.destroy',
        ]);
    });
});