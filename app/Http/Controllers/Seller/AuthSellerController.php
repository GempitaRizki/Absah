<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

use App\Models\MasterBank;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\WilayahJual;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Village;
use App\Models\Subdistricts;
use App\Models\Districts;
use App\Models\StoreDetail;
use App\Models\MasterStatus;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;


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

        $storeSession = [
            'surel' => $request->surel,
            'password' => $request->password,
            'store_name' => $request->store_name,
            'seller_type' => $sellerTypeStatus->id,
        ];

        session(['storeSession' => $storeSession]);


        // dd(session('storeSession'));

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

        $storeFormSession = [
            'kepemilikan_usaha' => $request->input('kepemilikan_usaha'),
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
            'pkp' => $request->input('pkp'),
            'kategori_usaha' => $request->input('kategori_usaha'),
            'seller_type' => $storeSession['seller_type'],
        ];

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

        $storeFormSession['store_id'] = 'IP' . substr(Uuid::uuid4()->toString(), -4);

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
        $storeDetail->store_id = $storeFormSession['store_id'];



        $storeDetail->save();
        $store->save();

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
