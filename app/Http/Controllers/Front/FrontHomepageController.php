<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\WebsiteSetting;

class FrontHomepageController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $logo = WebsiteSetting::value('logo');
        $topBanner = Banner::where('position', 'top')
            ->where('status', 'active')
            ->first();
        return view('front.homepage', compact('topBanner', 'locale', 'logo'));
    }
}
