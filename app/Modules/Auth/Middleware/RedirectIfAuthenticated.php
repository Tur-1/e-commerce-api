<?php

namespace App\Modules\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if (!Auth::guard($guard)->check()) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'User is not authenticated.'
            ], 401);
        }


        return $next($request);
    }
}
