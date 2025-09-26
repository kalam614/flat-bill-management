<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
