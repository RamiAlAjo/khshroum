<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PhotoAlbum;
use App\Models\PhotoGallery;

class AdminPhotoGalleryController extends Controller
{
    public function index()
    {
        $albums = PhotoAlbum::with('photos')->get(); // eager load related photos
        return view('admin.photos.index', compact('albums'));
    }

    public function create()
    {
        $albums = PhotoAlbum::all();
        return view('admin.photos.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:photo_album,id',
            'album_images.*' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if ($request->hasFile('album_images')) {
            foreach ($request->file('album_images') as $image) {
                $path = $image->store('photos_gallery', 'public');

                PhotoGallery::create([
                    'album_id' => $request->album_id,
                    'album_images' => $path,
                ]);
            }
        }

        return redirect()->route('admin.photos.index')->with('status-success', 'Photos uploaded successfully.');
    }

    public function edit($id)
    {
        $photo = PhotoGallery::findOrFail($id);
        $albums = PhotoAlbum::all();

        return view('admin.photos.edit', compact('photo', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $photo = PhotoGallery::findOrFail($id);

        $request->validate([
            'album_id' => 'required|exists:photo_album,id',
            'album_images' =>  'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $path = $photo->album_images;

        if ($request->hasFile('album_images')) {
            // Delete old image if exists
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Store new image
            $path = $request->file('album_images')->store('photos_gallery', 'public');
        }

        $photo->update([
            'album_id' => $request->album_id,
            'album_images' => $path,
        ]);

        return redirect()->route('admin.photos.index')->with('status-success', 'Photo updated successfully.');
    }

    public function destroy($id)
    {
        $photo = PhotoGallery::findOrFail($id);

        // Delete the image file from storage
        if ($photo->album_images && Storage::disk('public')->exists($photo->album_images)) {
            Storage::disk('public')->delete($photo->album_images);
        }

        // Delete the record from the database
        $photo->delete();

        return redirect()->route('admin.photos.index')->with('status-success', 'Photo deleted successfully.');
    }
}
