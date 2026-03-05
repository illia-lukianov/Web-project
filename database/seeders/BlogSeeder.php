<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Latest technology news and trends'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'description' => 'Web development tutorials and best practices'],
            ['name' => 'Laravel', 'slug' => 'laravel', 'description' => 'Laravel framework tutorials and tips'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'description' => 'JavaScript programming and frameworks'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Create tags
        $tags = [
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'Vue.js', 'slug' => 'vue-js'],
            ['name' => 'React', 'slug' => 'react'],
            ['name' => 'Tutorial', 'slug' => 'tutorial'],
            ['name' => 'Tips', 'slug' => 'tips'],
            ['name' => 'Best Practices', 'slug' => 'best-practices'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Responsive Design', 'slug' => 'responsive-design'],
            ['name' => 'CSS', 'slug' => 'css'],
            ['name' => 'Database', 'slug' => 'database'],
            ['name' => 'Optimization', 'slug' => 'optimization'],
            ['name' => 'Performance', 'slug' => 'performance'],
            ['name' => 'Framework', 'slug' => 'framework'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['slug' => $tag['slug']],
                $tag
            );
        }

        // Get the admin user
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $admin = User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Admin User',
                    'password' => bcrypt('password'),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ]
            );
        }

        // Create sample posts
        $posts = [
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel-11',
                'content' => 'Laravel 11 brings exciting new features and improvements. In this comprehensive guide, we\'ll explore the latest features and how to get started with the newest version of the popular PHP framework.

Laravel 11 introduces several new features including improved performance, better developer experience, and enhanced security features. The framework continues to evolve while maintaining its elegant syntax and powerful capabilities.

Key features in Laravel 11:
- Improved performance with optimized routing
- Enhanced security features
- Better developer tooling
- Improved database query optimization
- New helper methods and utilities

Getting started is easier than ever with Laravel\'s comprehensive documentation and active community support.',
                'user_id' => $admin->id,
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'published_at' => now()->subDays(2),
                'tags' => ['Laravel', 'PHP', 'Tutorial'],
            ],
            [
                'title' => 'Modern JavaScript Best Practices',
                'slug' => 'modern-javascript-best-practices',
                'content' => 'JavaScript has evolved significantly over the years. This article covers the best practices for writing modern, maintainable JavaScript code.

From ES6+ features to modern frameworks, JavaScript development has never been more exciting. Learn how to write clean, efficient, and maintainable code that scales with your application.

Topics covered:
- Using const and let instead of var
- Arrow functions and their benefits
- Template literals for string interpolation
- Destructuring assignment
- Async/await for asynchronous operations
- Modules and import/export syntax
- Best practices for error handling

These practices will help you write better JavaScript code and become a more effective developer.',
                'user_id' => $admin->id,
                'category_id' => Category::where('slug', 'javascript')->first()->id,
                'published_at' => now()->subDays(5),
                'tags' => ['JavaScript', 'Best Practices', 'Tutorial'],
            ],
            [
                'title' => 'Building Responsive Web Applications',
                'slug' => 'building-responsive-web-applications',
                'content' => 'Responsive web design is crucial in today\'s multi-device world. Learn how to create websites that work perfectly on all screen sizes.

With the increasing variety of devices and screen sizes, responsive design has become essential for modern web development. This guide covers everything you need to know about creating responsive websites.

Key concepts:
- Mobile-first approach
- Flexible grid systems
- Media queries
- Flexible images and media
- CSS Grid and Flexbox
- Testing across devices

Master these techniques to create websites that provide excellent user experiences across all devices.',
                'user_id' => $admin->id,
                'category_id' => Category::where('slug', 'web-development')->first()->id,
                'published_at' => now()->subDays(7),
                'tags' => ['Web Development', 'Responsive Design', 'CSS'],
            ],
            [
                'title' => 'Database Optimization Techniques',
                'slug' => 'database-optimization-techniques',
                'content' => 'Database performance is critical for web applications. Learn proven techniques to optimize your database queries and improve application performance.

Slow database queries can significantly impact user experience and application performance. This comprehensive guide covers various optimization techniques that can dramatically improve your application\'s speed.

Optimization techniques:
- Indexing strategies
- Query optimization
- Database normalization
- Caching strategies
- Connection pooling
- Monitoring and profiling

Implementing these techniques will help you build faster, more scalable applications.',
                'user_id' => $admin->id,
                'category_id' => Category::where('slug', 'technology')->first()->id,
                'published_at' => now()->subDays(10),
                'tags' => ['Database', 'Optimization', 'Performance'],
            ],
            [
                'title' => 'Introduction to Vue.js 3',
                'slug' => 'introduction-to-vue-js-3',
                'content' => 'Vue.js 3 brings powerful new features and improved performance. Learn how to build modern web applications with the latest version of Vue.js.

Vue.js continues to be one of the most popular JavaScript frameworks. Version 3 brings significant improvements and new features that make it even more powerful.

New features in Vue.js 3:
- Composition API
- Better TypeScript support
- Improved performance
- Smaller bundle sizes
- Better tree-shaking
- Improved developer experience

This guide will help you get started with Vue.js 3 and build modern, reactive web applications.',
                'user_id' => $admin->id,
                'category_id' => Category::where('slug', 'javascript')->first()->id,
                'published_at' => now()->subDays(12),
                'tags' => ['Vue.js', 'JavaScript', 'Framework'],
            ],
        ];

        foreach ($posts as $postData) {
            $tags = $postData['tags'];
            unset($postData['tags']);

            $post = Post::firstOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            // Attach tags
            foreach ($tags as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $post->tags()->syncWithoutDetaching($tag->id);
                }
            }
        }
    }
}