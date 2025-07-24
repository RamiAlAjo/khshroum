<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;
use App\Models\PagesSlider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;

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
        App::setLocale(Session::get('locale', config('app.locale')));

        // Use Bootstrap styling for pagination
        Paginator::useBootstrap();

        // Share global website settings with all views only if the table exists
        if (Schema::hasTable('website_settings')) {
            $globalsettings = WebsiteSetting::first();
            View::share('globalsettings', $globalsettings);
        }
        View::composer(['front.layouts.navbar', 'front.layouts.footer'], function ($view) {
            $data = WebsiteSetting::first();
            $view->with('settings', $data);
        });

        View::composer('*', function ($view) {
        $sliders = PagesSlider::all();
        $view->with('sliders', $sliders);
    });
    }
}
