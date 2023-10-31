<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\ProductFile;
use App\Models\ProductStock;
use App\Models\AssignProductCat;
use App\Models\IprCart;
use App\Models\IprProduct;
use App\Models\Store;
use App\Models\BankMp;
use App\Models\IprCartItem;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{

    public function index($slug, $id)
    {
        $product = ProductSku::where('slug', $slug)
            ->where('id', $id)
            ->with(['productPrice', 'iprProduct'])
            ->firstOrFail();

        $qty = IprCartItem::where('product_sku_id', $product->id)
            ->value('qty') ?? 1;

        $productPrice = ProductPrice::where('product_sku_id', $product->id)->first();
        $price = $productPrice ? $productPrice->price : null;


        $productFile = ProductFile::where('product_sku_id', $product->id)->first();
        $imagePath = $productFile ? $productFile->path : 'default/path';

        $storeName = $this->getStoreName($product);
        $categories = $this->getProductCategories($product);

        return view('user.productDetail', compact('product', 'storeName', 'categories', 'qty', 'price', 'imagePath'));
    }


    public function saveQtyToCartWithoutParams(Request $request)
    {
        $productSku = ProductSKU::first();
        $store = Store::first();
        $user = auth()->user();

        if ($productSku && $store && $user) {
            $productSkuId = $productSku->id;
            $qty = $request->input('qty');
            $iprCart = $this->getOrCreateUserIprCart($user, $store);
            $existingItem = IprCartItem::where('cart_id', $iprCart->id)
                ->where('product_sku_id', $productSkuId)
                ->first();

            if ($existingItem) {
                $existingItem->qty += $qty;
                $existingItem->save();
            } else {
                $newCartItem = IprCartItem::create([
                    'cart_id' => $iprCart->id,
                    'product_sku_id' => $productSkuId,
                    'qty' => $qty,
                ]);
                if ($newCartItem) {
                    $store->update(['store_id' => $newCartItem->id]);
                }
            }
        }

        return redirect()->route('cart.Index.Banget');
    }

    protected function getOrCreateUserIprCart($user, $store)
    {
        return DB::transaction(function () use ($user, $store) {
            $iprCart = IprCart::where('user_id', $user->id)
                ->where('store_id', $store->id)
                ->first();

            if (!$iprCart) {
                $iprCart = IprCart::create([
                    'status_id' => 0,
                    'user_id' => $user->id,
                    'store_id' => $store->id,
                ]);
            }

            return $iprCart;
        });
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
