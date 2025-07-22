<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class FrontAboutUsController extends Controller
{
    public function index()
    {
        $sections = AboutUs::orderBy('created_at')->get();
        return view('front.about', compact('sections'));
    }
}
