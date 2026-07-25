<?php

namespace App\Http\Middleware;

use App\Models\ModuleSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Route-level kill switch for a disabled module — a plain 404 (not a
 * redirect) so a disabled module leaves no trace that it ever existed,
 * matching "not able to access this module content route" from a
 * developer's Site Configuration toggle. Applied via `->middleware('module:{key}')`
 * to both the public routes (routes/web.php) and, for the same key, the
 * matching admin CRUD route group (routes/admin.php) — the same toggle
 * gates both, since a disabled module is meant to disappear for that
 * client's admin too, not just their visitors.
 */
class EnsureModuleEnabled
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $key): Response
    {
        abort_unless(ModuleSetting::isEnabled($key), 404);

        return $next($request);
    }
}
