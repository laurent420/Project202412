<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show all users.
     */
    public function showUsers(Request $request): View
    {
        // $users = User::all();
                $users = User::all();

        return view('Users', ['users' => $users]);
    }

    public function dashboard(Request $request): View
    {
        // $users = User::all();
                $users = User::all();

        return view('Users', ['users' => $users]);
    }

    public function ban(User $user)
    {
        $user->update(['is_banned' => 1]);
        $user->update(['beginBan' => date_add(now())]);
        $user->update(['endBan' => data_set()]);
        return redirect()->back()->with('success', 'User has been banned successfully.');
    }
    
    public function unban(User $user)
    {
        $user->update(['is_banned' => 0]);
        $user->update(['beginBan' => NULL]);
        $user->update(['endBan' => NULL]);
        return redirect()->back()->with('success', 'User has been unbanned successfully.');
    }



}
