<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            if ($user->role !== $role) {
                return redirect()->route($user->role . '.dashboard');
            }

            return $next($request);
        }

        if (Auth::guard('warga')->check()) {
            return redirect()->route('warga.dashboard');
        }

        return redirect()->route('login');
    }
}