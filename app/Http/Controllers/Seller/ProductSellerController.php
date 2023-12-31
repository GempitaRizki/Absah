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
use App\Models\ProductStock;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ProductSellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $totalProducts = ProductSku::where('created_by', $user->id)->count();
        $totalActiveProducts = ProductSku::where('status_id', 44)
            ->where('created_by', $user->id)
            ->count();
        $totalPendingProducs = ProductSku::where('status_id', 47)
            ->where('created_by', $user->id)
            ->count();
        $totalDraftProducts = ProductSku::where('status_id', 46)
            ->where('created_by', $user->id)
            ->count();

        $productSkus = ProductSku::where('created_by', $user->id)->get();

        return view('seller.items.product_index', compact('totalProducts', 'totalActiveProducts', 'totalPendingProducs', 'totalDraftProducts', 'productSkus'));
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
        $this->data['listEtalase'] = Etalase::getListEtalase();
        $this->data['hasShipping'] = MasterStatus::getListShipping();
        $this->data['listStoreByLogin'] = ProductStore::listStoreByLogin();
        
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
        $has_shipping = $request->input('has_shipping');
        $produsen_type = $request->input('produsen_type');
        $length = $request->input('length');
        $width = $request->input('width');
        $height = $request->input('height');
        $has_ppn = $request->input('has_ppn');
        $weight = $request->input('weight');
        $length_packing = $request->input('length_packing');
        $width_packing = $request->input('width_packing');
        $height_packing = $request->input('height_packing');
        $weight_packing = $request->input('weight_packing');
        $made_in = $request->input('made_in');
        $garansi = $request->input('garansi');
        $brand = $request->input('brand');
        $kode_kbki = $request->input('kode_kbki');
        $cetakan = $request->input('cetakan');
        $nomorsk = $request->input('nomorsk');
        $tanggal_sk = $request->input('tanggal_sk');
        $status_ongkir = $request->input('status_ongkir');
        $tkdn = $request->input('tkdn');
        $bmp = $request->input('bmp');
        $descriptions = $request->input('descriptions');
        $qty_min = $request->input('qty_min');
        $qty_max = $request->input('qty_max');


        $store_id = Store::getStoreIdByUserLogin();

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
        $productSku->weight = $weight;
        $productSku->length_packing = $length_packing;
        $productSku->width_packing = $width_packing;
        $productSku->height_packing = $height_packing;
        $productSku->weight_packing = $weight_packing;
        $productSku->made_in = $made_in;
        $productSku->garansi = $garansi;
        $productSku->brand = $brand;
        $productSku->kode_kbki = $kode_kbki;
        $productSku->cetakan = $cetakan;
        $productSku->nomorsk = $nomorsk;
        $productSku->tanggal_sk = $tanggal_sk;
        $productSku->status_ongkir = $status_ongkir;
        $productSku->tkdn = $tkdn;
        $productSku->bmp = $bmp;
        $productSku->descriptions = $descriptions;
        $productSku->qty_min = $qty_min;
        $productSku->qty_max = $qty_max;
        $productSku->store_id = $store_id;

        $productSku->created_by = $createdBy;
        $productSku->type_ppn = 1;
        $productSku->preorder = ProductSku::DEFAULT_PREORDER;
        if ($iprProduct) {
            $productSku->product_id = $iprProduct->id;
            $productSku->product_id_reference = $iprProduct->id;
        }

        $slug = Str::slug($name, '-') . '-' . $iprProduct->id;
        $productSku->slug = $slug;
        $draftStatus = MasterStatus::where('id', ProductSku::PENDING_REVIEW_STATUS_ID)->first();
        $productSku->status()->associate($draftStatus);
        session(['default_status' => $draftStatus]);
        $productSku->save();

        session(['product_sku_name' => $productSku->name]);
        session(['product_descriptions' => $productSku->descriptions]);

        //ganti staus nda
        if (request()->is('product/publish')) {
            $pendingReviewStatus = MasterStatus::where('id', ProductSku::PENDING_REVIEW_STATUS_ID)->first();
            $productSku->status()->associate($pendingReviewStatus);
            $productSku->save();
        }

        $stock = $request->input('stok');
        $limitStock = $request->input('limit_stock');

        $productStock = new ProductStock();
        $productStock->product_sku_id = $productSku->id;
        $productStock->stock = $stock;
        $productStock->limit_stock = $limitStock;
        $productStock->save();

        $productStore = new ProductStore();
        $productStore->store_id = $request->input('store_id');
        $productStore->product_sku_id = $productSku->id;
        $productStore->save();

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
        $parent = 0;

        foreach ($parentParts as $part) {
            if (!empty($part)) {
                $categories[] = [
                    'Category_id' => $part,
                    'parent' => $parent,
                ];

                $parent = $part;
            }
        }

        //pastikan tetap menggunakan product_sku karena mbuh 
        //kenopo nek nganggo product_sku_id ora iso
        foreach ($categories as $category) {
            $productInfoUmum = new AssignProductCat();
            $productInfoUmum->category_id = $category['Category_id'];
            $productInfoUmum->parent = $category['parent'];
            $productInfoUmum->product_sku = $productSku->id;
            $productInfoUmum->save();
        }

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
        $request->validate([
            'price' => 'required|numeric',
            'price_after_discount' => 'required|numeric',
        ]);

        $price = $request->input('price');
        $priceAfterDiscount = $request->input('price_after_discount');

        if ($priceAfterDiscount >= $price) {
            return redirect()->back()->with('error', 'Gagal simpan. Harga setelah diskon tidak boleh lebih besar dari harga.')->withInput();
        }

        $productSku = ProductSku::first();

        if ($productSku) {
            $newPrice = new ProductPrice;
            $newPrice->fill([
                'price' => $price,
                'zona' => 0,
                'qty' => null,
                'product_sku_id' => $productSku->id,
                'price_after_discount' => $priceAfterDiscount,
                'price_after_discount_type' => 1,
                'data_array' => null,
                'qty_min' => $productSku->qty_min,
                'qty_max' => null,
            ]);

            $newPrice->save();

            session(['product_price' => $price]);

            return redirect()->route('upload.index')->with('success', 'Data Price berhasil disimpan.');
        }
    }

    public function indexFileUpload()
    {
        return view('seller.items.uploadFile');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $productSku = ProductSku::first();

        if (!$productSku) {
            return back()->with('error', 'No product SKU found.');
        }
        $existingFile = ProductFile::where('product_sku_id', $productSku->id)->first();
        if ($existingFile) {
            $oldFilePath = public_path('images/' . $existingFile->path);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $pathName = time() . '.' . $request->path->extension();
            $request->path->move(public_path('images'), $pathName);

            $existingFile->update([
                'path' => $pathName,
            ]);
        } else {
            $pathName = time() . '.' . $request->path->extension();
            $request->path->move(public_path('images'), $pathName);
            ProductFile::create([
                'path' => $pathName,
                'product_sku_id' => $productSku->id,
            ]);
        }
        session(['uploaded_image' => $pathName]);
        return back()
            ->with('success', 'You have successfully uploaded an image.')
            ->with('path', $pathName);
    }

    public function SummaryProduct()
    {
        return view('seller.items.summaryProduct');
    }
}