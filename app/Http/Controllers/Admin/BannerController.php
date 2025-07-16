<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.homepage.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.homepage.banner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'button_label_en' => 'nullable|string|max:255',
            'button_label_ar' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'url' => 'nullable|url',
            'position' => 'required|in:top,middle,bottom',
            'status' => 'required|in:active,inactive',
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/banners/';
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($uploadPath), $filename);
            $validated['image'] = $uploadPath . $filename;
        }
        if (Banner::count() >= 3) {
            return redirect()->back()->with('status-error', 'You can only add up to 3 banners.');
        }
        Banner::create($validated);

        return redirect()->route('admin.banner.index')->with('status-success', 'Banner added successfully.');
    }
    public function edit($id)
{
    $banner = Banner::findOrFail($id);
    return view('admin.homepage.banner.edit', compact('banner'));
}

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $validatedData = $request->validate([
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'button_label_en' => 'nullable|string|max:255',
            'button_label_ar' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'position' => 'required|in:top,middle,bottom',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/banners/';
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($uploadPath), $filename);
            $banner->image = $uploadPath . $filename;
        }

        $banner->description_en = $validatedData['description_en'];
        $banner->description_ar = $validatedData['description_ar'];
        $banner->button_label_en = $validatedData['button_label_en'];
        $banner->button_label_ar = $validatedData['button_label_ar'];
        $banner->url = $validatedData['url'];
        $banner->position = $validatedData['position'];
        $banner->status = $validatedData['status'];

        $banner->save();

        return redirect()->route('admin.banner.index')->with('status-success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }
        $banner->delete();

        return redirect()->route('admin.banner.index')->with('status-success', 'Banner deleted successfully.');
    }
}
