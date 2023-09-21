<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->data['currentUserMenu'] = 'categories';
        $this->data['currentUserSubMenu'] = 'category';
        
    }

    public function index()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->where('status', 1)->first();
    
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->status = 1;
            $cart->save();
        }
    
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
                'image' => $image->path,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'total' => $total,
            ];
    
            $cartSubtotal += $total;
        }
    
        $cartTotalQuantity = 0;
        foreach ($items as $item) {
            $cartTotalQuantity += $item->quantity;
        }
        $cartTotal = $cartSubtotal;
    
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::all();
    
        $productImages = ProductImage::whereIn('product_id', $products->pluck('id'))->get();
    
        $cartController = new CartController();
        $cartControllerResponseIndex = $cartController->index();
    
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
        ];
    
        return view('dashboard.index', $responseData);
    }
    
}