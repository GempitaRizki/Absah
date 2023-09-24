<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\MasterBank;
use Illuminate\Http\Request;

class AuthSellerController extends Controller
{

    //storeSession = use for page 1
    //storeSessionFor = use for page 2 
    //owner Session = use for page 3
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
            'web_name' => 'required',
            'public_email' => 'required',
            'phone_number' => 'required',
            'short_description' => 'required',
            'about_us' => 'required',
            'fb_name' => 'required',
            'tw_name' => 'required',
            'linked_name' => 'required',
            'inst_name' => 'required',
            'yt_name' => 'required',
            'nib' => 'required',
            'skb' => 'required',
            'kekayaan_bersih' => 'required',
            'akta' => 'required',
            'akta_perusahaan' => 'required',
            'npwp' => 'required',
            'tdp' => 'required',
            'kbli' => 'required',
            'siup' => 'required',
        ]);

        //session baru
        $storeFormSession = [
            'store_name' => $request->input('store_name'), // SEHARUSNYA  BISA MENGGUNAKAN
            //SESSION SEBELUMNYA  PADA KODE 'store_name' => $session('storeSession)  tetapi ada kendala pada  
            //parameter array harus menggunakan 2 parameter

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
            'phone_number' => 'required'
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

    public function IndexLocationStore(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'districts' => 'required',
            'subdistricts' => 'required',
            'village' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);

        $locationSession = [
            'province' => $request->input('province'),
            'districts' => $request->input('districts'),
            'subdistricts' => $request->input('subdistricts'),
            'village' => $request->input('village'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code')

        ];
        session(['locationSession' => $locationSession]);

        // dd($locationSession);

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

        // dd($bankSession);

        return redirect()->route('indexBank');
    }
}