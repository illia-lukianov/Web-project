<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = now()->year;

        $settings = [
            'site.company.name' => 'Dev Blog',
            'site.company.tagline' => 'Dev Blog - A Laravel Blog Starter',
            'site.contact.email' => 'hello@domain.com',
            'site.contact.support_email' => 'support@domain.com',
            'site.contact.press_email' => 'press@domain.com',
            'site.contact.phone' => '+1 (555) 892-9403',
            'site.contact.address' => '100 Main Street, Springfield, USA',
            'site.socials' => [
                'twitter' => 'https://twitter.com/',
                'facebook' => 'https://facebook.com/',
                'linkedin' => 'https://linkedin.com/',
                'youtube' => 'https://youtube.com/',
            ],
            'site.footer.copyright' => "Copyright © {$year} Dev Blog. All rights reserved.",
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}
