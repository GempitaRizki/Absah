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
        $input = $request->only('email', 'password');
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (auth()->attempt($input) && auth()->user()->role == 'seller') {
            return redirect()->route('DashboardSeller');
        } else {
            return redirect()->route('seller.login')->withErrors(['login' => 'Email atau password salah.']);
        }
    }
    
    
}
