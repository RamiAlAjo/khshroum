<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;

class FrontProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->latest()->get();
        return view('front.products', compact('products'));
    }

    public function show(Product $product)
    {
        $isArabic = app()->getLocale() === 'ar';
        return view('front.products_show', compact('isArabic', 'product'));
    }

}
