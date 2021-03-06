<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('sign.sign-in', [
            'title' => 'Sign-in'
        ]);
    }

    public function authenticate(Request $request)
    {
        // if ($user->hasRole('admin')) {
        //     return redirect()->route('dashboard');
        // } return redirect()->route('home');
       
       $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
       ]);

       if(Auth::attempt($credentials)) {
           $request->session()->regenerate();
           return redirect()->intended('/');
       } else {redirect()->intended('/dashboard');}
       
       return back()->with('loginError', 'Login failed');

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
