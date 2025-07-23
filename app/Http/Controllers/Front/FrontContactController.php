<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;

class FrontContactController extends Controller
{
    public function index()
    {
        $isArabic = app()->getLocale() === 'ar';
        $settings = WebsiteSetting::first();

        return view('front.contact', compact('isArabic', 'settings'));
    }
}
