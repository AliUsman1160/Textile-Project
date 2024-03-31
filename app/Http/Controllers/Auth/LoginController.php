<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // This is the method that handles the login attempt
    public function login(Request $request)
    {
        dd($request->only(['email','password']));
        // // Validate the user's input
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // // Attempt to log in the user
        // if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     // Authentication passed, redirect to the intended page or a default location
        //     return redirect()->intended('/dashboard');
        // }

        // // Authentication failed, redirect back to the login form with an error message
        // return redirect()->back()->withInput($request->only('email'))->withErrors([
        //     'email' => 'Invalid email or password.',
        // ]);


    }
}
