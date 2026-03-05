<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function index()
    {
        $sections = AboutSection::orderBy('sort_order')->paginate(10);
        return view('admin.about-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.about-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        AboutSection::create($validated);
        return redirect()->route('admin.about-sections.index')->with('success', 'Section created successfully.');
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('admin.about-sections.edit', compact('aboutSection'));
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $aboutSection->update($validated);
        return redirect()->route('admin.about-sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(AboutSection $aboutSection)
    {
        $aboutSection->delete();
        return redirect()->route('admin.about-sections.index')->with('success', 'Section deleted successfully.');
    }
}
