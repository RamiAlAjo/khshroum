<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

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

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services/images', 'public');
            $service->image = $path;
        }
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('services/icon', 'public');
            $service->icon = $path;
        }

        if ($request->hasFile('pdf')) {
            $service->pdf = $request->file('pdf')->store('pdfs', 'public');
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
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'icon'  => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $service->name_en = $request->name_en;
        $service->name_ar = $request->name_ar;
        $service->description_en = $request->description_en;
        $service->description_ar = $request->description_ar;
        $service->status = $request->status;

        if ($request->hasFile('image')) {
            if ($service->image) {
                \Storage::delete('public/' . $service->image);
            }
            $path = $request->file('image')->store('services/images', 'public');
            $service->image = $path;
        }
        if ($request->hasFile('icon')) {
            if ($service->image) {
                \Storage::delete('public/' . $service->icon);
            }
            $path = $request->file('icon')->store('services/icon', 'public');
            $service->icon = $path;
        }
        if ($request->hasFile('pdf')) {
            // Delete the old resume if it exists
            if ($service->pdf) {
                \Storage::delete('public/' . $service->pdf);
            }

            // Store the new resume
            $resumePath = $request->file('pdf')->store('service/pdfs', 'public');
            $service->pdf = $resumePath;
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
        if ($service->image) {
            \Storage::delete('public/' . $service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('status-success', 'Service deleted successfully!');
    }
}
