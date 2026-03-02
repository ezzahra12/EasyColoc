<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class InvitationController extends Controller
{
 public function send(Request $request, Colocation $colocation)
{
    if ($colocation->owner_id !== auth()->id()) {
        abort(403);
    }

    $token = Str::uuid();

    $invitation = Invitation::create([
        'email' => $request->email,
        'token' => $token,
        'colocation_id' => $colocation->id,
        'invited_by' => auth()->id(),
    ]);

  $acceptLink = route('invitations.respond', [
    'token' => $token,
    'action' => 'accept'
]);

$refuseLink = route('invitations.respond', [
    'token' => $token,
    'action' => 'refuse'
]);

    Mail::to($request->email)
        ->send(new InvitationMail($acceptLink, $refuseLink));

    return back()->with('success', 'Invitation sent successfully!');
}

public function respond($token, $action)
{
    $invitation = Invitation::where('token', $token)->firstOrFail();

    if ($action === 'refuse') {
        $invitation->delete();
        return redirect()->route('login')
            ->with('info', 'Invitation refused.');
    }

    // Check if user exists
    $existingUser = User::where('email', $invitation->email)->first();

    if (!$existingUser) {
        session([
            'invitation_token' => $token,
            'invitation_email' => $invitation->email,
        ]);

        return redirect()->route('register')
            ->with('info', 'Create an account to accept the invitation.');
    }

    // Logged in but wrong account
    if (Auth::check() && Auth::user()->email !== $invitation->email) {
        Auth::logout();
        return redirect()->route('login')
            ->with('info', 'Please login with: ' . $invitation->email);
    }

    // Not logged in
    if (!Auth::check()) {
        session(['invitation_token' => $token]);
        return redirect()->route('login')
            ->with('info', 'Login to accept the invitation.');
    }

    // ✅ Correct logged-in user
    $user = Auth::user();

    // Check active colocation
    if ($user->colocations()->exists()) {
        return redirect()->route('dashboard')
            ->with('error', 'You already have an active colocation!');
    }

    // Attach user to colocation
    $colocation = $invitation->colocation;
    $colocation->members()->syncWithoutDetaching([
        $user->id => [
            'joined_at' => now(),
            'role' => 'member',
        ]
    ]);

    $invitation->delete();

    return redirect()->route('dashboard')
        ->with('success', 'You joined the colocation successfully!');
}






    public function accept($token)
{
    $invitation = Invitation::where('token', $token)->firstOrFail();

    $user = User::where('email', $invitation->email)->first();

    if($user) {
        $colocation = $invitation->colocation;
        $colocation->members()->syncWithoutDetaching([
    $user->id => ['joined_at' => now(), 'role' => 'member']
]);


        $invitation->delete();

        return redirect()->route('dashboard')->with('success', 'You have joined the colocation!');
    } else {
        // 5️⃣ if user does not exist, store email in session and redirect to signup/login
        session(['invitation_email' => $invitation->email, 'invitation_token' => $invitation->token]);
        return redirect()->route('register')->with('info', 'Create an account to accept the invitation!');
    }
}
}




