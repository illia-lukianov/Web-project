<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'badge',
        'price_cents',
        'currency',
        'billing_period',
        'is_featured',
        'cta_text',
        'cta_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'price_cents' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(PricingPlanFeature::class)->orderBy('sort_order');
    }
}
