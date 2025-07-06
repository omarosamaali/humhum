<?php
// app/Http/Middleware/AdminRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== 'مدير') {
            return redirect()->back()->with('error', 'غير مصرح لك بالوصول لهذه الصفحة');
        }

        return $next($request);
    }
}
