<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // For file operations
use App\Models\PhotoAlbum;
use App\Models\PhotoGallery;

class AdminPhotoGalleryController extends Controller
{
    public function index()
    {
        // Eager load related photos
        $albums = PhotoAlbum::with('photos')->get();
        return view('admin.photos.index', compact('albums'));
    }

    public function create()
    {
        $albums = PhotoAlbum::all(); // Get all albums
        return view('admin.photos.create', compact('albums'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'album_id' => 'required|exists:photo_album,id',
            'album_images.*' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:100000',
        ]);

        // Check if album images are uploaded
        if ($request->hasFile('album_images')) {
            foreach ($request->file('album_images') as $image) {
                // Manually handle file storage to public/uploads/photos_gallery/
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads/photos_gallery'), $imageName); // Move image to public folder

                // Save image path in database
                PhotoGallery::create([
                    'album_id' => $request->album_id,
                    'album_images' => 'uploads/photos_gallery/' . $imageName, // Store the relative path
                ]);
            }
        }

        return redirect()->route('admin.photos.index')->with('status-success', 'Photos uploaded successfully.');
    }

    public function edit($id)
    {
        $photo = PhotoGallery::findOrFail($id); // Fetch the photo by ID
        $albums = PhotoAlbum::all(); // Get all albums

        return view('admin.photos.edit', compact('photo', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $photo = PhotoGallery::findOrFail($id); // Fetch the photo by ID

        // Validate request data
        $request->validate([
            'album_id' => 'required|exists:photo_album,id',
            'album_images' =>  'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:100000',
        ]);

        // Keep the current image path if no new image is uploaded
        $path = $photo->album_images;

        // Handle new image upload if file is provided
        if ($request->hasFile('album_images')) {
            // Delete the old image if it exists
            $oldImagePath = public_path($path);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath); // Delete the old image
            }

            // Store the new image in the public/uploads/photos_gallery/ directory
            $image = $request->file('album_images');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploads/photos_gallery'), $imageName); // Move the image

            // Update path in the database
            $path = 'uploads/photos_gallery/' . $imageName;
        }

        // Update the database record
        $photo->update([
            'album_id' => $request->album_id,
            'album_images' => $path,
        ]);

        return redirect()->route('admin.photos.index')->with('status-success', 'Photo updated successfully.');
    }

    public function destroy($id)
    {
        $photo = PhotoGallery::findOrFail($id); // Fetch the photo by ID

        // Delete the image file from the public folder
        if ($photo->album_images && File::exists(public_path($photo->album_images))) {
            File::delete(public_path($photo->album_images)); // Delete the image
        }

        // Delete the photo record from the database
        $photo->delete();

        return redirect()->route('admin.photos.index')->with('status-success', 'Photo deleted successfully.');
    }
}
