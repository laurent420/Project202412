<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function ban(User $user)
    {
        $user->is_banned = 1;
        $user->save();

        return redirect()->back()->with('status', 'User banned successfully.');
    }

    public function unban(User $user)
    {
        $user->is_banned = 0;
        $user->save();

        return redirect()->back()->with('status', 'User unbanned successfully.');
    }
}
