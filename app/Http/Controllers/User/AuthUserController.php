<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Districts;
use App\Models\Subdistricts;
use App\Models\Village;

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

        return redirect()->route('index.Sekolah');
    }

    public function IndexLocation()
    {
        $provinces = Province::all();
        $districts = [];
        $subdistricts = [];
        $villages = [];

        return view('user.info-sekolah', compact('provinces', 'districts', 'subdistricts', 'villages'));
    }

    public function getDistrictsByProvince($provinceId)
    {
        $districts = Districts::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function getSubDistrictsByDistrict($districtId)
    {
        $subdistricts = Subdistricts::where('districts_id', $districtId)->get();
        return response()->json($subdistricts);
    }


    public function storeLocation(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'districts' => 'required',
            'subdistricts' => 'required',
            'villages' => 'required',
            'address' => 'required',
            'postal_code' => 'required'
        ]);

        $locationSessionUser = [
            'province' => $request->input('province'),
            'districts' => $request->input('districts'),
            'subdistricts' => $request->input('subdistricts'),
            'villages' => $request->input('villages'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code')
        ];

        session(['locationSessionUser' => $locationSessionUser]);

        return redirect()->route('index.form');
    }

    public function LocationSummary()
    {
        $locationSessionStore = session('locationSessionStore', []);

        if (isset($locationSessionStore['province'])) {
            $province = Province::find($locationSessionStore['province']);
        } else {
            $province = null;
        }

        if (isset($locationSessionStore['districts'])) {
            $districts = Districts::find($locationSessionStore['districts']);
        } else {
            $districts = null;
        }

        if (isset($locationSessionStore['subdistricts'])) {
            $subdistricts = Subdistricts::find($locationSessionStore['subdistricts']);
        } else {
            $subdistricts = null;
        }

        if (isset($locationSessionStore['villages'])) {
            $villages = Village::find($locationSessionStore['villages']);
        } else {
            $villages = null;
        }

        $WilayahJualSession = session('WilayahJualSession', []);

        if (isset($WilayahJualSession['districts'])) {
            $districtIds = $WilayahJualSession['districts'];
            $wilayahJualDistricts = Districts::whereIn('id', $districtIds)->get();
        } else {
            $wilayahJualDistricts = null;
        }

        return view('seller.registration_summary', compact('province', 'districts', 'subdistricts', 'villages', 'wilayahJualDistricts'));
    }
}


class LocationServiceStore
{
    public static function getProvinces()
    {
        return Province::all();
    }

    public static function getDistrictsByProvince($provinceId)
    {
        return Districts::where('province_id', $provinceId)->get();
    }

    public static function getSubDistrictsByDistrict($districtId)
    {
        return SubDistricts::where('districts_id', $districtId)->get();
    }

    public static function getVillagesBySubDistrict($subdistrictId)
    {
        return Village::where('subdistrict_id', $subdistrictId)->get();
    }
}
