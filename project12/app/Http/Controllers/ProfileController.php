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
    

   public function show()
   {
       // Get the currently authenticated user
       $user = auth()->user();

       // Return the profile view with the user's details
       return view('profile', ['user' => $user]);
   }

    // Show method that retrieves the user’s details and passes them to the profile view. //
    public function prof()
    {
        return view('profile', ['user' => Auth::user()]);
    }
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
         $users = User::all();
     
         return view('Users', compact('users'));
     }
     
     public function banUserOverlay(Request $request): View
     {
         $users = User::all();
     
         return view('modal', compact('users'));
     }      

}
