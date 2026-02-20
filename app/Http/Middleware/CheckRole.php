<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // Check if user has a role assigned
        if (!$user->hasRole()) {
            return redirect()->route('condo-code')
                ->with('error', 'Please complete your registration to access this feature.');
        }

        // Check if user has one of the allowed roles
        if (in_array($user->user_type, $roles)) {
            return $next($request);
        }

        // User doesn't have required role
        abort(403, 'Unauthorized access. You do not have permission to view this page.');
    }
}