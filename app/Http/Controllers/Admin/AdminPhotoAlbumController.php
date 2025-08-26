<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // For file operations

class AdminPhotoAlbumController extends Controller
{
    // Show a list of all photo galleries
    public function index()
    {
        $albums = PhotoAlbum::all(); // fetch all albums
        return view('admin.photo_album.index', compact('albums')); // pass $albums to the view
    }

    public function create()
    {
        $albums = PhotoAlbum::all(); // Optional: if you need to select an album
        return view('admin.photo_album.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_title_en' => 'required|string|max:255',
            'album_title_ar' => 'nullable|string|max:255',
            'album_cover' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Handle file upload and store manually in public/uploads/
        $coverPath = null;

        if ($request->hasFile('album_cover')) {
            // Manually move the file to the uploads/ folder inside the public directory
            $file = $request->file('album_cover');
            $coverPath = 'uploads/album_covers/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/album_covers'), $coverPath); // Move the file
        }

        // Create the album
        PhotoAlbum::create([
            'album_title_en' => $request->album_title_en,
            'album_title_ar' => $request->album_title_ar,
            'album_cover'    => $coverPath, // Store file path
        ]);

        return redirect()->route('admin.photo-album.index')->with('status-success', 'Photo album created successfully.');
    }

    public function edit($id)
    {
        $album = PhotoAlbum::findOrFail($id);
        return view('admin.photo_album.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = PhotoAlbum::findOrFail($id);

        $request->validate([
            'album_title_en' => 'required|string|max:255',
            'album_title_ar' => 'nullable|string|max:255',
            'album_cover' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Keep the current cover image if no new image is uploaded
        $coverPath = $album->album_cover;

        if ($request->hasFile('album_cover')) {
            // Delete old cover image if it exists
            $oldCoverPath = public_path($coverPath);
            if (File::exists($oldCoverPath)) {
                File::delete($oldCoverPath); // Delete the old image manually
            }

            // Move the new cover image to uploads/album_covers/
            $file = $request->file('album_cover');
            $coverPath = 'uploads/album_covers/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/album_covers'), $coverPath); // Move the file
        }

        // Update the album record
        $album->update([
            'album_title_en' => $request->album_title_en,
            'album_title_ar' => $request->album_title_ar,
            'album_cover'    => $coverPath,
        ]);

        return redirect()->route('admin.photo-album.index')->with('status-success', 'Album updated successfully.');
    }

    public function destroy($id)
    {
        $album = PhotoAlbum::findOrFail($id);

        // Delete album cover image manually if it exists
        $coverPath = public_path($album->album_cover);
        if (File::exists($coverPath)) {
            File::delete($coverPath); // Delete the image
        }

        // Delete the album from the database
        $album->delete();

        return redirect()->route('admin.photo-album.index')->with('status-success', 'Photo album deleted successfully.');
    }
}
