<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\Notice;
use App\Models\NoticePageSetting;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('PUBLIC_PATH') !== null) {
            $this->app->usePublicPath(base_path(env('PUBLIC_PATH')));
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // "system_admin" is the hidden, console-only-assignable super-role
        // (see CLAUDE.md's Roles & Permissions section) — bypasses every
        // permission check outright rather than needing every one of the
        // ~75 generated permissions assigned to it explicitly. Gate::before
        // runs ahead of Spatie's own permission resolution; returning null
        // (not false) for non-system_admin users lets Spatie's normal
        // hasPermissionTo() check still decide the outcome.
        Gate::before(fn ($user, string $ability) => $user->hasRole('system_admin') ? true : null);

        // Attach shared data to all frontend views. The data lookup is heavily
        // cached (SiteSetting::current(), Notice::forMarquee(), etc.), so 
        // running this composer for every partial is fast and safe.
        View::composer('frontend.*', function ($view) {
            static $sharedData = null;
            if ($sharedData === null) {
                $sharedData = [
                    'siteSettings' => SiteSetting::current(),
                    'marqueeNotices' => Notice::forMarquee(),
                    'noticePageSettings' => NoticePageSetting::current(),
                    'languages' => Language::active(),
                    'currentLanguage' => Language::active()->firstWhere('code', app()->getLocale()),
                    'headerMenuItems' => Menu::header()?->tree() ?? new Collection(),
                ];
            }
            
            foreach ($sharedData as $key => $value) {
                $view->with($key, $value);
            }
        });
    }
}
