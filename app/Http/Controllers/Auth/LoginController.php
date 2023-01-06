<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * show the login page
     * 
     */
    public function index()
    {
        return view('auth.guest.login');
    }

    /**
     * authentication login 
     * 
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Authentication passed...
            return redirect()->intended('home');
        }
        return redirect()->back()->with('message', 'Email atau Password anda salah!');
    }

    /**
     * Logout 
     * 
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->intended('login');
    }
}
