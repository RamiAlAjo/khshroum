<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory; // Add this import
use Illuminate\Http\Request;

class FrontProductController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected category ID from the request, if any
        $categoryId = $request->input('category_id');

        // Fetch products either based on the selected category or all products
        $products = Product::when($categoryId, function ($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->where('status', 'active')
        ->latest()
        ->paginate(12); // Paginate products

        // Fetch all categories
        $categories = ProductCategory::all();

        return view('front.products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $isArabic = app()->getLocale() === 'ar';
        return view('front.products_show', compact('isArabic', 'product'));
    }
}
