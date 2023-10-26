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
        $cartSubtotal = 0;
    
        foreach ($items as $item) {
            $product = Product::findOrFail($item->product_id);
            $image = ProductImage::where('product_id', $product->id)->first();
            $total = $product->price * $item->quantity;
        
            $cartItems[] = [
                'item_id' => $item->id,
                'slug' => $product->slug,
                'image' => $image ? $image->path : null,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'total' => $total,
            ];
        
            $cartSubtotal += $total;
        }
    
        $cartTotalQuantity = $items->sum('quantity');
        $cartTotal = $cartSubtotal;
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::all();
        $productImages = ProductImage::whereIn('product_id', $products->pluck('id'))->get();
        $cartController = new CartController();
        $cartControllerResponseIndex = $cartController->index();
        $productSkus = ProductSku::all();
        $productPrices = ProductPrice::all(); 

        $responseData = [
            'cartControllerResponseIndex' => $cartControllerResponseIndex,
            'categories' => $categories,
            'products' => $products,
            'productImages' => $productImages,
            'cartItems' => $cartItems,
            'cartSubtotal' => $cartSubtotal,
            'cartTotal' => $cartTotal,
            'cartTotalQuantity' => $cartTotalQuantity,
            'cart' => $cart,
            'productSkus' => $productSkus, 
            'productPrices' => $productPrices, 


        ];
    
        return view('dashboard.index', $responseData);
    }  
}