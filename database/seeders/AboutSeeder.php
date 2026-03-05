<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title' => 'Our founding',
                'body' => 'We started with a simple idea: modern websites should be easy to build, fast to launch, and pleasant to maintain. Today we help teams ship clean, responsive experiences with a solid technical foundation.',
                'image_url' => 'https://source.unsplash.com/600x400/?coding,team',
                'sort_order' => 1,
            ],
            [
                'title' => 'Growth & beyond',
                'body' => 'As we grew, we focused on great UX, maintainable code, and clear content structure. The result is a site that can scale — from a landing page to a full content-driven platform.',
                'image_url' => 'https://source.unsplash.com/600x400/?coding,growth',
                'sort_order' => 2,
            ],
        ];

        foreach ($sections as $data) {
            AboutSection::query()->updateOrCreate(
                ['title' => $data['title']],
                $data + ['is_active' => true]
            );
        }

        $team = [
            [
                'name' => 'Ibbie Eckart',
                'role' => 'Founder & CEO',
                'avatar_url' => '/images/adminlte/user2-160x160.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Arden Vasek',
                'role' => 'CFO',
                'avatar_url' => '/images/adminlte/user4-128x128.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Toribio Nerthus',
                'role' => 'Operations Manager',
                'avatar_url' => '/images/adminlte/user2-160x160.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Malvina Cilla',
                'role' => 'CTO',
                'avatar_url' => '/images/adminlte/user4-128x128.jpg',
                'sort_order' => 4,
            ],
        ];

        foreach ($team as $data) {
            TeamMember::query()->updateOrCreate(
                ['name' => $data['name']],
                $data + ['is_active' => true]
            );
        }
    }
}
