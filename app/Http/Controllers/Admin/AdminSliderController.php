<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesSlider;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the sliders.
     */
    public function index()
    {
        $sliders = PagesSlider::all(); // Fetch all sliders
        return view('admin.homepage.slider.index', compact('sliders')); // Pass to view
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create()
    {
        return view('admin.homepage.slider.create');
    }

    /**
     * Store a newly created slider in storage.
     */
    public function store(Request $request)
    {
            // Validate the incoming data
            $validatedData = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_ar' => 'nullable|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'url' => 'nullable|url',
            ]);

            // Handle the image upload and storage
            if ($request->hasFile('image')) {
                $slidersImageUploadPath = 'uploads/sliders/image/';
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $slidersImageFilename = time() . '.' . $ext;
                $file->move(public_path($slidersImageUploadPath), $slidersImageFilename);
                $imagePath = $slidersImageUploadPath . $slidersImageFilename;
            } else {
                throw new \Exception('Image file not found in the request.');
            }

            // Create the new slider
            PagesSlider::create([
                'title_en' => $validatedData['title_en'],
                'title_ar' => $validatedData['title_ar'] ?? null,
                'image' => $imagePath,
                'url' => $validatedData['url'] ?? null,
            ]);

            // Redirect with success message
            return redirect()->route('admin.slider.index')->with('success', 'Slider image added successfully.');
    }

    /**
     * Show the form for editing the specified slider.
     */
    public function edit($id)
    {
        $slider = PagesSlider::find($id);

        if (!$slider) {
            return redirect()->route('admin.slider.index')->with('status-error', 'Slider not found.');
        }

        return view('admin.homepage.slider.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     */
    public function update(Request $request, $id)
    {
        \Log::info('Update method called for slider ID: ' . $id);

        $slider = PagesSlider::find($id);

        if (!$slider) {
            return redirect()->route('admin.slider.index')->with('status-error', 'Slider not found.');
        }

        $request->validate([
            'title_en' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $slidersImageUploadPath = 'uploads/sliders/image/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $slidersImageFilename = time() . '.' . $ext;
            $file->move($slidersImageUploadPath, $slidersImageFilename);
            $slider->image = $slidersImageUploadPath . $slidersImageFilename;
            \Log::info('Image uploaded: ' . $slider->image);
        }

        $slider->title_en = $request->title_en;
        $slider->save();

        \Log::info('Slider updated successfully!');

        return redirect()->route('admin.slider.index')->with('status-success', 'Slider updated successfully!');
    }

    /**
     * Remove the specified slider from storage.
     */
    public function destroy($id)
    {
        $slider = PagesSlider::find($id);

        if (!$slider) {
            return redirect()->route('admin.slider.index')->with('status-error', 'Slider not found.');
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')->with('status-success', 'Slider deleted successfully!');
    }
}
