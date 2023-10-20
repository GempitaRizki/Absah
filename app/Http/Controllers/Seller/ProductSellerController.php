<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\AssignProductCat;
use App\Models\ProductEtalase;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\Store;
use App\Models\MasterStatus;
use App\Models\ProductCategory;
use App\Models\Option;
use App\Models\ProductTag;
use App\Models\ProductStore;
use Illuminate\Support\Facades\DB;

class ProductSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'productseller';
    }

    public function index()
    {
        return view('seller.items.product_index', $this->data);
    }

    public function indexinfo()
    {
        $this->data['currentSellerMenu'] = 'productseller';
        $this->data['productTypes'] = MasterStatus::getListMasterProductType();
        $this->data['priceTypes'] = MasterStatus::getListPriceType();
        $this->data['productConditionType'] = MasterStatus::getListMasterCondition();
        $this->data['listOptions'] = Option::getListOption();

        return view('seller.daftarproduk.info_awal', $this->data);
    }

    public function actionListPriceType(Request $request)
    {
        $out = [];
        if ($request->has('depdrop_parents')) {
            $parents = $request->input('depdrop_parents');
            if ($parents != null && isset($parents[0])) {
                $cat_id = $parents[0];

                if ($cat_id == '32') {
                    $out = [
                        ['id' => '37', 'name' => 'Zonasi'],
                        ['id' => '38', 'name' => 'General / Nasional'],
                        ['id' => '39', 'name' => 'Grosir'],
                    ];
                } elseif ($cat_id == '31') {
                    $out = [
                        ['id' => '38', 'name' => 'General / Nasional'],
                        ['id' => '39', 'name' => 'Grosir'],
                    ];
                } elseif ($cat_id == '30') {
                    $out = [
                        ['id' => '37', 'name' => 'Zonasi'],
                        ['id' => '38', 'name' => 'General / Nasional / Berdasarkan Item'],
                    ];
                }

                return response()->json(['output' => $out, 'selected' => '']);
            }
        }

        return response()->json(['output' => '', 'selected' => '']);
    }


    public function indexinfoStore(Request $request)
    {
        $productTypesId = $request->input('product_type_id');
        $priceTypesId = $request->input('price_types_id');
        $productConditionTypeId = $request->input('condition_id');
        $listOptionsId = $request->input('attributes_id');
        
        session(['indexInfoSession' => [
            'product_type_id' => $productTypesId,
            'price_types_id' => $priceTypesId,
            'condition_id' => $productConditionTypeId,
            'attributes_id' => $listOptionsId,
        ]]);

        // dd(session('indexInfoSession'));

        return redirect()->route('getInfoUmum');
    }

    public function showindexumum()
    {
        $productCategory = [
            1 => "Barang",
            2 => "Jasa"
        ];
    
        $parent_ids = [1, 2];
        $categories = ProductCategory::whereIn('parent_id', $parent_ids)->get();
        $productCategories = $categories->where('parent_id', 0)->map(function ($category) {
            return [
                'value' => $category->id,
                'text' => $category->name,
            ];
        })->toArray();
    
        $subProductCategories = $categories->whereIn('parent_id', [1, 2])->map(function ($subCategory) {
            return [
                'value' => $subCategory->id,
                'text' => $subCategory->name,
            ];
        })->toArray();
    
        return view('seller.daftarproduk.info_umum', compact('productCategory', 'productCategories', 'subProductCategories'));
    }
    
}
