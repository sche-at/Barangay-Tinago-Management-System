<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignController extends Controller
{
    public function home()
    {
        return view('/home');
    }
    public function login(Request $request)
    {
        // Validate the incoming request data
        $incomingFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        // Attempt to log the user in with the provided credentials
        if (auth()->attempt(['Username' => $incomingFields['username'], 'password' => $incomingFields['password']])) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();
    
            // Redirect to the home page after successful login
            return redirect('/home'); // Ensure this route shows the home page
        }
    
        // If login fails, redirect back to the sign-in page with an error message
        return back()->withErrors([
            'login' => 'Invalid credentials provided.',
        ]);
    }
    
}
