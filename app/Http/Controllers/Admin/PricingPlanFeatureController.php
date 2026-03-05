<?php

namespace App\Http\Controllers\Admin;

use App\Http\controllers\Controller;
use App\Models\PricingPlanFeature;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanFeatureController extends Controller
{
    public function index()
    {
        $features = PricingPlanFeature::with('plan')->orderBy('sort_order')->paginate(15);
        return view('admin.pricing-plan-features.index', compact('features'));
    }

    public function create()
    {
        $plans = PricingPlan::orderBy('name')->get();
        return view('admin.pricing-plan-features.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pricing_plan_id' => 'required|exists:pricing_plans,id',
            'feature' => 'required|string|max:255',
            'is_included' => 'sometimes|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        PricingPlanFeature::create($validated);
        return redirect()->route('admin.pricing-plan-features.index')->with('success', 'Feature added.');
    }

    public function edit(PricingPlanFeature $pricingPlanFeature)
    {
        $plans = PricingPlan::orderBy('name')->get();
        return view('admin.pricing-plan-features.edit', compact('pricingPlanFeature', 'plans'));
    }

    public function update(Request $request, PricingPlanFeature $pricingPlanFeature)
    {
        $validated = $request->validate([
            'pricing_plan_id' => 'required|exists:pricing_plans,id',
            'feature' => 'required|string|max:255',
            'is_included' => 'sometimes|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $pricingPlanFeature->update($validated);
        return redirect()->route('admin.pricing-plan-features.index')->with('success', 'Feature updated.');
    }

    public function destroy(PricingPlanFeature $pricingPlanFeature)
    {
        $pricingPlanFeature->delete();
        return redirect()->route('admin.pricing-plan-features.index')->with('success', 'Feature deleted.');
    }
}
