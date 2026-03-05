<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('key')->paginate(20);
        return view('admin.site-settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.site-settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:site_settings,key',
            'value' => 'nullable|string',
        ]);

        SiteSetting::create($validated);
        return redirect()->route('admin.site-settings.index')->with('success', 'Setting created successfully.');
    }

    public function edit(SiteSetting $siteSetting)
    {
        return view('admin.site-settings.edit', compact('siteSetting'));
    }

    public function update(Request $request, SiteSetting $siteSetting)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:site_settings,key,' . $siteSetting->id,
            'value' => 'nullable|string',
        ]);

        $siteSetting->update($validated);
        return redirect()->route('admin.site-settings.index')->with('success', 'Setting updated successfully.');
    }

    public function destroy(SiteSetting $siteSetting)
    {
        $siteSetting->delete();
        return redirect()->route('admin.site-settings.index')->with('success', 'Setting deleted successfully.');
    }
}
