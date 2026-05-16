<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Http\Controllers\WelcomePageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeoSettingController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Backend\Frontend_Management\ContactCardController;
use App\Http\Controllers\Backend\Frontend_Management\AboutSectionController;
use App\Http\Controllers\Backend\Frontend_Management\ProjectSectionController;
use App\Http\Controllers\Backend\Frontend_Management\SubProjectSectionController;
use App\Http\Controllers\Backend\Frontend_Management\KeyActivityController;
use App\Http\Controllers\Backend\Frontend_Management\SkillSectionController;
use App\Http\Controllers\Backend\Frontend_Management\NewsController;
use App\Http\Controllers\Backend\Frontend_Management\NewsSectionController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemProblemController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\BanUserController;
use App\Http\Controllers\BannedDeviceController;
use App\Http\Controllers\UserDeviceController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');
Route::get('/contact-us', [WelcomePageController::class, 'contact'])->name('contact');
Route::get('/project/{id}', [WelcomePageController::class, 'showProject'])->name('project.show');
Route::post('/contact/send', [WelcomePageController::class, 'sendContact'])->name('contact.send');
Route::post('/quote', [WelcomePageController::class, 'quote_request_store'])->name('quote.store');
Route::post('/system-problem/store', [WelcomePageController::class, 'system_problem_store'])->name('system_problem.store');
Route::post('/settings/update', [WelcomePageController::class, 'updateSettings'])->name('settings.update');

/*
|--------------------------------------------------------------------------
| SEO / Utility Routes
|--------------------------------------------------------------------------
*/

Route::get('/generate-sitemap', function () {

    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/about'))
        ->add(Url::create('/projects'))
        ->add(Url::create('/contact-us'))
        ->writeToFile(public_path('sitemap.xml'));
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->middleware('developer.mode')
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');
/*
|--------------------------------------------------------------------------
| Developer Mode
|--------------------------------------------------------------------------
*/

Route::post('/developer-unlock', function (Request $request) {

    session(['developer_mode' => true]);

    return response()->json(['status' => 'ok']);
});


/*
|--------------------------------------------------------------------------
| Authenticated Admin Panel
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'check_banned_device', 'detect.attack']],  function () {

    /*
    | Dashboard
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/global-search', [DashboardController::class, 'globalSearch'])->name('global.search');
    Route::get('/search/result', [DashboardController::class, 'searchResult'])->name('search.result');
    Route::get('/system/table/{table}', [DashboardController::class, 'viewTable'])->name('dashboard.system.table.view');
    Route::post('/system/table/truncate', [DashboardController::class, 'truncateTable'])->name('dashboard.system.table.truncate');
    Route::get('/system_dashboard', [DashboardController::class, 'system_index'])->name('dashboard.system');

    /*
    | SEO Management
    */
    Route::get('/admin/seo', [SeoSettingController::class, 'index'])
        ->name('seo.index');

    Route::post('/admin/seo/update', [SeoSettingController::class, 'update'])
        ->name('seo.update');


    /*
    | Organization Management
    */
    Route::resource('organizations', OrganizationController::class);


    /*
    | Frontend Content Management
    */
    Route::resource('about_sections', AboutSectionController::class);
    Route::resource('project_sections', ProjectSectionController::class);
    Route::resource('sub_project_sections', SubProjectSectionController::class);
    Route::resource('key_activities', KeyActivityController::class);
    Route::resource('news_sections', NewsSectionController::class);
    Route::resource('news', NewsController::class);
    Route::resource('skill_sections', SkillSectionController::class);
    Route::resource('contact_cards', ContactCardController::class);


    /*
    | User Profile
    */
    Route::get('/user_profile', [ProfileController::class, 'user_profile_show'])
        ->name('user_profile_show');

    Route::get('/user_profile_edit', [ProfileController::class, 'user_profile_edit'])
        ->name('user_profile_edit');

    Route::put('/user_profile_edit', [ProfileController::class, 'user_profile_update'])
        ->name('user_profile_update');


    /*
    | Access Control
    */
    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);

    Route::post(
        '/permissions/delete-selected',
        [PermissionController::class, 'deleteSelected']
    )
        ->name('permissions.deleteSelected');


    /*
    | System Users
    */
    Route::resource('system_users', SystemUserController::class);
    Route::post('/system-users/{user}/change-password',[SystemUserController::class, 'updatePassword'])->name('system_users.password.update');

    //Setting Menu
    Route::resource('ban_users', BanUserController::class);
    Route::resource('banned_devices', BannedDeviceController::class);
    Route::post('system-problems/notify/{systemProblem}', [SystemProblemController::class, 'notify'])->name('system_problems.notify');
    Route::post('/system-problems/{id}/remarks', [SystemProblemController::class, 'saveRemarks'])->name('system_problems.remarks');
    Route::resource('system_problems', SystemProblemController::class);
    Route::resource('quote_requests', QuoteRequestController::class);
    Route::post('/user_devices/{id}/ban', [UserDeviceController::class, 'ban'])->name('user_devices.ban');
    Route::post('/user_devices/{id}/unban', [UserDeviceController::class, 'unban'])->name('user_devices.unban');
    Route::resource('user_devices', UserDeviceController::class);
    Route::resource('security_logs', SecurityController::class);

    //Activity Log Menu
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs.index');
    Route::delete('/activity-logs/{id}', [ActivityLogController::class, 'destroy'])->name('activity.logs.destroy');

    //Setting 
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/password_policy', [SettingController::class, 'password_policy'])->name('settings.password_policy');
    Route::get('/settings/2fa', [SettingController::class, 'show2FA'])->name('settings.2fa');
    Route::post('/settings/toggle-2fa', [SettingController::class, 'toggle2FA'])->name('settings.toggle2fa');
    Route::get('/settings/2fa/resend', [SettingController::class, 'resend'])->name('settings.2fa.resend');
    Route::post('/settings/2fa/verify', [SettingController::class, 'verify'])->name('settings.2fa.verify');
    Route::get('settings/notifications', [SettingController::class, 'notificationSettings'])->name('settings.notification.index');
    Route::post('settings/notifications', [SettingController::class, 'notificationUpdate'])->name('settings.notification.update');
    Route::post('settings/notifications/test', [SettingController::class, 'sendTestNotification'])->name('settings.notification.test');
    Route::get('/settings/timeout', [SettingController::class, 'showTimeout'])->name('settings.timeout');
    Route::post('/settings/timeout', [SettingController::class, 'updateTimeout'])->name('settings.timeout.update');
    Route::get('/settings/database-backup', [SettingController::class, 'databaseBackup'])->name('settings.database.backup');
    Route::post('/settings/database-backup/download', [SettingController::class, 'downloadDatabase'])->name('settings.database.backup.download');
    Route::get('/settings/logs', [SettingController::class, 'logs'])->name('settings.logs');
    Route::post('/settings/logs/clear', [SettingController::class, 'clearLogs'])->name('settings.clearLogs');
    Route::get('/settings/maintenance', [SettingController::class, 'maintenance'])->name('settings.maintenance');
    Route::post('/settings/maintenance', [SettingController::class, 'maintenanceUpdate'])->name('settings.maintenance.update');
    Route::get('/settings/language', [SettingController::class, 'language'])->name('settings.language');
    Route::post('/settings/language/update', [SettingController::class, 'updateLanguage'])->name('settings.language.update');
    Route::get('/settings/datetime', [SettingController::class, 'dateTime'])->name('settings.datetime');
    Route::post('/settings/datetime/update', [SettingController::class, 'updateDateTime'])->name('settings.datetime.update');
    Route::get('/settings/theme', [SettingController::class, 'theme'])->name('settings.theme');
    Route::post('/settings/theme/update', [SettingController::class, 'updateTheme'])->name('settings.theme.update');
    Route::get('/settings/debugbar', [SettingController::class, 'debugbar'])->name('settings.debugbar');
    Route::post('/settings/debugbar/update', [SettingController::class, 'updateDebugbar'])->name('settings.debugbar.update');
});

