<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $userRole = auth()->user()->role;

            return match ($userRole) {
                'mitra' => redirect()->route('home.mitra'),
                'seller' => redirect()->route('seller.dashboard'),
                default => redirect()->route('home'),
            };
        }

        return redirect()
            ->route('login')
            ->with('error', 'Email dan Password tidak sesuai !');
    }
}
