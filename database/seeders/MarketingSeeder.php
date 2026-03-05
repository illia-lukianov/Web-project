<?php

namespace Database\Seeders;

use App\Models\HomeFeature;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'Fast setup',
                'description' => 'Launch quickly with a clean, modern Laravel + Bootstrap stack.',
                'icon' => 'bi bi-lightning-charge',
                'sort_order' => 1,
            ],
            [
                'title' => 'Responsive by default',
                'description' => 'Looks great on phones, tablets, and desktops out of the box.',
                'icon' => 'bi bi-phone',
                'sort_order' => 2,
            ],
            [
                'title' => 'Admin-managed content',
                'description' => 'Blog content is editable in the admin panel and rendered on the public pages.',
                'icon' => 'bi bi-ui-checks',
                'sort_order' => 3,
            ],
            [
                'title' => 'Scalable structure',
                'description' => 'Clear models, migrations, and seeders so the project can grow easily.',
                'icon' => 'bi bi-diagram-3',
                'sort_order' => 4,
            ],
        ];

        foreach ($features as $data) {
            HomeFeature::query()->updateOrCreate(
                ['title' => $data['title']],
                $data + ['is_active' => true]
            );
        }

        $testimonials = [
            [
                'name' => 'Tom Ato',
                'role' => 'CEO',
                'company' => 'Pomodoro',
                'quote' => 'Working with this template saved us tons of development time. Clean structure, fast pages, and easy to extend.',
                'avatar_url' => 'https://dummyimage.com/80x80/ced4da/6c757d',
                'sort_order' => 1,
            ],
            [
                'name' => 'Evelyn Martinez',
                'role' => 'Product Lead',
                'company' => 'Nova Studio',
                'quote' => 'Great UX, clear content blocks, and everything is ready for real data.',
                'avatar_url' => 'https://dummyimage.com/80x80/adb5bd/495057',
                'sort_order' => 2,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::query()->updateOrCreate(
                ['name' => $data['name'], 'company' => $data['company']],
                $data + ['is_active' => true]
            );
        }
    }
}
