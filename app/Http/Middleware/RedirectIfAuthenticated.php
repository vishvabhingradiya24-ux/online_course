<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $user_type = Auth::user()->user_type;

            if ($user_type == 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($user_type == 'teacher') {
                return redirect('/teacher/dashboard');
            }

            return redirect('/student/dashboard');
        }

        return $next($request);
    }
}
