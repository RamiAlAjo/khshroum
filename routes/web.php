<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontHomepageController;
use App\Http\Controllers\Front\FrontAboutUsController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Front\FrontServicesController;
use App\Http\Controllers\Front\FrontGalleryController;
use App\Http\Controllers\Front\FrontContactController;


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

require __DIR__ . '/auth.php';
