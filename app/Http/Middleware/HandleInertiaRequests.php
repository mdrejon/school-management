<?php

namespace App\Http\Middleware;

use App\Models\Language;
use App\Models\ModuleSetting;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'siteSettings' => fn () => [
                'logo_url' => SiteSetting::current()->logo_url,
                'footer_logo_url' => SiteSetting::current()->footer_logo_url,
                'site_name' => SiteSetting::current()->site_name,
                'site_title' => SiteSetting::current()->site_title,
                'site_tagline' => SiteSetting::current()->site_tagline,
                'meta_title' => SiteSetting::current()->meta_title,
                'header_logo_height' => SiteSetting::current()->header_logo_height,
                'header_logo_width' => SiteSetting::current()->header_logo_width,
                'primary_color' => SiteSetting::current()->primary_color,
                'secondary_color' => SiteSetting::current()->secondary_color,
            ],
            'auth' => [
                'user' => $request->user() ? array_merge($request->user()->toArray(), [
                    'unreadNotificationsCount' => $request->user()->unreadNotifications()->count(),
                ]) : null,
            ],
            'languages' => fn () => Language::active(),
            'enabledModules' => fn () => ModuleSetting::enabledKeys(),
            'appVersion' => fn () => config('app.version'),
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            'user_roles' => fn () => $request->user() ? $request->user()->roles->pluck('name')->map(fn($role) => strtolower($role)) : [],
        ];
    }
}
