<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

use App\Models\MasterBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Village;
use App\Models\Subdistricts;
use App\Models\Districts;
use App\Models\MasterStatus;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Str;
use App\Models\StoreDetail;
use App\Models\BankStore;

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

        $sellerType = $request->input('seller_type');
        $sellerTypeStatus = MasterStatus::where('name', $sellerType)->first();
        if (!$sellerTypeStatus) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Data yang dimasukkan tidak valid.']);
        }

        $storeSession = $request->all();
        $storeSession = [
            'surel' => $request->input('surel'),
            'password' => $request->input('password'),
            'store_name' => $request->input('store_name'),
            'seller_type' => $sellerTypeStatus->id,
            'seller_type_name' => $sellerTypeStatus->name,
            'role' => 1,
        ];

        session(['storeSession' => $storeSession]);

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
        ]);

        $storeSession = session('storeSession');
        $storeFormSession = $storeSession;
        $storeFormSession = array_merge($storeFormSession, $request->all());

        $pkpStatus = MasterStatus::where('name', $storeFormSession['pkp'])->value('id');
        if ($pkpStatus !== null) {
            $storeFormSession['pkp'] = $pkpStatus;
        }

        $kepemilikan_usahaStatus = MasterStatus::where('name', $storeFormSession['kepemilikan_usaha'])->value('id');
        if ($kepemilikan_usahaStatus !== null) {
            $storeFormSession['kepemilikan_usaha'] = $kepemilikan_usahaStatus;
        }

        $kategori_usahaStatus = MasterStatus::where('name', $storeFormSession['kategori_usaha'])->value('id');
        if ($kategori_usahaStatus !== null) {
            $storeFormSession['kategori_usaha'] = $kategori_usahaStatus;
        }

        session(['storeFormSession' => $storeFormSession]);
        dd(session('storeFormSession'));

        return redirect()->route('indexForm.info-ttd');
    }

    public function indexForm()
    {
        return view('seller.ttdToko');
    }

    public function IndexFormStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
            'NIK' => 'required',
            'NPWP' => 'required',
            'phone_number' => 'required',
        ]);

        $storeOwner = $request->all();
        session(['storeOwner' => $storeOwner]);

        // dd(session('storeOwner'));

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

        $locationSessionStore = $request->all();
        session(['locationSessionStore' => $locationSessionStore]);
        // dd(session('locationSessionStore'));

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

        $bankSession = $request->all();
        session(['bankSession' => $bankSession]);

        $bankStoreStatus = BankStore::where('bank_id', $bankSession['bank_id'])->value('name');
        if ($bankStoreStatus !== null) {
            $bankSession['bank_id'] = $bankStoreStatus;
        }

        // dd(session('bankSession'));
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
            'districts' => 'required|array',
            'kategori_product' => 'required|string',
        ]);

        $kategoriProduct = [$request->input('kategori_product')];
        $WilayahJualSession = $request->only('districts');
        $WilayahJualSession['kategori_product'] = $kategoriProduct;

        session(['WilayahJualSession' => $WilayahJualSession]);

        return redirect()->route('registrationSummary');
    }


    public function Summary()
    {
        $WilayahJualSession = session('WilayahJualSession', []);
        if (isset($WilayahJualSession['districts'])) {
            $districtIds = $WilayahJualSession['districts'];
            $wilayahJualDistricts = Districts::whereIn('id', $districtIds)->get();
        } else {
            $wilayahJualDistricts = null;
        }

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

        $storeSession = session('storeSession', []);
        $storeFormSession = session('storeFormSession', []);
        $storeOwner = session('storeOwner', []);
        $bankSession = session('bankSession', []);
        $WilayahJualSession = session('WilayahJualSession', []);

        return view('seller.registration_summary', compact('province', 'districts', 'subdistricts', 'villages', 'storeSession', 'storeFormSession', 'storeOwner', 'locationSessionStore', 'bankSession', 'WilayahJualSession', 'wilayahJualDistricts'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $storeSession = session('storeSession', []);
        $storeFormSession = session('storeFormSession', []);
        $bankSession = session('bankSession', []);

        $bankName = $bankSession['name'];
        $masterBank = MasterBank::where('name', $bankName)->first();
        
        if ($masterBank) {
            $statusId = $masterBank->status_id;
        } else {
            return redirect()->back()->with('error', 'Nama bank tidak valid.');
        }

        if (array_key_exists('store_name', $storeSession)) {
            $user = new User();
            $user->name = $storeSession['store_name'];
            $user->password = $storeSession['password'];
            $user->email = $storeSession['surel'];
            $user->role = 1;
            $user->save();

            $store = new Store();
            $store->store_name = $storeFormSession['store_name'];
            $store->slug = Str::slug($storeFormSession['store_name'], '');
            $store->public_email = $storeFormSession['public_email'];
            $store->phone_number = $storeFormSession['phone_number'];
            $store->web_name = $storeFormSession['web_name'];
            $store->short_description = $storeFormSession['short_description'];
            $store->about_us = $storeFormSession['about_us'];
            $store->fb_name = $storeFormSession['fb_name'];
            $store->tw_name = $storeFormSession['tw_name'];
            $store->linked_name = $storeFormSession['linked_name'];
            $store->yt_name = $storeFormSession['yt_name'];
            $store->seller_type = $storeFormSession['seller_type'];
            $store->status_id = 5;
            $store->save();

            $storeDetail = new StoreDetail();
            $storeDetail->kepemilikan_usaha = $storeFormSession['kepemilikan_usaha'];
            $storeDetail->npwp = $storeFormSession['npwp'];
            $storeDetail->kekayaan_bersih = $storeFormSession['kekayaan_bersih'];
            $storeDetail->pkp = $storeFormSession['pkp'];
            $storeDetail->nib = $storeFormSession['nib'];
            $storeDetail->skb = $storeFormSession['skb'];
            $storeDetail->akta = $storeFormSession['akta'];
            $storeDetail->siup = $storeFormSession['siup'];
            $storeDetail->akta_perusahaan = $storeFormSession['akta_perusahaan'];
            $storeDetail->kategori_usaha = $storeFormSession['kategori_usaha'];
            $storeDetail->tdp = $storeFormSession['tdp'];
            $storeDetail->kbli = $storeFormSession['kbli'];
            $storeDetail->store_id = $store->id;
            $storeDetail->save();

            $bankStore = new BankStore();
            $bankStore->name = $bankSession['name'];
            $bankStore->number = $bankSession['number'];
            $bankStore->status_id = $statusId; 
            $bankStore->store_id = $store->id;
            $bankStore->save();


            session(['forgot' => true]);

            return redirect()->route('indexCMSSeller')->with('success', 'Data toko berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Data yang diperlukan tidak tersedia.');
        }
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
