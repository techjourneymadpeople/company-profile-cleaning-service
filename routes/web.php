<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('menus', MenuController::class);

        // System Settings Routes
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings/brand', [SettingController::class, 'updateBrand'])->name('settings.brand.update');
        Route::put('settings/contact', [SettingController::class, 'updateContact'])->name('settings.contact.update');
        Route::put('settings/social', [SettingController::class, 'updateSocial'])->name('settings.social.update');
        Route::put('settings/seo', [SettingController::class, 'updateSeo'])->name('settings.seo.update');
    });
});
