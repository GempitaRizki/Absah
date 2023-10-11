<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\WilayahJual;
use Illuminate\Http\Request;
use App\Models\Province;
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
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();

            $storeSession = session('storeSession', []);
            $storeFormSession = session('storeFormSession', []);
            $bankSession = session('bankSession', []);
            $locationSessionStore = session('locationSessionStore', []);
            $storeOwner = session('storeOwner', []);

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

                $districtsId = session('districtsId');
                $kategoriProduct = session('kategoriProduct');
                $storeId = $store->id;

                if (!empty($districtsId) && !empty($kategoriProduct)) {
                    $wilayahJualData = [];

                    if (!is_array($districtsId)) {
                        $districtsId = [$districtsId];
                    }

                    if (!is_array($kategoriProduct)) {
                        $kategoriProduct = [$kategoriProduct];
                    }

                    foreach ($districtsId as $district) {
                        foreach ($kategoriProduct as $kategori) {
                            $wilayahJualData[] = [
                                'districts_id' => $district,
                                'kategori_product' => $kategori,
                                'store_id' => $storeId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }

                    WilayahJual::insert($wilayahJualData);
                }


                DB::commit();

                session(['forgot' => true]);
                return redirect()->route('products.index')->with('success', 'Data toko berhasil disimpan.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Puh Sepuh, Tingkiwingki, Dipsi, Lala, Puh.. Sepuh : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    jika benar begitu maka bagaimana seharusnya code code ini , apakah tidak gunakan save() ? atau bagaimana kode yang benar. Tolong perbaiki 
}