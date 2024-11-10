<?php

namespace App\Modules\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsGuest
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
        if (Auth::guard($guard)->check()) {
            return response()->json([
                'isAuthenticated' => true,
                'message' => 'User is already authenticated.',
                'user' => Auth::guard($guard)->user()
            ]);
        }

        return $next($request);
    }
}
