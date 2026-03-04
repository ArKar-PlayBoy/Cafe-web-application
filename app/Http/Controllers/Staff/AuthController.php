<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
>>>>>>> 5b466fb (more reliable and front-end changes)

class AuthController extends Controller
{
    public function showLogin()
    {
<<<<<<< HEAD
=======
        if (Auth::guard('staff')->check()) {
            return redirect()->route('staff.dashboard');
        }

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('staff.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

<<<<<<< HEAD
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user || (!$user->isStaff() && !$user->isAdmin())) {
=======
        // Rate limiting: max 5 attempts per minute per email+IP
        $throttleKey = Str::lower($request->input('email')).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => __('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }

        $user = \App\Models\User::where('email', $request->email)->first();

        if (! $user || (! $user->isStaff() && ! $user->isAdmin())) {
            RateLimiter::hit($throttleKey);

>>>>>>> 5b466fb (more reliable and front-end changes)
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

<<<<<<< HEAD
        if (Auth::guard('staff')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('staff.dashboard'));
        }

=======
        if ($user->is_banned) {
            if ($user->ban_reason) {
                $request->session()->flash('ban_reason', $user->ban_reason);
            }

            return back()->withErrors([
                'email' => 'Your account has been banned. Contact support.',
            ]);
        }

        if (Auth::guard('staff')->attempt($credentials)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended(route('staff.dashboard'));
        }

        RateLimiter::hit($throttleKey);

>>>>>>> 5b466fb (more reliable and front-end changes)
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
<<<<<<< HEAD
=======

>>>>>>> 5b466fb (more reliable and front-end changes)
        return redirect()->route('staff.login');
    }
}
