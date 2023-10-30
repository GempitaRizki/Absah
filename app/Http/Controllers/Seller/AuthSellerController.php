<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

use App\Models\StoreFile;
use App\Models\WilayahJual;
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
use App\Models\MasterBank;
use App\Models\StoreOwner;
use Illuminate\Support\Facades\DB;


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
        // dd(session('storeFormSession'));

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
        $type = $request->has('ownerCheckbox') ? 19 : 20;
        $storeOwner['type'] = $type;

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

        $bankStoreStatus = MasterBank::where('id', $bankSession['bank_id'])->value('name');
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
            'districts_id' => 'required',
            'kategori_product' => 'required'
        ]);

        $districtsId = implode(',', array_filter($request->input('districts_id')));
        $kategoriProduct = $request->input('kategori_product');

        $WilayahJualSession = session('WilayahJualSession', []);

        $WilayahJualSession['districts_id'] = $districtsId;
        $WilayahJualSession['kategori_product'] = $kategoriProduct;

        session(['WilayahJualSession' => $WilayahJualSession]);

        // dd(session('WilayahJualSession'));
        return redirect()->route('registrationSummary');
    }

    public function indexUpload()
    {
        return view('seller.file-upload');
    }

    public function uploadFileStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'file_type' => 'required'
        ]);
    
        $uploadedFiles = session('uploaded_files', []);
    
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $filename = $request->input('file_type') . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $uploadedFile->storeAs('uploads', $filename, 'public');
            $uploadedFiles[$request->input('file_type')] = [
                'type' => $request->input('file_type'),
                'path' => asset('storage/' . $filePath),
                'name' => $request->input('file_type') . '.' . $uploadedFile->getClientOriginalExtension(),
            ];
        }
    
        session(['uploaded_files' => $uploadedFiles]);
    

// dd($uploadedFiles);        
        return redirect()->route('uploadFiles')->with('success', 'File berhasil diunggah.');
    }
    
    

    public function deleteFile($type)
    {
        $uploadedFiles = session('uploaded_files');

        if (isset($uploadedFiles[$type])) {
            unset($uploadedFiles[$type]);
            session(['uploaded_files' => $uploadedFiles]);

            return redirect()->back()->with('success', 'File berhasil dihapus');
        }
        return redirect()->back()->with('error', 'File Tidak ditemukan');
    }

    public function Summary()
    {
        $WilayahJualSession = session('WilayahJualSession', []);

        $districtIds = isset($WilayahJualSession['districts_id']) ? explode(',', $WilayahJualSession['districts_id']) : [];
        $kategoriProduct = isset($WilayahJualSession['kategori_product']) ? json_decode($WilayahJualSession['kategori_product']) : [];
        $wilayahJualDistricts = Districts::whereIn('id', $districtIds)->get();

        $kategoriProduct = isset($WilayahJualSession['kategori_product']) ? json_decode($WilayahJualSession['kategori_product']) : [];

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
        $locationSessionStore = session('locationSessionStore', []);


        // dd($WilayahJualSession);
        return view('seller.registration_summary', compact('province', 'districts', 'subdistricts', 'villages', 'storeSession', 'storeFormSession', 'storeOwner', 'locationSessionStore', 'bankSession', 'kategoriProduct', 'wilayahJualDistricts'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $storeSession = session('storeSession', []);
            $storeFormSession = session('storeFormSession', []);
            $bankSession = session('bankSession', []);
            $locationSessionStore = session('locationSessionStore', []);
            $storeOwner = session('storeOwner', []);
            $WilayahJualSession = session('WilayahJualSession', []);
            $uploadedFiles = session('uploadedFiles', []);

            if (array_key_exists('store_name', $storeSession)) {
                $user = new User();
                $user->username = $storeSession['store_name'];
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
                $store->address = $locationSessionStore['address'];
                $store->postal_code = $locationSessionStore['postal_code'];
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
                $bankStore->bank_id = $bankSession['bank_id'];
                $bankStore->status_id = 2;
                $bankStore->store_id = $store->id;
                $bankStore->save();

                $storeOwnerStore = new StoreOwner();
                $storeOwnerStore->name = $storeOwner['name'];
                $storeOwnerStore->jabatan = $storeOwner['jabatan'];
                $storeOwnerStore->NIK = $storeOwner['NIK'];
                $storeOwnerStore->NPWP = $storeOwner['NPWP'];
                $storeOwnerStore->phone_number = $storeOwner['phone_number'];
                $storeOwnerStore->store_id = $store->id;
                $storeOwnerStore->type = $storeOwner['type'];
                $storeOwnerStore->save();

                $damnLocation = new WilayahJual();
                $damnLocation->districts_id = $WilayahJualSession['districts_id'];
                $damnLocation->kategori_product = $WilayahJualSession['kategori_product'];
                $damnLocation->store_id = $store->id;
                $damnLocation->save();

                foreach ($uploadedFiles as $fileData) {
                    $fileUpload = new StoreFile();
                    $fileUpload->file_category = 0; 
                    $fileUpload->storefile_bash_url = $fileData['storefile_bash_url'];
                    $fileUpload->storefile = $fileData['storefile'];
                    $fileUpload->store_id = $store->id;
                    $fileUpload->save();
                }

                DB::commit();

                session(['forgot' => true]);
                return redirect()->route('dashboard.index')->with('success', 'Data toko berhasil disimpan. Silahkan melakukan Login');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Puh Sepuh, Tingkiwingki, Dipsi, Lala, Puh.. Sepuh : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
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
