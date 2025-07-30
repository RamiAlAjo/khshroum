<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductCategoriesController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = ProductCategory::all();  // You can modify this to use pagination if needed
        return view('admin.products.products_category.index', compact('categories'));
    }

    // Show form for creating a new category
    public function create()
    {
        return view('admin.products.products_category.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'description_en' => 'required|string',
            'name_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive,pending',
            'slug' => 'required|string|unique:product_categories,slug',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        // Create the category
        ProductCategory::create([
            'name_en' => $request->name_en,
            'description_en' => $request->description_en,
            'name_ar' => $request->name_ar,
            'description_ar' => $request->description_ar,
            'image' => $imagePath,
            'status' => $request->status,
            'slug' => Str::slug($request->slug),
        ]);

        return redirect()->route('admin.product-categories.index')->with('status-success', 'Category created successfully!');
    }

    // Show form for editing an existing category
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product_category_edit', compact('productCategory'));
    }

    // Update an existing category
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'description_en' => 'required|string',
            'name_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive,pending',
            'slug' => 'required|string|unique:product_categories,slug,' . $productCategory->id,
        ]);

        // Handle image upload
        $imagePath = $productCategory->image;
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        // Update the category
        $productCategory->update([
            'name_en' => $request->name_en,
            'description_en' => $request->description_en,
            'name_ar' => $request->name_ar,
            'description_ar' => $request->description_ar,
            'image' => $imagePath,
            'status' => $request->status,
            'slug' => Str::slug($request->slug),
        ]);

        return redirect()->route('admin.product-categories.index')->with('status-success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy(ProductCategory $productCategory)
    {
        // Delete the image file if exists
        if ($productCategory->image) {
            Storage::disk('public')->delete($productCategory->image);
        }

        // Delete the category
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('status-success', 'Category deleted successfully!');
    }
}
