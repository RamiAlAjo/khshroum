<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
   public function index()
{
    $products = Product::latest()->get();
    $categories = ProductCategory::all(); // Fetch all categories
    return view('admin.products.index', compact('products', 'categories')); // Pass the categories variable
}

public function create()
{
    $categories = ProductCategory::all(); // Fetch all categories
    return view('admin.products.create', compact('categories')); // Pass categories to the view
}




    public function store(Request $request)
{
    $validated = $request->validate([
        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',
        'description_en' => 'nullable|string',
        'description_ar' => 'nullable|string',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        'pdf' => 'nullable|mimes:pdf|max:10240',
        'slug' => 'required|string|unique:products,slug',
        'status' => 'required|in:active,inactive,pending',
        'category_id' => 'required|exists:product_categories,id', // Add validation for category_id
    ]);

    // Handle image file upload
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products/images', 'public');
    }

    // Handle PDF file upload
    if ($request->hasFile('pdf')) {
        $validated['pdf'] = $request->file('pdf')->store('pdfs', 'public');
    }

    // Create the product with all validated data
    Product::create($validated);

    return redirect()->route('admin.products.index')->with('status-success', 'Product created successfully!');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'status' => 'required|in:active,inactive,pending',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products/images', 'public');
        }
        if ($request->hasFile('pdf')) {
            // Delete the old resume if it exists
            if ($product->pdf) {
                \Storage::delete('public/' . $product->pdf);
            }

            // Store the new resume
            $resumePath = $request->file('pdf')->store('products/pdfs', 'public');
            $validated['pdf'] = $resumePath;
        }


        $product->update($validated);

        return redirect()->route('admin.products.index')->with('status-success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('status-success', 'Product deleted successfully!');
    }
}
