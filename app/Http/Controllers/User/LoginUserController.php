<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginUserController extends Controller
{
    public function index()
    {
        return view('login.user');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (auth()->attempt($credentials)) {
            if (auth()->user()->role === 'user') {
                return redirect()->route('Dashboard.User');
            } else {
                return redirect()->route('Dashboard.User');
            }
        } else {
            return redirect()->route('user.login')->with('login', 'Email atau password salah.');
        }
    }
    

    public function DashoardUser()
    {
        return view('cms.user.index');
    }

}
