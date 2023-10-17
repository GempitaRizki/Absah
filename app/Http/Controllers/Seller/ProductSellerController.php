<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\Store;
use App\Models\MasterStatus;
use App\Models\ProductCategory;
use App\Models\Option;

class ProductSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'productseller';
    }

    public function index()
    {
        $storeId = Store::getStoreIdByUserLogin();

        $totalAll = ProductSku::getTotalProduct('all');
        $totalAktif = ProductSku::getTotalProduct('aktif');
        $totalNonAktif = ProductSku::getTotalProduct('pending');
        $totalDraft = ProductSku::getTotalProduct('draft');

        // \Log::info('Total All: ' . $totalAll);
        // \Log::info('Total Aktif: ' . $totalAktif);
        // \Log::info('Total Non-Aktif: ' . $totalNonAktif);
        // \Log::info('Total Draft: ' . $totalDraft);

        $this->data['totalAll'] = $totalAll;
        $this->data['totalAktif'] = $totalAktif;
        $this->data['totalNonAktif'] = $totalNonAktif;
        $this->data['totalDraft'] = $totalDraft;

        return view('seller.items.product_index', $this->data);
    }


    public function infoawalindex(Request $request)
    {
        $productTypeList = MasterStatus::getListMasterProductType();
        $conditionList = MasterStatus::getListMasterCondition();
        $priceTypeList = MasterStatus::getListPriceType();
        $shippingTypeList = MasterStatus::getListShippingType();
        $attributeList = Option::getListOption();
    
        if (!session()->has('productTypeList')) {
            session([
                'productTypeList' => $productTypeList,
                'conditionList' => $conditionList,
                'priceTypeList' => $priceTypeList,
                'shippingTypeList' => $shippingTypeList,
                'attributeList' => $attributeList,
            ]);
        }
    
        dd(session()->all());
    
        return view('seller.daftarproduk.info_awal', compact(
            'productTypeList',
            'conditionList',
            'priceTypeList',
            'shippingTypeList',
            'attributeList'
        ));
    }
}
