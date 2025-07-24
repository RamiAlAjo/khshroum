<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontHomepageController;
use App\Http\Controllers\Front\FrontAboutUsController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Front\FrontServicesController;
use App\Http\Controllers\Front\FrontGalleryController;
use App\Http\Controllers\Front\FrontContactController;
use App\Http\Controllers\Front\FrontClientsController;
use App\Http\Controllers\Front\FrontLinksController;


use App\Http\Controllers\Admin\AdminHomepageController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminServicesController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AdminWebsiteSettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\AdminPhotoAlbumController;
use App\Http\Controllers\Admin\AdminPhotoGalleryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\LinksController;
use App\Http\Middleware\SetLocale;

Route::middleware(['web', SetLocale::class])->group(function () {

Route::get('/', [FrontHomepageController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [AdminHomepageController::class, 'index'])->name('admin_home');
    Route::resource('banner', BannerController::class);
    Route::resource('/products', AdminProductController::class);
    Route::resource('/about', AdminAboutController::class);
    Route::resource('/team', TeamMemberController::class);
    Route::resource('/slider', AdminSliderController::class);
    Route::resource('services', AdminServicesController::class);
    Route::resource('/team', TeamMemberController::class);
    Route::resource('/clients', ClientsController::class);
    Route::resource('/links', LinksController::class);
    Route::resource('/settings', AdminWebsiteSettingController::class)->only('index','store');
    Route::resource('/photo-album', AdminPhotoAlbumController::class);
    Route::resource('/photos', AdminPhotoGalleryController::class);
    Route::resource('/videos', VideoController::class);

 });

// Front Routes
Route::resource('about', FrontAboutUsController::class);
Route::resource('product', FrontProductController::class);
Route::resource('services', FrontServicesController::class);
Route::resource('contact', FrontContactController::class);
Route::get('/gallery', [FrontGalleryController::class, 'index']);
Route::get('/albums', [FrontGalleryController::class, 'getAlbums'])->name('albums');
Route::get('/albums/{id}', [FrontGalleryController::class, 'show'])->name('album.show');
Route::get('/videos', [FrontGalleryController::class, 'getVideos'])->name('videos');
Route::get('/clients', [FrontClientsController::class, 'index'])->name('clients');
Route::get('/links', [FrontLinksController::class, 'index'])->name('links');
   // Language Switching Route
    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar'])) {
            session(['locale' => $locale]); // Store the locale in session
            app()->setLocale($locale);      // Set application locale
        }
        return redirect()->back();
    })->name('change.language');
});
require __DIR__ . '/auth.php';
