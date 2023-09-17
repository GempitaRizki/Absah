<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductImage;

class CartController extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$user_id = auth()->user()->id;
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

		$cartItems = [];

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

		$cartTotal = $cartSubtotal;

		return $this->loadTheme('carts.index', compact('cartItems', 'cartSubtotal', 'cartTotal', 'cart'));
	}

	public function store(Request $request, $id)
	{
		$product = Product::findOrFail($id);

		$user_id = auth()->user()->id;

		$cart = Cart::where('user_id', $user_id)->where('status', 1)->first();

		if (!$cart) {
			$cart = new Cart();
			$cart->user_id = $user_id;
			$cart->status = 1;
			$cart->save();
		}

		$cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $id)->first();

		if ($cartItem) {
			$cartItem->quantity++;
			$cartItem->save();
		} else {
			$cartItem = new CartItem();
			$cartItem->cart_id = $cart->id;
			$cartItem->product_id = $id;
			$cartItem->quantity = 1;
			$cartItem->price = $product->price;
			$cartItem->save();
		}

		return redirect()->back()->with('success', 'Product added to cart successfully!');
	}

    public function update(Request $request)
    {
        if ($request->ajax()) {
            foreach ($request->input('items') as $itemId => $quantity) {
                $cartItem = CartItem::find($itemId);
                if ($cartItem) {
                    $cartItem->quantity = $quantity;
                    $cartItem->total = $cartItem->product->price * $quantity;
                    $cartItem->save();
                }
            }

            // Jika diperlukan, Anda dapat mengirim respons JSON kembali ke klien
            return response()->json(['message' => 'Cart has been updated']);
        }

        // Jika ini bukan permintaan Ajax, Anda dapat mengembalikan respons lain atau melakukan tindakan yang sesuai
        return response()->json(['message' => 'Invalid request']);
    }








	public function remove($itemId)
    {
        CartItem::destroy($itemId);

        return redirect()->route('cart.show')->with('success', 'Item has been removed from the cart');
    }
}
