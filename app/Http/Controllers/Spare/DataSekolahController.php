<?php

namespace App\Http\Controllers\Spare;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class DataSekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DataSekolahIndex()
    {
        return view('pages.datasekolah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'npwp' => 'required',
            'bentuk_pendidikan' => 'required',
            'status' => 'required',
            'email_sekolah' => 'required',
            'no_sekolah' => 'numeric|required',
            'kepala_sekolah' => 'required',
            'nip_kepala_sekolah' => 'required',
            'bendahara_bos' => 'required',
            'nip_bendahara_bos' => 'required',
            'prov ' => 'required',
            'kd_kab' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required',
        ]);

        Sekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'npwp' => $request->npwp,
            'bentuk_pendidikan' => $request->bentuk_pendidikan,
            'status' => $request->status,
            'email' => $request->email_sekolah,
            'no_sekolah' => $request->no_sekolah,
            'kepala_sekolah' => $request->kepala_sekolah,
            'nip_kepala_sekolah' => $request->nip_kepala_sekolah,
            'bendahara_bos' => $request->bendahara_bos,
            'nip_bendahara_bos' => $request->nip_bendahara_bos,
            'prov ' => $request->prov,
            'kd_kab' => $request->kd_kab,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_post,
        ]);

        $credentials = $request->only('email');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return Redirect::route('/')->withSuccess('Data Berhasil Disimpan');
    }
}
