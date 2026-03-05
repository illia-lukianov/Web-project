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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // create admin from environment variable (useful on Render free plan)
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        if ($adminEmail) {
            $admin = User::firstOrNew(['email' => $adminEmail]);
            $admin->name = $admin->name ?: 'Administrator';
            $admin->password = bcrypt($adminPassword);
            $admin->role = 'admin';
            $admin->email_verified_at = $admin->email_verified_at ?: now();
            $admin->save();
        }
    }
}
