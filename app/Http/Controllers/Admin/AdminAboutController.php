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
        // Validate the incoming request data
        $request->validate([
            'about_us_title_en' => 'nullable|string',
            'about_us_title_ar' => 'nullable|string',
            'about_us_description_en' => 'nullable|string',
            'about_us_description_ar' => 'nullable|string',
        ]);

        // Create and store the About Us data
        $s = AboutUs::create([
            'about_us_title_en' => $request->input('about_us_title_en'),
            'about_us_title_ar' => $request->input('about_us_title_ar'),
            'about_us_description_en' => $request->input('about_us_description_en'),
            'about_us_description_ar' => $request->input('about_us_description_ar'),
        ]);
        return redirect()->route('admin.about.index')->with('success', 'About Us page created successfully!');
    }

    // Show the form for editing the About Us page
    public function edit($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.about.edit', compact('aboutUs'));
    }

    // Update the About Us page in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'about_us_title_en' => 'nullable|string',
            'about_us_title_ar' => 'nullable|string',
            'about_us_description_en' => 'nullable|string',
            'about_us_description_ar' => 'nullable|string',
        ]);

        // Find the About Us entry by ID
        $aboutUs = AboutUs::findOrFail($id);

        // Update the About Us entry
        $aboutUs->update([
            'about_us_title_en' => $request->input('about_us_title_en'),
            'about_us_title_ar' => $request->input('about_us_title_ar'),
            'about_us_description_en' => $request->input('about_us_description_en'),
            'about_us_description_ar' => $request->input('about_us_description_ar'),
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
