<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\ProductFile;
use App\Models\SumberDana;
use App\Models\Store;
use App\Models\ProductPrice;
use App\Models\Province;
use App\Models\Districts;
use App\Models\SubDistricts;
use App\Models\Village;
use App\Models\CourierPartner;
use App\Models\BankMp;
use App\Models\IprCart;
use App\Models\IprCartItem;

class CartController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $product = ProductSku::first();
        $productPrice = ProductPrice::where('product_sku_id', $product->id)->first();
        $productName = $product->name;

        $productFile = ProductFile::first();
        $imagePath = $productFile ? $productFile->path : 'default/path';

        $productPrice = ProductPrice::first();
        $price = $productPrice ? $productPrice->price : null;
        $storeName = $this->getStoreName($product);

        $sumberDanas = SumberDana::all();

        $partnerCouriers = CourierPartner::all();

        $provinces = Province::all();
        $districts = [];
        $subdistricts = [];
        $villages = [];

        $metodePembayaran = BankMp::getBankAvailableBuyer();

        $cart = IprCart::first(); 
        $cart_id = $cart ? $cart->id : null;
        
        $cartItem = IprCartItem::where('product_sku_id', $product->id)
        ->where('cart_id', $cart_id)
        ->first();

        $qty = $cartItem ? $cartItem->qty : null;

        return view('user.cartDetail', [
            'price' => $price,
            'productName' => $productName,
            'imagePath' => $imagePath,
            'storeName' => $storeName,
            'sumberDanas' => $sumberDanas,
            'provinces' => $provinces,
            'districts' => $districts,
            'subdistricts' => $subdistricts,
            'villages' => $villages,
            'partnerCouriers' => $partnerCouriers,
            'metodePembayaran' => $metodePembayaran,
            'qty' => $qty,
        ]);
    }


    private function getStoreName($product)
    {
        $storeId = $product->store_id;
        if ($storeId) {
            $store = Store::find($storeId);
            if ($store) {
                return $store->store_name;
            }
        }
        return null;
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
}
