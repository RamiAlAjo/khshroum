<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Link;

class FrontLinksController extends Controller
{
    public function index()
    {
        $links = Link::all();
        return view('front.link', compact('links'));
    }
}
