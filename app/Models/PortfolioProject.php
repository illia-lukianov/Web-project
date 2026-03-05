<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortfolioProject extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'hero_image_url',
        'project_url',
        'client',
        'started_at',
        'finished_at',
        'is_featured',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'started_at' => 'date',
        'finished_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioProjectImage::class)->orderBy('sort_order');
    }
}
