<?php

namespace App\Http\Controllers\Admin;

use App\Http\controllers\Controller;
use App\Models\PortfolioProjectImage;
use App\Models\PortfolioProject;
use Illuminate\Http\Request;

class PortfolioProjectImageController extends Controller
{
    public function index()
    {
        $images = PortfolioProjectImage::with('project')->orderBy('sort_order')->paginate(15);
        return view('admin.portfolio-project-images.index', compact('images'));
    }

    public function create()
    {
        $projects = PortfolioProject::orderBy('title')->get();
        return view('admin.portfolio-project-images.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'portfolio_project_id' => 'required|exists:portfolio_projects,id',
            'image_url' => 'required|url',
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        PortfolioProjectImage::create($validated);
        return redirect()->route('admin.portfolio-project-images.index')->with('success', 'Image added.');
    }

    public function edit(PortfolioProjectImage $portfolioProjectImage)
    {
        $projects = PortfolioProject::orderBy('title')->get();
        return view('admin.portfolio-project-images.edit', compact('portfolioProjectImage', 'projects'));
    }

    public function update(Request $request, PortfolioProjectImage $portfolioProjectImage)
    {
        $validated = $request->validate([
            'portfolio_project_id' => 'required|exists:portfolio_projects,id',
            'image_url' => 'required|url',
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $portfolioProjectImage->update($validated);
        return redirect()->route('admin.portfolio-project-images.index')->with('success', 'Image updated.');
    }

    public function destroy(PortfolioProjectImage $portfolioProjectImage)
    {
        $portfolioProjectImage->delete();
        return redirect()->route('admin.portfolio-project-images.index')->with('success', 'Image deleted.');
    }
}
