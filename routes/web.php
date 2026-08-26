<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::get('/layanan', [PublicController::class, 'services'])->name('public.services');
Route::get('/layanan/{slug}', [PublicController::class, 'serviceDetail'])->name('public.services.show');
Route::get('/mitra-portofolio', [PublicController::class, 'portfolio'])->name('public.portfolio');
Route::get('/artikel', [PublicController::class, 'articles'])->name('public.articles');
Route::get('/artikel/{slug}', [PublicController::class, 'articleDetail'])->name('public.articles.show');
Route::get('/kontak', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/kontak', [PublicController::class, 'submitInquiry'])->name('public.contact.submit');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('public.sitemap');

// Legacy route alias for compatibility
Route::get('/home', function () {
    return redirect()->route('public.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated Admin Panel Routes
|--------------------------------------------------------------------------
*/
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

        // Content Halaman Publik (Section Management)
        Route::get('page-sections', [PageSectionController::class, 'index'])->name('page-sections.index');
        Route::get('page-sections/{pageSection}/edit', [PageSectionController::class, 'edit'])->name('page-sections.edit');
        Route::put('page-sections/{pageSection}', [PageSectionController::class, 'update'])->name('page-sections.update');
        Route::patch('page-sections/{pageSection}/toggle-status', [PageSectionController::class, 'toggleStatus'])->name('page-sections.toggle-status');

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
