<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserRegisterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:user');
    // }
    // save form 
    public function FormOneRegistrationUser()
    {
        return view('auth.registration');
    }


    //menyimpan session form    
    public function storageUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'jabatan' => 'required',
            'NIP' => 'required',
            'NIK' => 'required',
        ]);
    
        session([
            'user' => [
                'username' => $request->username,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'NIP' => $request->NIP,
                'NIK' => $request->NIK,
                ]
            ]);
    
        dd(session('user'));

        // User::create([
        //     'name' => $request->name,
        //     'email' =>$request->email,
        //     'jabatan' => $request->jabatan,
        //     'NIP' => $request->NIP,
        //     'NIK' => $request->NIK,
        // ]);
    
        return redirect()->route('infosekolah-index');
    }
}