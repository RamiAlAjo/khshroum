<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Product;
use App\Models\Client;

class FrontHomepageController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $isArabic = app()->getLocale() === 'ar';
        $topBanner = Banner::where('position', 'top')
            ->where('status', 'active')
            ->first();

        $middleBanner = Banner::where('position', 'middle')
        ->where('status', 'active')
        ->first();

        $bottomBanner = Banner::where('position', 'bottom')
        ->where('status', 'active')
        ->first();

        $services = Service::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'icon' => $service->icon,
                    'name' => $service->{"name_$locale"},
                    'description' => $service->{"description_$locale"},
                ];
            });

        $products = Product::orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        $products->map(function ($product) use ($locale) {
            $product->name = $product->{"name_$locale"};
            $product->description = $product->{"description_$locale"};
            return $product;
        });
        $clients = Client::limit(3)->get();

        return view('front.homepage', compact('locale', 'isArabic', 'topBanner', 'middleBanner', 'bottomBanner', 'services', 'products', 'clients'));
    }
}
