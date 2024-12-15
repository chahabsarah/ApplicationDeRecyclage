<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('AdminLogin'); // This can be renamed to a more generic login view
    }

    public function login(Request $request)
    {
        // Validate the form data



        // Attempt to log the user in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Redirect based on user role
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended('/');
            } elseif (Auth::user()->hasRole('client')) {
                return redirect()->intended('/centres'); // Change to your client dashboard route
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Access denied. Unrecognized role.');
            }
        }

        // If the login attempt was unsuccessful
        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/load-login')->with('success', 'You have been logged out.');
    }
}
