<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TeamMember;

class TeamMemberController extends Controller
{
    public function index()
    {
        // Retrieve all team members
        $teamMembers = TeamMember::all();
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Store the image in the 'team' folder
        $data['image'] = $request->file('image')->store('team', 'public');

        // Create a new team member entry
        TeamMember::create($data);

        // Redirect with success message
        return redirect()->route('admin.team.index')->with('success', 'Team Member created successfully.');
    }

    public function edit($id)
    {
        // Find the team member by ID
        $teamMember = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('teamMember'));
    }

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
            // Delete old image if it exists
            if ($teamMember->image && Storage::disk('public')->exists($teamMember->image)) {
                Storage::disk('public')->delete($teamMember->image);
            }

            // Store the new image
            $data['image'] = $request->file('image')->store('team', 'public');
        } else {
            // Keep the old image if no new one is uploaded
            $data['image'] = $teamMember->image;
        }

        // Update the team member
        $teamMember->update($data);

        // Redirect with success message
        return redirect()->route('admin.team.index')->with('success', 'Team Member updated successfully.');
    }

    public function destroy($id)
    {
        // Find the team member by ID
        $teamMember = TeamMember::findOrFail($id);

        // Delete the image file from storage if it exists
        if ($teamMember->image && Storage::disk('public')->exists($teamMember->image)) {
            Storage::disk('public')->delete($teamMember->image);
        }

        // Delete the team member
        $teamMember->delete();

        // Redirect with success message
        return redirect()->route('admin.team.index')->with('status-success', 'Team Member deleted successfully!');
    }
}
