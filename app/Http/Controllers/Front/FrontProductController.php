<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontProductController extends Controller
{
    public function index()
    {
        return view('front.products');
    }
}
