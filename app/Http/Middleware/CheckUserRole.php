<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if ($request->user() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
