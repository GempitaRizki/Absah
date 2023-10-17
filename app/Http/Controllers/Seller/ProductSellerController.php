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

    public function indexinfo()
    {
        $productTypeList = MasterStatus::getListMasterProductType();
        $conditionList = MasterStatus::getListMasterCondition();
        $priceTypeList = MasterStatus::getListPriceType();
        $shippingTypeList = MasterStatus::getListShippingType();
        $attributeList = Option::getListOption();

        return view('seller.daftarproduk.info_awal', compact(
            'productTypeList',
            'conditionList',
            'priceTypeList',
            'shippingTypeList',
            'attributeList'
        ));
    }


    public function infoawalStore(Request $request)
    {
        $productTypeId = $request->input('product_type_id');
        $priceTypeId = $request->input('price_type');
        $conditionId = $request->input('condition_id');
        $attributeId = $request->input('attribute');

        if (session()->has('temporaryData')) {
            $temporaryData = session('temporaryData');
        } else {
            $temporaryData = [];
        }

        $temporaryData = [
            'productTypeId' => $productTypeId,
            'priceTypeId' => $priceTypeId,
            'conditionId' => $conditionId,
            'attributeId' => $attributeId,
        ];

        session(['temporaryData' => $temporaryData]);

        // dd(session('temporaryData'));

        return redirect()->route('info-umum');
    }


    public function infoumumindex()
    {
        $categoryId = 1;
        $selectedCategory = ProductCategory::find($categoryId);
        $pathKategori = $this->getPathKategori($selectedCategory);
        $tipeKategoriData = [
            '1' => 'Barang',
            '2' => 'Jasa',
        ];

        $listHierarchy = ProductCategory::getListHirarchy();

        return view('seller.daftarproduk.info_umum', [
            'listHierarchy' => $listHierarchy,
            'pathKategori' => $pathKategori,
            'tipeKategoriData' => $tipeKategoriData,
        ]);
    }


    private function getPathKategori($category)
    {
        $path = [];

        while ($category) {
            $path[] = $category->name;
            $category = ProductCategory::find($category->parent_id);
        }

        return implode(' > ', array_reverse($path));
    }


    // public function fetchCategories($categoryTypeId)
    // {
    //     $categories = ProductCategory::where('parent_id', $categoryTypeId)->pluck('name', 'id');
    //     return response()->json($categories);
    // }
}
