<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // For file operations

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $categories = ProductCategory::all(); // Fetch all categories
        return view('admin.products.index', compact('products', 'categories')); // Pass categories variable
    }

    public function create()
    {
        $categories = ProductCategory::all(); // Fetch all categories
        return view('admin.products.create', compact('categories')); // Pass categories to the view
    }

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'slug' => 'required|string|unique:products,slug',
            'status' => 'required|in:active,inactive,pending',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        // Handle image file upload
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName(); // Generate unique image name
            $imagePath = 'uploads/products/images/' . $imageName;  // Set image path
            $request->file('image')->move(public_path('uploads/products/images'), $imageName);  // Move image to the folder
            $validated['image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf')) {
            $pdfName = time() . '-' . $request->file('pdf')->getClientOriginalName(); // Generate unique PDF name
            $pdfPath = 'uploads/pdfs/' . $pdfName;  // Set PDF path
            $request->file('pdf')->move(public_path('uploads/pdfs'), $pdfName); // Move PDF to the folder
            $validated['pdf'] = $pdfPath;
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
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'status' => 'required|in:active,inactive,pending',
        ]);

        // Handle image file upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImagePath = public_path($product->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath); // Delete old image
                }
            }

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName(); // Generate unique image name
            $imagePath = 'uploads/products/images/' . $imageName;  // Set image path
            $request->file('image')->move(public_path('uploads/products/images'), $imageName); // Move image
            $validated['image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf')) {
            if ($product->pdf) {
                $oldPdfPath = public_path('uploads/pdfs/' . $product->pdf);
                if (File::exists($oldPdfPath)) {
                    File::delete($oldPdfPath); // Delete old PDF
                }
            }

            $pdfName = time() . '-' . $request->file('pdf')->getClientOriginalName(); // Generate unique PDF name
            $pdfPath = 'uploads/pdfs/' . $pdfName;  // Set PDF path
            $request->file('pdf')->move(public_path('uploads/pdfs'), $pdfName); // Move PDF
            $validated['pdf'] = $pdfPath;
        }

        // Update the product
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('status-success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete the image if exists
        if ($product->image) {
            $oldImagePath = public_path($product->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath); // Delete image
            }
        }

        // Delete the PDF if exists
        if ($product->pdf) {
            $oldPdfPath = public_path('uploads/pdfs/' . $product->pdf);
            if (File::exists($oldPdfPath)) {
                File::delete($oldPdfPath); // Delete PDF
            }
        }

        // Delete the product
        $product->delete();

        return redirect()->route('admin.products.index')->with('status-success', 'Product deleted successfully!');
    }
}
