<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !$request->routeIs('auth.login-success')) {
            return redirect()->route('auth.login-success');
        }

        return $next($request);
    }
}
