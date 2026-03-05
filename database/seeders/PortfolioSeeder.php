<?php

namespace Database\Seeders;

use App\Models\PortfolioProject;
use App\Models\PortfolioProjectImage;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-commerce Redesign',
                'slug' => 'ecommerce-redesign',
                'excerpt' => 'A modern storefront refresh with improved conversion and mobile UX.',
                'description' => 'We redesigned a legacy e-commerce site into a clean, responsive experience. The new layout improves browsing, checkout flow, and content clarity across devices.',
                'hero_image_url' => 'https://source.unsplash.com/1300x700/?code,ecommerce',
                'project_url' => 'https://example.com',
                'client' => 'Acme Retail',
                'started_at' => now()->subMonths(4)->toDateString(),
                'finished_at' => now()->subMonths(2)->toDateString(),
                'is_featured' => true,
                'sort_order' => 1,
                'images' => [
                    ['image_url' => 'https://source.unsplash.com/600x400/?code,ecommerce', 'caption' => 'Product listing UX', 'sort_order' => 1],
                    ['image_url' => 'https://source.unsplash.com/600x400/?code,checkout', 'caption' => 'Checkout improvements', 'sort_order' => 2],
                ],
            ],
            [
                'title' => 'SaaS Landing Page',
                'slug' => 'saas-landing-page',
                'excerpt' => 'High-performance marketing page optimized for speed and clarity.',
                'description' => 'A focused landing page with clear messaging, pricing, and lead capture. Built with reusable sections and clean structure for future expansion.',
                'hero_image_url' => 'https://source.unsplash.com/1300x700/?code,saas',
                'project_url' => 'https://example.com',
                'client' => 'Nova Studio',
                'started_at' => now()->subMonths(3)->toDateString(),
                'finished_at' => now()->subMonths(3)->addWeeks(2)->toDateString(),
                'is_featured' => false,
                'sort_order' => 2,
                'images' => [
                    ['image_url' => 'https://source.unsplash.com/600x400/?hero,section', 'caption' => 'Hero section', 'sort_order' => 1],
                    ['image_url' => 'https://source.unsplash.com/600x400/?pricing', 'caption' => 'Pricing section', 'sort_order' => 2],
                ],
            ],
            [
                'title' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'excerpt' => 'A clean portfolio layout for showcasing projects and blog content.',
                'description' => 'A structured portfolio site with dynamic projects and a blog section. Easy to maintain, fast to load, and responsive across devices.',
                'hero_image_url' => 'https://source.unsplash.com/1300x700/?code,portfolio',
                'project_url' => 'https://example.com',
                'client' => 'Freelance',
                'started_at' => now()->subMonths(2)->toDateString(),
                'finished_at' => now()->subMonths(1)->toDateString(),
                'is_featured' => false,
                'sort_order' => 3,
                'images' => [
                    ['image_url' => 'https://source.unsplash.com/600x400/?code,projects', 'caption' => 'Projects grid', 'sort_order' => 1],
                    ['image_url' => 'https://source.unsplash.com/600x400/?code,details', 'caption' => 'Project details', 'sort_order' => 2],
                ],
            ],
            [
                'title' => 'Company Blog & CMS',
                'slug' => 'company-blog-cms',
                'excerpt' => 'A content-driven blog with categories, tags, and admin management.',
                'description' => 'A blog foundation with admin CRUD for posts, categories, and tags, plus public listing and post pages.',
                'hero_image_url' => 'https://source.unsplash.com/1300x700/?code,blog',
                'project_url' => 'https://example.com',
                'client' => 'Internal',
                'started_at' => now()->subMonths(1)->toDateString(),
                'finished_at' => now()->subWeeks(2)->toDateString(),
                'is_featured' => false,
                'sort_order' => 4,
                'images' => [
                    ['image_url' => 'https://source.unsplash.com/600x400/?code,dashboard', 'caption' => 'Admin dashboard', 'sort_order' => 1],
                    ['image_url' => 'https://source.unsplash.com/600x400/?code,blog', 'caption' => 'Blog page', 'sort_order' => 2],
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $images = $projectData['images'];
            unset($projectData['images']);

            $project = PortfolioProject::query()->updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData + ['is_active' => true]
            );

            foreach ($images as $img) {
                PortfolioProjectImage::query()->updateOrCreate(
                    ['portfolio_project_id' => $project->id, 'image_url' => $img['image_url'], 'caption' => $img['caption']],
                    $img + ['portfolio_project_id' => $project->id]
                );
            }
        }
    }
}
