<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ban;
use App\Models\User;

class BanController extends Controller
{
    public function ban(User $user, Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'ban_reason' => 'required|string|max:255', // Update the field name to match the form input
        ]);
    
        // Create a new ban record associated with the user
        $user->bans()->create([
            'is_banned' => true,
            'begin_ban' => now(),
            'end_ban' => now()->addMonths(3),
            'description' => $request->ban_reason, // Update to use the correct field name
        ]);
    
        // Update the user's is_banned attribute
        $user->update(['is_banned' => true]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'User has been banned successfully.');
    }   
    public function unban(User $user)
    {
        $user->bans()->delete(); 
        $user->update(['is_banned' => false]);
        return redirect()->back()->with('success', 'User has been unbanned successfully.');

        if ('end_ban' == now()) {
            $user->bans()->delete();
            $user->update(['is_banned' => false]);
        }
    }
}
