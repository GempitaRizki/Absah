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

    public function updateParentIds()
    {
        $productCategoryBarang = ProductCategory::where('name', 'Barang')->first();
        $productCategoryJasa = ProductCategory::where('name', 'Jasa')->first();

        if ($productCategoryBarang) {
            $productCategoryBarang->parent_id = 1;
            $productCategoryBarang->save();
        }

        if ($productCategoryJasa) {
            $productCategoryJasa->parent_id = 2;
            $productCategoryJasa->save();
        }
    }

    public function showindexumum(Request $request)
    {
        $this->data['currentSellerMenu'] = 'productseller';
        $this->data['productTypes'] = [
            1 => 'Barang',
            2 => 'Jasa',
        ];
        $this->data['priceTypes'] = MasterStatus::getListPriceType();
        $this->data['productConditionType'] = MasterStatus::getListMasterCondition();
        $this->data['listOptions'] = Option::getListOption();

        $selectedProductType = $request->input('tipe_kategori_id');

        if ($selectedProductType === 1 || $selectedProductType === 2) {
            $subCategories = ProductCategory::where('parent_id', $selectedProductType)->pluck('name', 'id');
        } else {
            $subCategories = [];
        }

        $this->data['subCategories'] = $subCategories;

        return view('seller.daftarproduk.info_umum', $this->data);
    }

    public function getSubCategories(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategories = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');
        return response()->json(['subCategories' => $subCategories]);
    }

    public function getSubCategorySatu(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subCategorySatu = ProductCategory::where('parent_id', $categoryId)->pluck('name', 'id');

        return response()->json(['subCategorySatu' => $subCategorySatu]);
    }

    public function getSubCategoryDua(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryDua = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryDua' => $subCategoryDua]);
    }

    public function getSubCategoryTiga(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryTiga = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryTiga' => $subCategoryTiga]);
    }
    public function getSubCategoryEmpat(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryEmpat = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryEmpat' => $subCategoryEmpat]);
    }

    public function getSubCategoryLima(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryLima = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryLima' => $subCategoryLima]);
    }

    public function getSubCategoryEnam(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryEnam = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryEnam' => $subCategoryEnam]);
    }
}
