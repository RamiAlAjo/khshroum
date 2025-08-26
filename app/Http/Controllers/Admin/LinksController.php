<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Link;

class LinksController extends Controller
{
    public function index()
    {
        $links = Link::get();
        return view('admin.links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Ensure the 'uploads/links' directory exists
        $imageDirectory = public_path('uploads/links');
        if (!File::exists($imageDirectory)) {
            File::makeDirectory($imageDirectory, 0755, true);  // Creates the directory if it doesn't exist
        }

        // Handle image file upload
        $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
        $imagePath = 'uploads/links/' . $imageName;
        $request->file('image')->move(public_path('uploads/links'), $imageName);

        $data['image'] = $imagePath;

        Link::create($data);

        return redirect()->route('admin.links.index')->with('success', 'Link created successfully.');
    }

    public function edit($id)
    {
        $link = Link::findOrFail($id);
        return view('admin.links.edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        $data = $request->validate([
            'url' => 'required|url',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Ensure the 'uploads/links' directory exists
            $imageDirectory = public_path('uploads/links');
            if (!File::exists($imageDirectory)) {
                File::makeDirectory($imageDirectory, 0755, true);  // Creates the directory if it doesn't exist
            }

            // Delete old image if it exists
            if ($link->image && File::exists(public_path($link->image))) {
                File::delete(public_path($link->image)); // Delete old image
            }

            // Handle new image upload
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'uploads/links/' . $imageName;
            $request->file('image')->move(public_path('uploads/links'), $imageName);

            $data['image'] = $imagePath;
        } else {
            $data['image'] = $link->image; // Keep old image
        }

        $link->update($data);

        return redirect()->route('admin.links.index')->with('success', 'Link updated successfully.');
    }

    public function destroy($id)
    {
        $link = Link::findOrFail($id);

        // Delete the image file if it exists
        if ($link->image && File::exists(public_path($link->image))) {
            File::delete(public_path($link->image)); // Delete image
        }

        $link->delete();

        return redirect()->route('admin.links.index')->with('status-success', 'Link deleted successfully!');
    }
}
