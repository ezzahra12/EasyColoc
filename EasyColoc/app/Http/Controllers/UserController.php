<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
      public function ban(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $user->update(['is_banned' => true]);

        return back()->with('success', 'User banned successfully');
    }

    public function unban(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $user->update(['is_banned' => false]);

        return back()->with('success', 'User unbanned successfully');
    }
}
