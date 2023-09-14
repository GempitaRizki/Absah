<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\NPWP;
use App\Models\Sekolah;

class LoginRegisterController extends Controller
{
    // public function __construct()

    // {
    //     $this->middleware('guest')->except([
    //         'logout', 'dashboard'
    //     ]);
    // }

    //index satu 
    public function index()
    {
        return view('auth.validationform');
    }
    //index dua
    public function form()
    {
        return view('auth.registration');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|numeric',
            'jabatan' => 'required',
            'NIP' => 'required|min:18',
            'NIK' => 'required|min:16',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'jabatan' => $request->jabatan,
            'NIP' => $request->NIP,
            'NIK' => $request->NIK,
            
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return Redirect::route('DataSekolah');


    }
}


