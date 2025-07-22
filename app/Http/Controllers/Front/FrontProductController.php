<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;

class FrontProductController extends Controller
{
    public function index()
    {
        $bottomBanner = Banner::where('position', 'bottom')
        ->where('status', 'active')
        ->first();

        // Fetch only active products, you can customize the order
        $products = Product::where('status', 'active')->latest()->get();

        // Pass them to the Blade view
        return view('front.products', compact('products', 'bottomBanner'));
    }

  public function show(Product $product)
{
    // Fetch 3 other products from the same subcategory (excluding the current product)
    $otherProducts = Product::where('subcategory_id', $product->subcategory_id)
                            ->where('id', '!=', $product->id)  // Exclude the current product
                            ->where('status', 'active')
                            ->latest()  // Order by the latest products
                            ->take(3)   // Limit to 3 products
                            ->get();

    // Pass the product and other products to the view
    return view('front.products_show', compact('product', 'otherProducts'));
}

}
