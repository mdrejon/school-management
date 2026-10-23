<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch the visitor's language — session + a year-long cookie.
     * Also appends ?lang= to target URL as a cache-busting and
     * cookie-fallback mechanism across HTTP/HTTPS.
     */
    public function update(Request $request, string $code): RedirectResponse
    {
        abort_unless(Language::active()->pluck('code')->contains($code), 404);

        session(['locale' => $code]);
        $request->session()->save();

        // Cross-protocol cookie (works on both http and https)
        $cookie = cookie('locale', $code, 60 * 24 * 365, '/', null, false, false, false, 'Lax');

        $previous = url()->previous();
        $target = $previous ?: url('/');

        // Append ?lang=$code to bypass any browser or server page-cache (e.g. LiteSpeed)
        $parsed = parse_url($target);
        parse_str($parsed['query'] ?? '', $queryParams);
        $queryParams['lang'] = $code;
        $newQuery = http_build_query($queryParams);
        $redirectUrl = ($parsed['scheme'] ?? $request->getScheme()) . '://' . ($parsed['host'] ?? $request->getHost()) . (isset($parsed['port']) ? ':' . $parsed['port'] : '') . ($parsed['path'] ?? '/') . ($newQuery ? '?' . $newQuery : '');

        return redirect($redirectUrl)->withCookie($cookie);
    }
}
