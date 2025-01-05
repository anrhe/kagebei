<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // dd(Auth::check());

        // Check if the user is authenticated
        if (!Auth::check()) {
            info('User is not authenticated, redirecting to login page');
            return redirect('login');
        }

        // Get the authenticated user's role
        $user = Auth::user();

        // Check if the user has one of the specified roles
        if (!in_array($user->role, $roles)) {
            info('User is not authorized to perform this action');
            return redirect('/');
        }

        return $next($request);
    }
}
