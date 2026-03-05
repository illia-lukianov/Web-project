<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use App\Models\PricingPlanFeature;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free',
                'slug' => 'free',
                'badge' => null,
                'price_cents' => 0,
                'currency' => 'USD',
                'billing_period' => 'mo',
                'is_featured' => false,
                'sort_order' => 1,
                'features' => [
                    ['feature' => '1 user', 'is_included' => true, 'sort_order' => 1],
                    ['feature' => '5GB storage', 'is_included' => true, 'sort_order' => 2],
                    ['feature' => 'Unlimited public projects', 'is_included' => true, 'sort_order' => 3],
                    ['feature' => 'Community access', 'is_included' => true, 'sort_order' => 4],
                    ['feature' => 'Unlimited private projects', 'is_included' => false, 'sort_order' => 5],
                    ['feature' => 'Dedicated support', 'is_included' => false, 'sort_order' => 6],
                    ['feature' => 'Free linked domain', 'is_included' => false, 'sort_order' => 7],
                    ['feature' => 'Monthly status reports', 'is_included' => false, 'sort_order' => 8],
                ],
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'badge' => 'Popular',
                'price_cents' => 900,
                'currency' => 'USD',
                'billing_period' => 'mo',
                'is_featured' => true,
                'sort_order' => 2,
                'features' => [
                    ['feature' => '5 users', 'is_included' => true, 'sort_order' => 1],
                    ['feature' => '5GB storage', 'is_included' => true, 'sort_order' => 2],
                    ['feature' => 'Unlimited public projects', 'is_included' => true, 'sort_order' => 3],
                    ['feature' => 'Community access', 'is_included' => true, 'sort_order' => 4],
                    ['feature' => 'Unlimited private projects', 'is_included' => true, 'sort_order' => 5],
                    ['feature' => 'Dedicated support', 'is_included' => true, 'sort_order' => 6],
                    ['feature' => 'Free linked domain', 'is_included' => true, 'sort_order' => 7],
                    ['feature' => 'Monthly status reports', 'is_included' => false, 'sort_order' => 8],
                ],
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'badge' => null,
                'price_cents' => 4900,
                'currency' => 'USD',
                'billing_period' => 'mo',
                'is_featured' => false,
                'sort_order' => 3,
                'features' => [
                    ['feature' => 'Unlimited users', 'is_included' => true, 'sort_order' => 1],
                    ['feature' => '5GB storage', 'is_included' => true, 'sort_order' => 2],
                    ['feature' => 'Unlimited public projects', 'is_included' => true, 'sort_order' => 3],
                    ['feature' => 'Community access', 'is_included' => true, 'sort_order' => 4],
                    ['feature' => 'Unlimited private projects', 'is_included' => true, 'sort_order' => 5],
                    ['feature' => 'Dedicated support', 'is_included' => true, 'sort_order' => 6],
                    ['feature' => 'Unlimited linked domains', 'is_included' => true, 'sort_order' => 7],
                    ['feature' => 'Monthly status reports', 'is_included' => true, 'sort_order' => 8],
                ],
            ],
        ];

        foreach ($plans as $planData) {
            $features = $planData['features'];
            unset($planData['features']);

            $plan = PricingPlan::query()->updateOrCreate(
                ['slug' => $planData['slug']],
                $planData + ['is_active' => true, 'cta_text' => 'Choose plan', 'cta_url' => null]
            );

            foreach ($features as $featureData) {
                PricingPlanFeature::query()->updateOrCreate(
                    ['pricing_plan_id' => $plan->id, 'feature' => $featureData['feature']],
                    $featureData + ['pricing_plan_id' => $plan->id]
                );
            }
        }
    }
}
