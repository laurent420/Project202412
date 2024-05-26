<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_banned) {
            // User is banned, log them out and redirect
            Auth::logout();
            return redirect()->route('login')->with('status', 'Your account has been banned.');
        }

        return $next($request);
    }
}
