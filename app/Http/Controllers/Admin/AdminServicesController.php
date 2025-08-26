<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // For file operations

class AdminServicesController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'icon'  => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $service = new Service();
        $service->name_en = $request->name_en;
        $service->name_ar = $request->name_ar;
        $service->description_en = $request->description_en;
        $service->description_ar = $request->description_ar;
        $service->status = $request->status;

        // Handle image file upload
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'uploads/services/images/' . $imageName;
            $request->file('image')->move(public_path('uploads/services/images'), $imageName);
            $service->image = $imagePath;
        }

        // Handle icon file upload
        if ($request->hasFile('icon')) {
            $iconName = time() . '-' . $request->file('icon')->getClientOriginalName();
            $iconPath = 'uploads/services/icon/' . $iconName;
            $request->file('icon')->move(public_path('uploads/services/icon'), $iconName);
            $service->icon = $iconPath;
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf')) {
            $pdfName = time() . '-' . $request->file('pdf')->getClientOriginalName();
            $pdfPath = 'uploads/pdfs/' . $pdfName;
            $request->file('pdf')->move(public_path('uploads/pdfs'), $pdfName);
            $service->pdf = $pdfPath;
        }

        $service->slug = Str::slug($request->name_en) . '-' . Str::random(5);
        $service->save();

        return redirect()->route('admin.services.index')->with('status-success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'icon'  => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $service->name_en = $request->name_en;
        $service->name_ar = $request->name_ar;
        $service->description_en = $request->description_en;
        $service->description_ar = $request->description_ar;
        $service->status = $request->status;

        // Handle image file upload
        if ($request->hasFile('image')) {
            if ($service->image) {
                $oldImagePath = public_path($service->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath); // Delete old image
                }
            }

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'uploads/services/images/' . $imageName;
            $request->file('image')->move(public_path('uploads/services/images'), $imageName);
            $service->image = $imagePath;
        }

        // Handle icon file upload
        if ($request->hasFile('icon')) {
            if ($service->icon) {
                $oldIconPath = public_path($service->icon);
                if (File::exists($oldIconPath)) {
                    File::delete($oldIconPath); // Delete old icon
                }
            }

            $iconName = time() . '-' . $request->file('icon')->getClientOriginalName();
            $iconPath = 'uploads/services/icon/' . $iconName;
            $request->file('icon')->move(public_path('uploads/services/icon'), $iconName);
            $service->icon = $iconPath;
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf')) {
            if ($service->pdf) {
                $oldPdfPath = public_path('uploads/pdfs/' . $service->pdf);
                if (File::exists($oldPdfPath)) {
                    File::delete($oldPdfPath); // Delete old PDF
                }
            }

            $pdfName = time() . '-' . $request->file('pdf')->getClientOriginalName();
            $pdfPath = 'uploads/pdfs/' . $pdfName;
            $request->file('pdf')->move(public_path('uploads/pdfs'), $pdfName);
            $service->pdf = $pdfPath;
        }

        $service->slug = Str::slug($request->name_en) . '-' . Str::random(5);
        $service->save();

        return redirect()->route('admin.services.index')->with('status-success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        // Delete files if they exist
        if ($service->image) {
            $oldImagePath = public_path($service->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath); // Delete image
            }
        }

        if ($service->icon) {
            $oldIconPath = public_path($service->icon);
            if (File::exists($oldIconPath)) {
                File::delete($oldIconPath); // Delete icon
            }
        }

        if ($service->pdf) {
            $oldPdfPath = public_path('uploads/pdfs/' . $service->pdf);
            if (File::exists($oldPdfPath)) {
                File::delete($oldPdfPath); // Delete PDF
            }
        }

        // Delete the service
        $service->delete();

        return redirect()->route('admin.services.index')->with('status-success', 'Service deleted successfully!');
    }
}
