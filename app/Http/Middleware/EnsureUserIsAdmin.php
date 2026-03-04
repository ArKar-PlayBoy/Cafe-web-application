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
<<<<<<< HEAD
        if (!Auth::guard('admin')->check()) {
=======
        if (! Auth::guard('admin')->check()) {
>>>>>>> 5b466fb (more reliable and front-end changes)
            return redirect()->route('admin.login');
        }

        $user = Auth::guard('admin')->user();
<<<<<<< HEAD
        if (!$user || !$user->isAdmin()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
        }

=======

        if (! $user || ! $user->isAdmin()) {
            Auth::guard('admin')->logout();

            return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
        }

        // Kick out banned admins immediately
        if ($user->isBanned()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('error', 'Your account has been suspended.');
        }

>>>>>>> 5b466fb (more reliable and front-end changes)
        return $next($request);
    }
}
