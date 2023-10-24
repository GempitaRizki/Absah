<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\AssignProductCat;
use App\Models\IprProduct;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\MasterStatus;
use App\Models\ProductCategory;
use App\Models\Option;
use App\Models\ProductStore;
use App\Models\Etalase;
use App\Models\ProductPrice;
use App\Models\Zona;
use App\Models\ProductFile;
use Auth;
use Str;

use Illuminate\Support\Facades\Session;

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
        $request->validate([
            'product_type' => 'required',
            'price_type' => 'required',
            'condition_id' => 'required',
        ]);

        $products = new IprProduct();
        $products->product_type = $request->input('product_type');
        $products->price_type = $request->input('price_type');
        $products->condition_id = $request->input('condition_id');
        $products->save();

        $iprProductId = $products->id;

        session()->put('ipr_product_id', $iprProductId);

        return redirect()->route('getInfoUmum', ['ipr_product_id' => $iprProductId]);
    }



    public function showindexumum(Request $request)
    {
        $this->data['currentSellerMenu'] = 'productseller';
        $this->data['productTypes'] = [
            1 => 'Barang',
            2 => 'Jasa',
        ];

        $selectedProductType = $request->input('tipe_kategori_id');
        $subCategories = [];
        if ($selectedProductType === 1 || $selectedProductType === 2) {
            $subCategories = ProductCategory::where('parent_id', $selectedProductType)
                ->pluck('name', 'id');
        }

        $this->data['subCategories'] = $subCategories;
        $uniqueSKU = 'SKUDEFAULT' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $this->data['generatedSKU'] = $uniqueSKU;

        $this->data['productSku'] = ProductSku::with('hasPpnStatus', 'hasShippingStatus')->first();
        $this->data['madeInTypes'] = MasterStatus::getMadeInType();
        $this->data['statusOngkir'] = [
            '1' => 'Bebas Ongkir',
            '3' => 'Ongkir Dari Klaten',
            '2' => 'Ongkir Dari Depo',
            '5' => 'Produk Buku Nonteks E-Katalog',
        ];
        $this->data['listStoreByLogin'] = ProductStore::listStoreByLogin();
        $this->data['listEtalase'] = Etalase::getListEtalase();
        $this->data['hasShipping'] = MasterStatus::getListShipping();

        return view('seller.daftarproduk.info_umum', $this->data);
    }


    public function storeProductData(Request $request)
    {
        $request->validate([
            'tipe_kategori_id' => 'required',
            'category_id' => 'required',
        ]);

        $createdBy = Auth::id();

        $iprProductId = session('ipr_product_id');

        $tipe_kategori_id = $request->input('tipe_kategori_id');
        $category_id = $request->input('category_id');
        $sub_category_satu = $request->input('sub_category_satu');
        $sub_category_dua = $request->input('sub_category_dua');
        $sub_category_tiga = $request->input('sub_category_tiga');
        $sub_category_empat = $request->input('sub_category_empat');
        $sub_category_lima = $request->input('sub_category_lima');
        $sub_category_enam = $request->input('sub_category_enam');

        $name = $request->input('name');
        $sku = $request->input('sku');
        $has_ppn = $request->input('has_ppn');
        $has_shipping = $request->input('has_shipping');
        $produsen_type = $request->input('produsen_type');
        $length = $request->input('length');
        $width = $request->input('width');
        $height = $request->input('height');
        $has_ppn = $request->input('has_ppn');

        $parentParts = [
            $tipe_kategori_id,
            $category_id,
            $sub_category_satu,
            $sub_category_dua,
            $sub_category_tiga,
            $sub_category_empat,
            $sub_category_lima,
            $sub_category_enam,
        ];
        
        $categories = [];
        for ($i = 0; $i < count($parentParts); $i++) {
            $tempCategory = [
                'Category_id' => $parentParts[$i],
                'parent' => $i === 0 ? 0 : $parentParts[$i - 1],
            ];
            $categories[] = $tempCategory;
        }
        $productSkuId = session('ipr_product_id');
        
        foreach ($categories as $category) {
            $productInfoUmum = new AssignProductCat();
            $productInfoUmum->category_id = $category['Category_id'];
            $productInfoUmum->parent = $category['parent'];
            $productInfoUmum->product_sku_id = $productSkuId;
            $productInfoUmum->save();
        }
        
            $iprProduct = IprProduct::find($iprProductId);

            $productSku = new ProductSku();
            $productSku->name = $name;
            $productSku->sku = $sku;
            $productSku->has_ppn = $has_ppn;
            $productSku->has_shipping = $has_shipping;
            $productSku->produsen_type = $produsen_type;
            $productSku->length = $length;
            $productSku->width = $width;
            $productSku->height = $height;
            $productSku->created_by = $createdBy;
            $productSku->type_ppn = 1;
            $productSku->preorder = ProductSku::DEFAULT_PREORDER;

            if ($iprProduct) {
                $productSku->product_id = $iprProduct->id;
                $productSku->product_id_reference = $iprProduct->id;
            }

            $slug = Str::slug($name, '-') . '-' . $iprProduct->id;
            $productSku->slug = $slug;

            $defaultStatus = MasterStatus::where('id', ProductSku::PENDING_REVIEW_STATUS_ID)->first();
            $productSku->status()->associate($defaultStatus);

            $productSku->save();

            return redirect()->route('IndexPrice');
        }
    
    public function indexPrice(Request $request)
    {
        $zonas = Zona::all();
        $productPrices = ProductPrice::all();
        if ($request->isMethod('post')) {
            $product_sku_id = 1;
            foreach ($zonas as $zona) {
                $zonaId = $zona->id;
                $inputName = 'price_' . $zona->name;
                $price = $request->input($inputName);

                ProductPrice::updateOrCreate(
                    ['zona' => $zona->name, 'product_sku_id' => $product_sku_id],
                    ['price' => $price]
                );
            }
        }
        return view('seller.items.priceIndex', compact('zonas', 'productPrices'));
    }


    public function storePrice(Request $request)
    {
        $productData = $request->all();
        session(['price_session' => $productData]);

        // dd(session('price_session'));

        return redirect()->route('upload.product.index');
    }

    public function indexFileUpload()
    {
        return view('seller.daftarproduk.upload');
    }

    public function uploadFile()
    {
        return view('seller.items.uploadFile');
    }

    public function storeImage(Request $request)
    {
        $productFile = new ProductFile();
        $productFile->path = $request->file('imageProduct');
        $productFile->path_bashurl = asset('storage/' . $productFile->path);
        $productFile->product_sku_id = 1;
        $productFile->save();

        Session::push('product_images', $productFile);

        return redirect()->route('upload.index');
    }
}
