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

        // Wildcard, not just the layout: @include'd section partials inside
        // a page's own @section('content') render in that page's own view
        // scope, which does NOT inherit data a composer attached only to
        // the layout — Blade merges layout composer data only into the
        // layout's own template body (confirmed empirically), not into
        // child views or their includes. Every frontend.* view needs this
        // directly for that reason.
        View::composer('frontend.*', function ($view) {
            $view->with('siteSettings', SiteSetting::current());
            $view->with('marqueeNotices', Notice::forMarquee());
            $view->with('noticePageSettings', NoticePageSetting::current());
            $view->with('languages', Language::active());
            $view->with('currentLanguage', Language::active()->firstWhere('code', app()->getLocale()));
            $view->with('headerMenuItems', Menu::header()?->tree() ?? new Collection());
        });
    }
}
