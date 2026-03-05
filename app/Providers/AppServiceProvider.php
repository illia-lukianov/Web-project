<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production (Render uses HTTPS)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Share site settings (safe before migrations run)
        View::composer('*', function ($view) {
            $settings = [];

            try {
                if (Schema::hasTable('site_settings')) {
                    $settings = Cache::remember('site_settings', 3600, function () {
                        $flat = SiteSetting::query()->get()->pluck('value', 'key')->toArray();
                        $tree = [];

                        foreach ($flat as $key => $value) {
                            data_set($tree, $key, $value);
                        }

                        return $tree;
                    });
                }
            } catch (Throwable) {
                $settings = [];
            }

            $view->with('site', $settings);
        });
    }
}
