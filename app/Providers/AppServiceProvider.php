<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Wildcard, not just the layout: @include'd section partials inside
        // a page's own @section('content') render in that page's own view
        // scope, which does NOT inherit data a composer attached only to
        // the layout — Blade merges layout composer data only into the
        // layout's own template body (confirmed empirically), not into
        // child views or their includes. Every frontend.* view needs this
        // directly for that reason.
        View::composer('frontend.*', function ($view) {
            $view->with('siteSettings', SiteSetting::current());
        });
    }
}
