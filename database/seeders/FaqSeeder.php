<?php

namespace Database\Seeders;

use App\Models\FaqItem;
use App\Models\FaqSection;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title' => 'Account & Billing',
                'sort_order' => 1,
                'items' => [
                    [
                        'question' => 'How do I change my password?',
                        'answer' => 'Go to your profile page and use the “Update Password” form.',
                        'sort_order' => 1,
                    ],
                    [
                        'question' => 'Can I cancel anytime?',
                        'answer' => 'Yes. You can change or cancel your plan at any time from your account settings.',
                        'sort_order' => 2,
                    ],
                    [
                        'question' => 'Do you offer refunds?',
                        'answer' => 'If you were charged by mistake, contact support and we will help you right away.',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'title' => 'Website Issues',
                'sort_order' => 2,
                'items' => [
                    [
                        'question' => 'The site looks broken on my phone. What do I do?',
                        'answer' => 'Try refreshing the page, then clear browser cache. If the issue persists, contact support.',
                        'sort_order' => 1,
                    ],
                    [
                        'question' => 'I found a bug. Where can I report it?',
                        'answer' => 'Use the contact form to send us details and screenshots — we will respond quickly.',
                        'sort_order' => 2,
                    ],
                    [
                        'question' => 'Why is my page loading slowly?',
                        'answer' => 'Performance depends on network and device. We recommend checking your connection and trying again.',
                        'sort_order' => 3,
                    ],
                ],
            ],
        ];

        foreach ($sections as $sectionData) {
            $items = $sectionData['items'];
            unset($sectionData['items']);

            $section = FaqSection::query()->updateOrCreate(
                ['title' => $sectionData['title']],
                $sectionData + ['is_active' => true]
            );

            foreach ($items as $itemData) {
                FaqItem::query()->updateOrCreate(
                    ['faq_section_id' => $section->id, 'question' => $itemData['question']],
                    $itemData + ['faq_section_id' => $section->id, 'is_active' => true]
                );
            }
        }
    }
}
