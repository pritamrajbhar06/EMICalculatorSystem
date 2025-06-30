<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'user' type
        if (!auth()->check() || auth()->user()->user_type !== 'user') {
            // If not, redirect to the login page with an error message
            return redirect()->route('user.form')->with('error', 'Unauthorized access.');
        }
        return $next($request);
    }
}
