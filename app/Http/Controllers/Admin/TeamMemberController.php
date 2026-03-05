<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->paginate(10);
        return view('admin.team-members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'avatar_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        TeamMember::create($validated);
        return redirect()->route('admin.team-members.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'avatar_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $teamMember->update($validated);
        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted.');
    }
}
