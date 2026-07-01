<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $user_type): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->user_type != $user_type) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}
