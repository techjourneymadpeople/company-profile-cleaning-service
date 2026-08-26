<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TestimonialController;
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

        // User & Role Management
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('menus', MenuController::class);

        // 8 Content Modules
        Route::resource('services', ServiceController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('certificates', CertificateController::class);
        Route::resource('statistics', StatisticController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'update', 'destroy']);

        // System Settings Routes
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings/brand', [SettingController::class, 'updateBrand'])->name('settings.brand.update');
        Route::put('settings/contact', [SettingController::class, 'updateContact'])->name('settings.contact.update');
        Route::put('settings/social', [SettingController::class, 'updateSocial'])->name('settings.social.update');
        Route::put('settings/seo', [SettingController::class, 'updateSeo'])->name('settings.seo.update');
    });
});
