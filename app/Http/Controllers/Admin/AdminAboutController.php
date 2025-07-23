<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AdminAboutController extends Controller
{
    // Show the About Us data
    public function index()
    {
        $aboutUsRows = AboutUs::get(); // Assuming only one "About Us" entry
        return view('admin.about.index', compact('aboutUsRows'));
    }

    // Show the form for creating the About Us page
    public function create()
    {
        return view('admin.about.create');
    }

    // Store a newly created About Us page in the database
    public function store(Request $request)
    {
        $data = $request->validate([
            'about_us_title_en' => 'nullable|string',
            'about_us_title_ar' => 'nullable|string',
            'about_us_description_en' => 'nullable|string',
            'about_us_description_ar' => 'nullable|string',
            'about_us_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if ($request->hasFile('about_us_image')) {
            $data['image'] = $request->file('about_us_image')->store('about_us', 'public');
        }

        AboutUs::create([
            'about_us_title_en' => $data['about_us_title_en'] ?? null,
            'about_us_title_ar' => $data['about_us_title_ar'] ?? null,
            'about_us_description_en' => $data['about_us_description_en'] ?? null,
            'about_us_description_ar' => $data['about_us_description_ar'] ?? null,
            'image' => $data['image'] ?? null,
        ]);

        return redirect()->route('admin.about.index')->with('success', 'About Us page created successfully!');
    }

    // Show the form for editing the About Us page
    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    // Update the About Us page in the database
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'about_us_title_en' => 'nullable|string',
            'about_us_title_ar' => 'nullable|string',
            'about_us_description_en' => 'nullable|string',
            'about_us_description_ar' => 'nullable|string',
            'about_us_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',

        ]);

        $aboutUs = AboutUs::findOrFail($id);

        if ($request->hasFile('about_us_image')) {
            // Delete old image if you want: Storage::disk('public')->delete($aboutUs->image);
            $data['image'] = $request->file('about_us_image')->store('about_us', 'public');
        } else {
            // Keep old image if no new image uploaded
            $data['image'] = $aboutUs->image;
        }

        $aboutUs->update([
            'about_us_title_en' => $data['about_us_title_en'] ?? $aboutUs->about_us_title_en,
            'about_us_title_ar' => $data['about_us_title_ar'] ?? $aboutUs->about_us_title_ar,
            'about_us_description_en' => $data['about_us_description_en'] ?? $aboutUs->about_us_description_en,
            'about_us_description_ar' => $data['about_us_description_ar'] ?? $aboutUs->about_us_description_ar,
            'image' => $data['image'],
        ]);

        return redirect()->route('admin.about.index')->with('status-success', 'About Us page updated successfully!');
    }

    // Remove the specified About Us data from the database
    public function destroy($id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        $aboutUs->delete();

        return redirect()->route('admin.about.index')->with('status-success', 'About Us data deleted successfully!');
    }
}
