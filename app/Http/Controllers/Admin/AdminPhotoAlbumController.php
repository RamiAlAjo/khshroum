<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PhotoAlbum;
use App\Models\PhotosGallery;

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

        $coverPath = null;

        if ($request->hasFile('album_cover')) {
            $coverPath = $request->file('album_cover')->store('album_covers', 'public');
        }

        PhotoAlbum::create([
            'album_title_en' => $request->album_title_en,
            'album_title_ar' => $request->album_title_ar,
            'album_cover'    => $coverPath,
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

        $coverPath = $album->album_cover;

        if ($request->hasFile('album_cover')) {
            // Delete old cover image if exists
            if ($coverPath && Storage::disk('public')->exists($coverPath)) {
                Storage::disk('public')->delete($coverPath);
            }

            // Store new image
            $coverPath = $request->file('album_cover')->store('album_covers', 'public');
        }

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

        // Delete album cover image if it exists
        if ($album->album_cover && Storage::disk('public')->exists($album->album_cover)) {
            Storage::disk('public')->delete($album->album_cover);
        }

        // Delete the album
        $album->delete();

        return redirect()->route('admin.photo-album.index')->with('status-success', 'Photo album deleted successfully.');
    }
}
