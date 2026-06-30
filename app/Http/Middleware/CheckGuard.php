<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('warga')->check()) {
        return redirect()->route('warga.dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route(Auth::guard('web')->user()->role . '.dashboard');
        }

        return redirect()->route('login');
        return $next($request);
    }
}
