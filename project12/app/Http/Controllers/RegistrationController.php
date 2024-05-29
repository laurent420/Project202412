<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function handleUserAgreement(Request $request)
{
    // Validate the request data
    $request->validate([
        'agree' => 'required',
    ]);

    // Get the current user
    $user = Auth::user();

    // Update the user's agreement status
    $user->agreed_to_terms = $request->input('agree') === 'yes';

    // Save the user
    $user->save();

    // Redirect the user to the next page
    return redirect()->route('next.page');
}
}
