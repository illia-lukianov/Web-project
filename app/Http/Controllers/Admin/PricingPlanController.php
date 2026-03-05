<?php

namespace App\Http\Controllers\Admin;

use App\Http\controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderBy('sort_order')->paginate(10);
        return view('admin.pricing-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pricing_plans',
            'badge' => 'nullable|string|max:255',
            'price_cents' => 'nullable|integer',
            'currency' => 'nullable|string|max:10',
            'billing_period' => 'nullable|string|max:50',
            'is_featured' => 'sometimes|boolean',
            'cta_text' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        PricingPlan::create($validated);
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(PricingPlan $pricingPlan)
    {
        return view('admin.pricing-plans.edit', compact('pricingPlan'));
    }

    public function update(Request $request, PricingPlan $pricingPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pricing_plans,slug,' . $pricingPlan->id,
            'badge' => 'nullable|string|max:255',
            'price_cents' => 'nullable|integer',
            'currency' => 'nullable|string|max:10',
            'billing_period' => 'nullable|string|max:50',
            'is_featured' => 'sometimes|boolean',
            'cta_text' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $pricingPlan->update($validated);
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(PricingPlan $pricingPlan)
    {
        $pricingPlan->delete();
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Plan deleted successfully.');
    }
}
