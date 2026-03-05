<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioProject;
use Illuminate\Http\Request;

class PortfolioProjectController extends Controller
{
    public function index()
    {
        $projects = PortfolioProject::orderBy('sort_order')->paginate(10);
        return view('admin.portfolio-projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.portfolio-projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:portfolio_projects',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'hero_image_url' => 'nullable|url',
            'project_url' => 'nullable|url',
            'client' => 'nullable|string|max:255',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date',
            'is_featured' => 'sometimes|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        PortfolioProject::create($validated);
        return redirect()->route('admin.portfolio-projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(PortfolioProject $portfolioProject)
    {
        return view('admin.portfolio-projects.edit', compact('portfolioProject'));
    }

    public function update(Request $request, PortfolioProject $portfolioProject)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:portfolio_projects,slug,' . $portfolioProject->id,
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'hero_image_url' => 'nullable|url',
            'project_url' => 'nullable|url',
            'client' => 'nullable|string|max:255',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date',
            'is_featured' => 'sometimes|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $portfolioProject->update($validated);
        return redirect()->route('admin.portfolio-projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(PortfolioProject $portfolioProject)
    {
        $portfolioProject->delete();
        return redirect()->route('admin.portfolio-projects.index')->with('success', 'Project deleted successfully.');
    }
}
