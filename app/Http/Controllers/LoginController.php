<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return response()->view('login.index',[
            "title" => "Login",
            "active"=>"login",
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        $user = User::where('username',$credentials['username'])
                            ->where('password',md5($credentials['password']))
                            ->first();
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return back()->with('loginError','Login Failed');
        }
        
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

}
