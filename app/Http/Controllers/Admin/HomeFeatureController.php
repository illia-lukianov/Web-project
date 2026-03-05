<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeature;
use Illuminate\Http\Request;

class HomeFeatureController extends Controller
{
    public function index()
    {
        $features = HomeFeature::orderBy('sort_order')->paginate(10);
        return view('admin.home-features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.home-features.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        HomeFeature::create($validated);
        return redirect()->route('admin.home-features.index')->with('success', 'Feature created successfully.');
    }

    public function edit(HomeFeature $homeFeature)
    {
        return view('admin.home-features.edit', compact('homeFeature'));
    }

    public function update(Request $request, HomeFeature $homeFeature)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $homeFeature->update($validated);
        return redirect()->route('admin.home-features.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy(HomeFeature $homeFeature)
    {
        $homeFeature->delete();
        return redirect()->route('admin.home-features.index')->with('success', 'Feature deleted successfully.');
    }
}
