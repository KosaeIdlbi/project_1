<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard): Response
    {
        if ($guard == "admin") {
            $user = Auth::guard($guard)->user();
            if (!$user->email_verified_at) {
                return $next($request);
            } else {
                return response("you are verified");
            }
        } elseif ($guard == "web") {
            $user = Auth::guard($guard)->user();
            if (!$user->email_verified_at) {
                return $next($request);
            } else {
                return response("you are verified");
            }
        }
        return $next($request);
    }
}
