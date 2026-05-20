<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('pages.login'); // Adjust path if your Blade file is in a different folder
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string'],
        ]);

        $remember = $request->has('remember');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'))->with('success', 'Login successful!');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}