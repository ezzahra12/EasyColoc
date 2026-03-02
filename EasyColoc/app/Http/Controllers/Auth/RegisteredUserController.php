<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
     private function isFirstAdmin(): bool
{
    return User::where('role', 'admin')->doesntExist();
}
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       $isFirstAdmin = $this->isFirstAdmin();

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => $isFirstAdmin ? 'admin' : 'user',
]);
        event(new Registered($user));

       Auth::login($user);

// If invitation session exists → redirect respond to attach user
if (session('invitation_token') && session('invitation_email') === $user->email) {
    $token = session('invitation_token');
    session()->forget(['invitation_token', 'invitation_email']);
    return redirect()->route('invitations.respond', [$token, 'accept']);
}

// No invitation → normal dashboard
return redirect()->route('dashboard');
    }
}
