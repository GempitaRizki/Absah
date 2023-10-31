<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\IprCart;
use App\Models\IprCartItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $user_id = auth()->id();
        $cart = Cart::firstOrNew(['user_id' => $user_id, 'status' => 1]);

        if (!$cart->exists) {
            $cart->save();
        }

        $items = CartItem::where('cart_id', $cart->id)->get();
        $items->load(['product.images']);

        $cartItems = [];
        $cartSubtotal = 0;

        foreach ($items as $item) {
            $product = $item->product;
            $image = $product->images->first();
            $total = $product->price * $item->quantity;

            $cartItems[] = [
                'item_id' => $item->id,
                'slug' => $product->slug,
                'image' => $image->path ?? null,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'total' => $total,
            ];

            $cartSubtotal += $total;
        }

        $cartTotalQuantity = $items->sum('quantity');
        $cartTotal = $cartSubtotal;

        return $this->loadTheme('carts.index', compact('cartItems', 'cartSubtotal', 'cartTotal', 'cartTotalQuantity'));
    }


    public function store(Request $request, $product)
    {
        $product = Product::findOrFail($product);

        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->where('status', 1)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->status = 1;
            $cart->save();
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('qty');
            $cartItem->save();
        } else {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = $request->input('qty');
            $cartItem->save();
        }

        return redirect()->back()->with('message', 'Has Been Save !');
    }

    public function update(Request $request)
    {
        $items = $request->input('items');

        if (!empty($items)) {
            foreach ($items as $itemId => $data) {
                $quantity = $data['quantity'];
                $cartItem = CartItem::find($itemId);

                if ($cartItem && $quantity > 0) {
                    $cartItem->quantity = $quantity;
                    $cartItem->save();
                }
            }
        }

        return redirect()->route('cart.show')->with('success', 'Cart updated successfully');
    }


    public function destroy($itemId)
    {
        CartItem::destroy($itemId);

        $user_id = auth()->user()->id;
        $cart = Cart::where('user_id', $user_id)->where('status', 1)->first();
        $items = CartItem::where('cart_id', $cart->id)->get();

        $remainingItemsCount = $items->count();

        if ($remainingItemsCount === 0) {
            $cart->status = 0;
            $cart->save();
        }

        return redirect()->route('cart.show')->with('success', 'Item has been removed from the cart');
    }

    public function destroyAll()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->where('status', 1)->first();

        if ($cart) {
            CartItem::where('cart_id', $cart->id)->delete();

            $cart->status = 0;
            $cart->save();
        }

        return redirect()->route('cart.show')->with('success', 'All items have been removed from the cart');
    }

    
}
