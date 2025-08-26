<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\TeamMember;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the team members.
     */
    public function index()
    {
        $teamMembers = TeamMember::all();
        return view('admin.team.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created team member in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Ensure the 'uploads/team' directory exists
        $imageDirectory = public_path('uploads/team');
        if (!File::exists($imageDirectory)) {
            File::makeDirectory($imageDirectory, 0755, true);  // Creates the directory if it doesn't exist
        }

        // Store the image in the 'uploads/team' directory
        $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
        $imagePath = 'uploads/team/' . $imageName;
        $request->file('image')->move($imageDirectory, $imageName);

        // Add image path to the data
        $data['image'] = $imagePath;

        // Create a new team member entry
        TeamMember::create($data);

        // Redirect with success message
        return redirect()->route('admin.team.index')->with('success', 'Team Member created successfully.');
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit($id)
    {
        // Find the team member by ID
        $teamMember = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('teamMember'));
    }

    /**
     * Update the specified team member in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the team member by ID
        $teamMember = TeamMember::findOrFail($id);

        // Validate input data
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // If a new image is uploaded
        if ($request->hasFile('image')) {
            // Ensure the 'uploads/team' directory exists
            $imageDirectory = public_path('uploads/team');
            if (!File::exists($imageDirectory)) {
                File::makeDirectory($imageDirectory, 0755, true);  // Creates the directory if it doesn't exist
            }

            // Delete old image if it exists
            if ($teamMember->image && File::exists(public_path($teamMember->image))) {
                File::delete(public_path($teamMember->image)); // Delete old image
            }

            // Store the new image in the 'uploads/team' directory
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'uploads/team/' . $imageName;
            $request->file('image')->move($imageDirectory, $imageName);

            $data['image'] = $imagePath;
        } else {
            // Keep old image if no new one is uploaded
            $data['image'] = $teamMember->image;
        }

        // Update the team member
        $teamMember->update($data);

        // Redirect with success message
        return redirect()->route('admin.team.index')->with('success', 'Team Member updated successfully.');
    }

    /**
     * Remove the specified team member from storage.
     */
    public function destroy($id)
    {
        // Find the team member by ID
        $teamMember = TeamMember::findOrFail($id);

        // Delete the image file from storage if it exists
        if ($teamMember->image && File::exists(public_path($teamMember->image))) {
            File::delete(public_path($teamMember->image)); // Delete image
        }

        // Delete the team member
        $teamMember->delete();

        // Redirect with success message
        return redirect()->route('admin.team.index')->with('status-success', 'Team Member deleted successfully!');
    }
}
