<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware 
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        $authGuard = Auth::guard($guard);

        if ($authGuard->guest()) {
            return redirect('/login');
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);
        if (!$authGuard->user()->hasAnyRole($roles)) {
            return redirect('/login');
        }

        return $next($request);
    }
}
