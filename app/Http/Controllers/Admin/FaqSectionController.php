<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqSection;
use Illuminate\Http\Request;

class FaqSectionController extends Controller
{
    public function index()
    {
        $sections = FaqSection::withCount('items')->orderBy('sort_order')->paginate(10);
        return view('admin.faq-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.faq-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        FaqSection::create($validated);
        return redirect()->route('admin.faq-sections.index')->with('success', 'FAQ section created.');
    }

    public function edit(FaqSection $faqSection)
    {
        return view('admin.faq-sections.edit', compact('faqSection'));
    }

    public function update(Request $request, FaqSection $faqSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $faqSection->update($validated);
        return redirect()->route('admin.faq-sections.index')->with('success', 'FAQ section updated.');
    }

    public function destroy(FaqSection $faqSection)
    {
        $faqSection->delete();
        return redirect()->route('admin.faq-sections.index')->with('success', 'FAQ section deleted.');
    }
}
