<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $data['image'] = $request->file('image')->store('links', 'public');

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
            // Delete old image if it exists
            if ($link->image && Storage::disk('public')->exists($link->image)) {
                Storage::disk('public')->delete($link->image);
            }

            $data['image'] = $request->file('image')->store('links', 'public');
        } else {
            $data['image'] = $link->image; // keep old image
        }

        $link->update($data);

        return redirect()->route('admin.links.index')->with('success', 'Link updated successfully.');
    }

    public function destroy($id)
    {
        $link = Link::findOrFail($id);

        $link->delete();

        return redirect()->route('admin.links.index')->with('status-success', 'Link deleted successfully!');
    }
}
