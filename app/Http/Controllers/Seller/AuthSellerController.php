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
use App\Models\User;

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

        // $store = new Store();
        // $store->seller_type = $storeSession['seller_type'];
        // $store->store_name = $storeSession['store_name'];
        // $store->save();

        // dd($storeSession);

        return redirect()->route('sellerIndexForm');
    }

    public function form()
    {
        return view('seller.register_form');
    }

    public function FormStore(Request $request)
    {

        $request->validate([
            'store_name' => 'required',
            'public_email' => 'required',
            'phone_number' => 'required',
            'pkp' => 'required',
            'kekayaan_bersih' => 'required',
            'npwp' => 'required',
            'kategori_usaha' => 'required'
        ]);

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


        return redirect()->route('IndexSellerLocation');
    }


    public function IndexLocation()
    {
        $provinces = Province::all();
        $districts = [];
        $subdistricts = [];
        $villages = [];

        return view('seller.location', compact('provinces', 'districts', 'subdistricts', 'villages'));
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

    public function getVillagesBySubDistrict($subdistrictId)
    {
        $villages = Village::where('subdistrict_id', $subdistrictId)->get();
        return response()->json($villages);
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

        $locationSessionStore = [
            'province' => $request->input('province'),
            'districts' => $request->input('districts'),
            'subdistricts' => $request->input('subdistricts'),
            'villages' => $request->input('villages'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code')
        ];
        session(['locationSessionStore' => $locationSessionStore]);

        // dd($locationSessionStore);


        return redirect()->route('WilayahJualIndex');
    }

    public function IndexWilayahJual()
    {
        $districts = Districts::all();
        return view('seller.WilayahJual', compact('districts'));
    }

    public function StoreWilayahJual(Request $request)
    {
        $request->validate([
            'districts' => 'required'
        ]);

        $WilayahJualSession = [
            'districts' => $request->input('districts')
        ];

        session(['WilayahJualSession' => $WilayahJualSession]);

        // dd($WilayahJualSession);

        return redirect()->route('indexBank');
    }




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


        return redirect()->route('registrationSummary');
    }

    public function Summary()
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
