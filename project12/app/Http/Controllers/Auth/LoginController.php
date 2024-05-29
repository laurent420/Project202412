<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'terms' => 'accepted', // Zorgt ervoor dat de gebruiker de voorwaarden moet accepteren
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Controleer of de voorwaarden al geaccepteerd zijn
            if (!Auth::user()->terms_accepted) {
                Auth::logout();
                return back()->withErrors(['terms' => 'You must accept the terms of service to log in.']);
            }

            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}
