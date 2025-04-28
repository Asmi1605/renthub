<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if the user has a role in the provided roles
        if (!in_array($user->role, $roles)) {
            // Redirect or abort if the user does not have the required role
            return redirect('/dashboard')->withErrors('You do not have permission to access this page.');
        }

        return $next($request);
    }
}

