<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    public function index()
    {
        return view('user.register');
    }

    public function indexStore(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'jabatan' => 'required',
            'NIP' => 'required',
            'NIK' => 'required'
        ]);

        $IndexUserSession = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'jabatan' => $request->jabatan,
            'NIP' => $request->NIP,
            'NIK' => $request->NIK
        ];

        session(['IndexUserSession' => $IndexUserSession]);

        // dd($IndexUserSession);

        return redirect()->route('index.infoSekolah');
    }

    public function infoSekolah()
    {
        return view('user.info-sekolah');
    }

    public function infoSekolahStore(Request $request)
    {
        $request->validate([
            'data_sekolah' => 'required',
            'npsn' => 'required',
            'npwp_dinas' => 'required',
            'bentuk_pendidikan' => 'required',
            'status' => 'required',
            'email_sekolah' => 'required',
            'no_sekolah' => 'required',
            'kepala_sekolah' => 'required',
            'nip_kepala_sekolah' => 'required',
            'bendahara_bos' => 'required',
            'nip_bendahara_bos' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required'
        ]);

        $userSekolahStore = [
            'data_sekolah' => $request->data_sekolah,
            'npsn' => $request->npsn,
            'npwp_dinas' => $request->npwp_dinas,
            'bentuk_pendidikan' => $request->bentuk_pendidikan,
            'status' => $request->status,
            'email_sekolah' => $request->email_sekolah,
            'no_sekolah' => $request->no_sekolah,
            'kepala_sekolah' => $request->kepala_sekolah,
            'nip_kepala_sekolah' => $request->nip_kepala_sekolah,
            'bendahara_bos' => $request->bendahara_bos,
            'nip_bendahara_bos' => $request->nip_bendahara_bos,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,

        ];

        session(['userSekolahStore' => $userSekolahStore]);

        dd($userSekolahStore);

        return redirect()->route('index.Sekolahi');
    }

    
}
