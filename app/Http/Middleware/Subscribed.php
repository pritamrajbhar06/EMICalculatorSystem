<?php

namespace App\Http\Middleware;

use App\Enums\UserRegistrationStatus;
use Closure;
use Illuminate\Http\Request;
use Stripe\Tax\Registration;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->registration_status == UserRegistrationStatus::UNPAID) {
            return redirect()->route('subscription.checkout');
        }

        return $next($request);
    }
}
