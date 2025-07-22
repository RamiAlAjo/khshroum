<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    // Show all members
    public function index()
    {
        $teamMembers = TeamMember::all();
        return view('admin.team.index', compact('teamMembers'));
    }

    // Show form to create a new member
    public function create()
    {
        return view('admin.team.create');
    }

    // Store a new member
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['image'] = $request->file('image')->store('team', 'public');

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }

    // Show individual team member (optional for front usage)
    public function show(TeamMember $teamMember)
    {
        return view('admin.team.show', compact('teamMember'));
    }

    // Show edit form
    public function edit(TeamMember $teamMember, $id)
    {
        $teamMember = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('teamMember'));
    }

    // Update member
    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    // Delete member
    public function destroy(TeamMember $teamMember)
    {
        // Optional: delete old image from storage
        // Storage::delete('public/' . $teamMember->image);

        $teamMember->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }
}
