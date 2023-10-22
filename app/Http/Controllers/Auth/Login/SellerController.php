<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index()
    {
        return view('login.seller');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (auth()->attempt($credentials)) {
            if (auth()->user()->role === 'seller') {
                return redirect()->route('handle403');
            } else {
                return redirect()->route('seller.dashboard');
            }
        } else {
            return redirect()->route('seller.login')->with('login', 'Email atau password salah.');
        }
    }
}
