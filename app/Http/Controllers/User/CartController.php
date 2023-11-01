<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
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
use App\Models\IprOrder;
use App\Models\Sekolah;
use App\Models\MasterStatus;

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

        $sumber_dana_id = SumberDana::all();

        $partnerCouriers = CourierPartner::all();

        $provinces = Province::all();
        $districts = [];
        $subdistricts = [];
        $villages = [];

        $payment_method = BankMp::getBankAvailableBuyer();//iseh null pak 

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
            'sumber_dana_id' => $sumber_dana_id,
            'provinces' => $provinces,
            'districts' => $districts,
            'subdistricts' => $subdistricts,
            'villages' => $villages,
            'partnerCouriers' => $partnerCouriers,
            'payment_method' => $payment_method,
            'qty' => $qty,
        ]);
    }

    public function CheckoutStore(Request $request)
    {
        $this->validate($request, [
            'partnerCourier' => 'required',
            'sumber_dana_id' => 'required',
            'denda' => 'nullable',
            'estimasi_pembayaran' => 'nullable',
            'payment_method' => 'required',
            'label' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);
    
        $partnerCourier = $request->input('partnerCourier');
        $sumber_dana_id = $request->input('sumber_dana_id');
        $denda = $request->input('denda');
        $estimasi_pembayaran = $request->input('estimasi_pembayaran');
        $payment_method = $request->input('payment_method');
        $label = $request->input('label');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');
        $province_id = $request->input('province_id'); 
        $districts_id = $request->input('districts_id'); 
        $subdistrict_id = $request->input('subdistrict_id'); 
        $village_id = $request->input('village_id'); 
    
        $village = Village::find($village_id);
        $village_name = $village->name;


        $store_id = $request->user()->store->id; 
        $user_id = $request->user()->id;
        $statusBaru = MasterStatus::where('id', IprOrder::PESANAN_BARU)->first();
        if ($statusBaru) {
            $status_id = $statusBaru->id;

        $order = new IprOrder();
        $order->sumber_dana_id = $sumber_dana_id;
        $order->shipping_method = $partnerCourier;
        $order->denda = $denda;
        $order->estimasi_pembayaran = $estimasi_pembayaran;
        $order->payment_method = $payment_method;
        $order->user_id = $user_id; 
        $order->status_id = $status_id; 
        $order->store_id = $store_id; 
        $order->save();
        }

        $user_id = $request->user()->id; 
    
        $userAddress = new UserAddress();
        $userAddress->label = $label;
        $userAddress->phone_number = $phone_number;
        $userAddress->address = $address;
        $userAddress->province_id = $province_id; 
        $userAddress->districts_id = $districts_id; 
        $userAddress->subdistrict_id = $subdistrict_id; 
        $userAddress->village_id = $village_id;
        $userAddress->village_name = $village_name;
        $userAddress->user_id = $user_id; 
        $userAddress->status_id = 2; 


    
        $userAddress->save();
        
        return redirect()->route('dashboard.index');
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
