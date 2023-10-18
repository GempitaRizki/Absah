<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Support\Facades\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\Store;
use App\Models\MasterStatus;
use App\Models\ProductCategory;
use App\Models\Option;
use App\Models\AssignProductCat;

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

        return redirect()->route('info-umum');
    }

    public function infoumumindex(Request $request)
    {
        $productSkuId = $request->input('product_sku_id');
        $categoryDetail = AssignProductCat::where('product_sku_id', $productSkuId)->first();

        $tipeKategoriData = [
            '1' => 'Barang',
            '2' => 'Jasa',
        ];

        $kategoriData = [];
        $tipeKategoriId = null;
        $dataArrToString = null;
        $categoryMessage = null;

        if ($categoryDetail) {
            $dataKategoriArr = ProductCategory::getListHirarchySelected($categoryDetail->category_id);
            $dataArrToString = implode(' > ', $dataKategoriArr);
            $tipeKategoriId = 1;
            $kategoriData = ProductCategory::where('hierarchy', 'LIKE', $dataArrToString . '%')
                ->pluck('name', 'id');
        } else {
            $categoryMessage = "Kategori belum dibuat";
        }

        return view('seller.daftarproduk.info_umum', [
            'tipeKategoriData' => $tipeKategoriData,
            'dataArrToString' => $dataArrToString,
            'tipeKategoriId' => $tipeKategoriId,
            'kategoriData' => $kategoriData,
            'categoryMessage' => $categoryMessage,
        ]);
    }
}
