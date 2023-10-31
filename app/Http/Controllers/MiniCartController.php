<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IprCartItem;
use App\Models\ProductSku;
use App\Models\SumberDana;
use App\Models\CourierPartner;
use App\Models\ProductFile;
use App\Models\IprCart;
use App\Models\BankMp;
use App\Models\Province;
use App\Models\ProductPrice;


class MiniCartController extends Controller
{
    public function show()
    {
        $product = ProductSku::first();
    
        $productPrice = ProductPrice::where('product_sku_id', $product->id)->first();
        $price = $productPrice ? $productPrice->price : null;
    
        $productFile = ProductFile::first();
        $imagePath = $productFile ? $productFile->path : 'default/path';
    
        $storeName = $this->getStoreName($product);
    
        $cart = IprCart::first();
        $cart_id = $cart ? $cart->id : null;
    
        $cartItem = IprCartItem::where('product_sku_id', $product->id)
            ->where('cart_id', $cart_id)
            ->first();
        $qty = $cartItem ? $cartItem->qty : null;
    
        $sumberDanas = SumberDana::all();
        $partnerCouriers = CourierPartner::all();
        $provinces = Province::all();
        $districts = [];
        $subdistricts = [];
        $villages = [];
        $metodePembayaran = BankMp::getBankAvailableBuyer();
    
        $cartItems = IprCartItem::where('cart_id', $cart_id)->get();
        $cartSubtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->qty;
        });
    
        return $this->loadTheme('partials.mini_cart', compact(
            'price',
            'imagePath',
            'storeName',
            'sumberDanas',
            'provinces',
            'districts',
            'subdistricts',
            'villages',
            'partnerCouriers',
            'metodePembayaran',
            'qty',
            'cartSubtotal'
        ));
    }    
}

