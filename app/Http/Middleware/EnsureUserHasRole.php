<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->user_type === 'resident' && is_null($user->condo_id)) {
            $allowedRoutes = [
                'condo-code',
                'condo-code.verify',
                'resident.details',
                'resident.complete',
                'logout'
            ];

            if (!$request->routeIs($allowedRoutes)) {
                return redirect()->route('condo-code')
                    ->with('info', 'Please complete your registration to access this feature.');
            }
        }

        if ($user && $user->hasRole()) {
            $registrationRoutes = [
                'condo-code',
                'condo-code.verify',
                'resident.details',
                'resident.complete'
            ];

            if ($request->routeIs($registrationRoutes)) {
                return redirect()->route('dashboard')
                    ->with('info', 'You have already completed your registration.');
            }
        }

        return $next($request);
    }
}
