<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\MasterBank;
use App\Models\MasterStatus;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\WilayahJual;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Village;
use App\Models\Subdistricts;
use App\Models\Districts;

class AuthSellerController extends Controller
{

    public function index()
    {
        return view('seller.register');
    }

    public function IndexStore(Request $request)
    {
        $request->validate([
            'surel' => 'required',
            'password' => 'required',
            'seller_type' => 'required',
            'store_name' => 'required',
        ]);

        $storeSession = [
            'surel' => $request->surel,
            'password' => $request->password,
            'seller_type' => $request->seller_type,
            'store_name' => $request->store_name,
        ];

        session(['storeSession' => $storeSession]);

        // dd($storeSession);

        return redirect()->route('sellerIndexForm');
    }

    public function form()
    {
        return view('seller.register_form');
    }

    public function FormStore(Request $request)
    {
        // $session = (['storeSession']); meggunakan session dari Form pertama

        $request->validate([
            'store_name' => 'required',
            'public_email' => 'required',
            'phone_number' => 'required',
            'pkp' => 'required',
            'kekayaan_bersih' => 'required',
            'npwp' => 'required',
            'kategori_usaha' => 'required'
        ]);

        //session baru
        $storeFormSession = [
            'store_name' => $request->input('store_name'),
            'web_name' => $request->input('web_name'),
            'public_email' => $request->input('public_email'),
            'phone_number' => $request->input('phone_number'),
            'short_description' => $request->input('short_description'),
            'about_us' => $request->input('about_us'),
            'fb_name' => $request->input('fb_name'),
            'tw_name' => $request->input('tw_name'),
            'linked_name' => $request->input('linked_name'),
            'inst_name' => $request->input('inst_name'),
            'yt_name' => $request->input('yt_name'),
            'nib' => $request->input('nib'),
            'skb' => $request->input('skb'),
            'akta' => $request->input('akta'),
            'siup' => $request->input('siup'),
            'akta_perusahaan' => $request->input('akta_perusahaan'),
            'npwp' => $request->input('npwp'),
            'tdp' => $request->input('tdp'),
            'kbli' => $request->input('kbli'),
            'kekayaan_bersih' => $request->input('kekayaan_bersih'),
            'pkp' => $request->input('pkp')

        ];

        $kekayaan_bersih = $request->input('kekayaan_bersih');
        $kategori_usaha = '';

        if ($kekayaan_bersih < 50000000) {
            $kategori_usaha = 'Mikro';
        } elseif ($kekayaan_bersih >= 50000000 && $kekayaan_bersih <= 500000000) {
            $kategori_usaha = 'Kecil';
        } elseif ($kekayaan_bersih > 500000000 && $kekayaan_bersih <= 10000000000) {
            $kategori_usaha = 'Menengah';
        }

        $storeFormSession['kategori_usaha'] = $kategori_usaha;

        session(['storeFormSession' => $storeFormSession]);

        // dd($storeFormSession);

        return redirect()->route('indexForm.info-ttd');
    }

    public function indexForm()
    {
        return view('seller.ttdToko');
    }

    public function IndexFormStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'NIK' => 'required',
            'NPWP' => 'required',
            'phone_number' => 'required',

        ]);

        $ownerSession = [
            'nama' => $request->input('nama'),
            'jabatan' => $request->input('jabatan'),
            'NIK' => $request->input('NIK'),
            'NPWP' => $request->input('NPWP'),
            'phone_number' => $request->input('phone_number')

        ];
        session(['ownerSession' => $ownerSession]);

        // dd($ownerSession);

        return redirect()->route('IndexSellerLocation');
    }

    public function IndexLocation()
    {
        return view('seller.location');
    }

    //location

    public function getProvinces(Request $request)
{
    $provinces = Province::all();
    return response()->json($provinces);
}

public function getDistricts(Request $request)
{
    $provinceId = $request->input('provinceId');
    $districts = Districts::where('province_id', $provinceId)->get();
    return response()->json($districts);
}

public function getSubdistricts(Request $request)
{
    $districtId = $request->input('districtId');
    $subdistricts = SubDistricts::where('districts_id', $districtId)->get();
    return response()->json($subdistricts);
}

public function getVillages(Request $request)
{
    $subdistrictId = $request->input('subdistrictId');
    $villages = Village::where('subdistrict_id', $subdistrictId)->get();
    return response()->json($villages);
}

    public function WilayahJual()
    {
        return view('seller.WilayahJual');
    }


    public function WilayahJualStore(Request $request)
    {
        $request->validate([
            //belum dapat dilakukan
        ]);

        $wilayahJualSession = [
            //belum dapat dilakukan

        ];
        session(['wilayahJualSession' => $wilayahJualSession]);

        dd($wilayahJualSession);

        return redirect()->route('indexBank');
    }



    //wilayah jual sek 
    public function IndexBank()
    {
        $banks = MasterBank::all();
        return view('seller.Bank', compact('banks'));
    }

    public function IndexBankStore(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'number' => 'required|max:255',
            'name' => 'required|max:255',
        ]);
        $bankSession = [
            'bank_id' => $request->input('bank_id'),
            'number' => $request->input('number'),
            'name' => $request->input('name'),
        ];
        session(['bankSession' => $bankSession]);

        // dd($bankSession);

        return redirect()->route('registrationSummary');
    }

    public function Summary()
    {
        return view('seller.registration_summary');
    }
}
