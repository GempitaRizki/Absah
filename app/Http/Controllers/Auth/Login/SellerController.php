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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password')) && auth()->user()->role == 'seller') {
            return redirect()->route('DashboardSeller');
        }

        return redirect()->route('seller.login')->withErrors(['login' => 'Email atau password salah.']);
    }
}
