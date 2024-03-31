<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view("login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Invalid email or password.',
            ]);
        }
    
        if ($user->activate) {
            if (auth()->attempt($credentials)) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->back()->withInput($request->only('email'))->withErrors([
                    'email' => 'Invalid email or password.',
                ]);
            }
        } else {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'account' => 'Account is not activated.',
            ]);
        }
    }
    


    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function request(Request $request){
        return view('request');
    }

    public function saverequest(Request $request){
      
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15', // You can adjust the max length based on your requirements
        ]);
        

    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash the password using Bcrypt
        $user->phone = $request->phone;
        $user->save();

        return redirect('/')->with(["request_send"=> true]);

    }
}



// public function register(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:8', // Adjust the minimum length as needed
//     ]);

//     // Create a new user
//     $user = new User();
//     $user->name = $request->name;
//     $user->email = $request->email;
//     $user->password = Hash::make($request->password); // Hash the password using Bcrypt
//     $user->save();

//     // Additional logic (e.g., sending a welcome email, etc.)

//     return redirect()->route('/');
// }



