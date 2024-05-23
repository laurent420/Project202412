<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Bans;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProfileUpdateRequest;

class BansController extends Controller
{
    public function ban(User $users)
{
    // Create a new ban record associated with the user
    $ban = $users->bans()->create([
        'is_banned' => true,
        'begin_ban' => now(),
        'end_ban' => now()->addMonths(3),
        'description' => 'User banned.'
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'User has been banned successfully.');
}

public function unban(User $users)
{
    // Create a new ban record associated with the user
    $ban = $users->bans()->create([
        'is_banned' => false,
        'begin_ban' => null,
        'end_ban' => null,
        'description' => null
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'User has been banned successfully.');
}

}
