<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;
use App\Models\PagesSlider;

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
