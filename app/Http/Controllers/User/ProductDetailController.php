<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\ProductFile;
use App\Models\ProductStock;
use App\Models\AssignProductCat;
use App\Models\IprProduct;
use App\Models\Store;
use App\Models\ProductStore;

use Illuminate\Support\Facades\DB;



class ProductDetailController extends Controller
{

    public function index($slug)
    {
        $product = ProductSku::where('slug', $slug)->firstOrFail();
        $productPrice = ProductPrice::where('product_sku_id', $product->id)->first();
        $productName = $product->name;
        $descriptions = $product->descriptions;
        $productSku = $product->sku;
        $tkdn = $product->tkdn;
        $bmp = $product->bmp;
        $garansi = $product->garansi;
        $store = $product->store;

        $price = $productPrice ? $productPrice->price : null;

        $productFile = ProductFile::where('product_sku_id', $product->id)->first();
        $imagePath = $productFile ? $productFile->path : 'default/path';

        $productStock = ProductStock::where('product_sku_id', $product->id)->first();
        $stock = $productStock ? $productStock->stock : 0;

        $iprProduct = IprProduct::where('id', $product->id)->first();
        $conditionId = $iprProduct ? $iprProduct->condition_id : null;


        $storeName = $this->getStoreName($product);
        $categories = $this->getProductCategories($product);

        return view('user.productDetail', [
            'productName' => $productName,
            'price' => $price,
            'descriptions' => $descriptions,
            'product' => $product,
            'imagePath' => $imagePath,
            'stock' => $stock,
            'sku' => $productSku,
            'tkdn' => $tkdn,
            'bmp' => $bmp,
            'conditionId' => $conditionId,
            'garansi' => $garansi,
            'store' => $store,
            'categories' => $categories,
            'storeName' => $storeName,
        ]);
    }

    private function getProductCategories($product)
    {
        $categories = [];

        $assignProductCat = AssignProductCat::with('Category')->where('product_sku_id', $product->sku)->first();

        while ($assignProductCat) {
            $categories[] = $assignProductCat->Category->name;
            $parent = $assignProductCat->parent;

            if ($parent) {
                $assignProductCat = AssignProductCat::with('Category')->where('category_id', $parent)->first();
            } else {
                $assignProductCat = null;
            }
        }

        return array_reverse($categories);
    }


    //Store IPR 
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

}
