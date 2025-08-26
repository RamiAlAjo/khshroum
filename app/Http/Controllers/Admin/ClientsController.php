<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Client;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Handle image file upload
        $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
        $imagePath = 'uploads/clients/' . $imageName;
        $request->file('image')->move(public_path('uploads/clients'), $imageName);

        $data['image'] = $imagePath;

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $data = $request->validate([
            'url' => 'required|url',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($client->image && File::exists(public_path($client->image))) {
                File::delete(public_path($client->image)); // Delete old image
            }

            // Handle new image upload
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'uploads/clients/' . $imageName;
            $request->file('image')->move(public_path('uploads/clients'), $imageName);

            $data['image'] = $imagePath;
        } else {
            $data['image'] = $client->image; // keep old image
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        // Delete the image file if it exists
        if ($client->image && File::exists(public_path($client->image))) {
            File::delete(public_path($client->image)); // Delete image
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('status-success', 'Client deleted successfully!');
    }
}
