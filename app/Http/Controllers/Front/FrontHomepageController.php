<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;


class FrontHomepageController extends Controller
{
    public function index()
    {
        return view('front.homepage');
    }
}
