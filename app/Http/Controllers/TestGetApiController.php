<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\npwp_dinas;
use App\Models\Sekolah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TestGetApiController extends Controller
{

    public function index()
    {
        return view('pages.datasekolah');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'npwp' => 'required|min:20',
            'jenjang' => 'required',
            'status' => 'required',
            'email' => 'required|email',
            'no_sekolah' => 'required|numeric|min:10',
            'kepala_sekolah' => 'required',
            'nip_kepala_sekolah' => 'required|numeric|min:18',
            'bendahara_bos' => 'required',
            'nip_bendahara_bos' => 'required|numeric|min:18',
        ]);

        npwp_dinas::create([
            'npwp_dinas' => $request->npwp_dinas
        ]);

        Sekolah::create([
            'npsn' => $request->npsn,
            'npwp_dinas' => $request->npwp_dinas,
            'jenjang' => $request->jenjang,
            'status' => $request->status,
            'email' => $request->email,
            'no_sekolah' => $request->no_sekolah,
            'kepala_sekolah' => $request->kepala_sekolah,
            'nip_kepala_sekolah' => $request->nip_kepala_sekolah,
            'bendahara_bos' => $request->bendahara_bos,
            'nip_bendahara_bos' => $request->nip_bendahara_bos,
            'prov' => $request->prov,
            'kab' => $request->kab,
            'kec' => $request->kec,
            'desa' => $request->desa,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos
        ]);

        $request->session()->regenerate();
        return Redirect::route('saveauth');
    }
}


