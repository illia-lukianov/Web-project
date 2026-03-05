<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\FaqSection;
use Illuminate\Http\Request;

class FaqItemController extends Controller
{
    public function index()
    {
        $items = FaqItem::with('section')->orderBy('sort_order')->paginate(15);
        return view('admin.faq-items.index', compact('items'));
    }

    public function create()
    {
        $sections = FaqSection::orderBy('title')->get();
        return view('admin.faq-items.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_section_id' => 'required|exists:faq_sections,id',
            'question' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        FaqItem::create($validated);
        return redirect()->route('admin.faq-items.index')->with('success', 'FAQ item created.');
    }

    public function edit(FaqItem $faqItem)
    {
        $sections = FaqSection::orderBy('title')->get();
        return view('admin.faq-items.edit', compact('faqItem', 'sections'));
    }

    public function update(Request $request, FaqItem $faqItem)
    {
        $validated = $request->validate([
            'faq_section_id' => 'required|exists:faq_sections,id',
            'question' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $faqItem->update($validated);
        return redirect()->route('admin.faq-items.index')->with('success', 'FAQ item updated.');
    }

    public function destroy(FaqItem $faqItem)
    {
        $faqItem->delete();
        return redirect()->route('admin.faq-items.index')->with('success', 'FAQ item deleted.');
    }
}
