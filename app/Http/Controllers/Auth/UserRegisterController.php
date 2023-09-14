<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:user');
    // }
    //save form 
    public function FormOneRegistrationUser()
    {
        return view('auth.registration');
    }


    //menyimpan session form    
    public function storageUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'jabatan' => 'required',
            'NIP' => 'required',
            'NIK' => 'required',
        ]);

        session('user',[
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'NIP' => $request->NIP,
            'NIK' => $request->NIK,
        ]);

        // @dd($request);

        return redirect()->route('infosekolah-index');
    }
}
