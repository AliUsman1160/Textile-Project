<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $loggedInUser = Auth::user();
        $users = User::where('id', '!=', $loggedInUser->id)
                     ->orderBy('created_at', 'desc')
                     ->paginate(10); // You can adjust the number of users per page
    
        return view("user/user", compact('users'));
    }
    public function changsuperstatus($id){
        $user = User::findOrFail($id);
        $user->super_user = !$user->super_user;
        $user->save();
        return redirect()->back()->with('super', true);
    }
    public function changactivatestatus($id){
        $user = User::findOrFail($id);
        $user->activate = !$user->activate;
        $user->save();
        return redirect()->back()->with('active', true);
    }

}
