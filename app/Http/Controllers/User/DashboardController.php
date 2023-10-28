<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ProductImage;
use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductPrice;
use App\Models\ProductFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; 


class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $user_id, 'status' => 1]);
        $items = CartItem::where('cart_id', $cart->id)->get();
    
        $cartItems = [];
    
        foreach ($items as $item) {
            $product = Product::findOrFail($item->product_id);
            $image = ProductImage::where('product_id', $product->id)->first();
            $total = $product->price * $item->quantity;
    
            $cartItems[] = [
                'product_name' => $product->name,
                'price' => $product->price,
                'image' => $image ? $image->path : null,
            ];
        }
    
        $categories = Category::where('parent_id', 0)->get();
        $productSkus = ProductSku::all();
        $productPrices = ProductPrice::all();
        $productImages = ProductFile::all();
    
        $responseData = [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'productSkus' => $productSkus,
            'productPrices' => $productPrices,
            'productImages' => $productImages,
        ];
    
        return view('dashboard.index', $responseData);
    }
    
}