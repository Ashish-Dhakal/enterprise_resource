<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
//         Check if user is authenticated
//        if (!auth()->check()) {
//            return redirect()->route('login');
//        }

        // Check if user's role matches the allowed roles
        $user = auth()->user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
