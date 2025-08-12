<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth('api')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();

        if (!$user->role || !$user->hasRole($role)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
