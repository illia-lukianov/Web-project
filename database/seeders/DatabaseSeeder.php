<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create some dummy users if wanted
        // User::factory(10)->create();

        // create a basic test user without relying on factory (avoids faker null bug)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // create admin from environment variable (useful on Render free plan)
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        if ($adminEmail) {
            User::firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => 'Administrator',
                    'password' => bcrypt($adminPassword),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ]
            );
        }

        // Seed blog content
        $this->call(BlogSeeder::class);
    }
}
