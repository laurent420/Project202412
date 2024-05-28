<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ban;
use App\Models\User;

class BanController extends Controller
{
    public function ban(User $user)
    {
        // Create a new ban record associated with the user
        $user->bans()->create([
            'is_banned' => true,
            'begin_ban' => Carbon::now(),
            'end_ban' => Carbon::now()->addMonths(3),
            'description' => 'User banned.'
        ]);

        // Update the user's is_banned attribute
        $user->update(['is_banned' => true]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User has been banned successfully.');
    }

    public function unban(User $user)
    {
        // Remove the latest ban record associated with the user
        $user->bans()->latest()->first()->delete();

        // Update the user's is_banned attribute
        $user->update(['is_banned' => false]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User has been unbanned successfully.');
    }
}
