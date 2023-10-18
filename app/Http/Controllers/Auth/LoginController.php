<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $dashboardSeller = 'seller.dashboard';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            if (auth()->user()->role == 'mitra') {
                return redirect()->route('home.mitra');
            } else if (auth()->user()->role == 'seller') {
                return redirect()->route('seller.dashboard');
            } else {
                return redirect()->route('dashboard.user');
            }
        } else {
            return redirect()
                ->route('login')
                ->with('error', 'Email dan Password tidak sesuai ! ');
        }
    }
}
