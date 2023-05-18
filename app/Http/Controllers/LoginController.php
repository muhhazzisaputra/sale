<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function index() {
        return view('index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email'    => 'email',
            'password' => 'min:5|max:100'
        ]);

        if(Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
