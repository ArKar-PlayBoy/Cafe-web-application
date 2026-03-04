<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
<<<<<<< HEAD
=======
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->is_banned) {
            if ($user->ban_reason) {
                $request->session()->flash('ban_reason', $user->ban_reason);
            }

            return back()->withErrors([
                'email' => 'Your account has been banned. Contact support.',
            ])->onlyInput('email');
        }

>>>>>>> 5b466fb (more reliable and front-end changes)
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
