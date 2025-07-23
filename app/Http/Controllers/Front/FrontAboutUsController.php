<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\TeamMember;

class FrontAboutUsController extends Controller
{
    public function index()
    {
        $isArabic = app()->getLocale() === 'ar';
        $sections = AboutUs::all();
        $teamMembers = TeamMember::all();
        return view('front.about', compact('isArabic', 'sections', 'teamMembers'));
    }
}
