<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::guard('admin')->user();
        if (!$user || !$user->isAdmin()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
