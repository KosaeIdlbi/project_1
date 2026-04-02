<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard): Response
    {
        if ($guard == "admin") {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }
        } elseif ($guard == "web") {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('user.home');
            }
        }
        return $next($request);
    }
}
