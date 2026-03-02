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
    $request->authenticate();

    $user = $request->user();

    // Vérification du bannissement
    if ($user->is_banned) {
        auth()->logout();
        return redirect()->route('login')
            ->withErrors(['email' => 'Your account is banned.']);
    }

    // Vérification du token d'invitation
    if (session('invitation_token') && session('invitation_email') === $user->email) {
        $token = session('invitation_token');
        session()->forget(['invitation_token', 'invitation_email']);
        return redirect()->route('invitations.respond', [$token, 'accept']);
    }

    return redirect()->intended('/dashboard');
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
