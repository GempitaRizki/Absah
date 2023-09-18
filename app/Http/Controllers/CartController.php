<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductImage;
use App\Models\User;

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
	
		$cartTotalQuantity = 0;
		foreach ($items as $item) {
			$cartTotalQuantity += $item->quantity;
		}
	
		return $this->loadTheme('carts.index', compact('cartItems', 'cartSubtotal', 'cartTotal', 'cart', 'cartTotalQuantity'));
	}
	

	public function store(Request $request, $product)
	{
		$product = Product::findOrFail($product);

		$request->validate([
			'qty' => 'required|integer|min:1',
		]);

		$user_id = auth()->user()->id;

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


		return redirect()->route('cart.show')
			->with('success', 'Product added to cart successfully!');
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

		return redirect()->route('cart.show')->with('success', 'Item has been removed from the cart');
	}

	public function show()
	{
		$cartItems = Cart::getContent();
		$cartData = [];

		foreach ($cartItems as $item) {
			$product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
			$image = !empty($product->productImages->first()) ? asset('storage/' . $product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg');
			$total = $item->price * $item->quantity;

			$cartData[] = [
				'image' => $image,
				'product_name' => $item->name,
				'price' => $item->price,
				'quantity' => $item->quantity,
				'total' => $total,
			];
		}

        $cartTotalQuantity = $this->getCartTotalQuantity();
		$cartSubtotal = Cart::getSubTotal();

        return $this->loadTheme('carts.index', compact('cartItems', 'cartSubtotal', 'cartTotal', 'cart', 'cartTotalQuantity'));
	}

	private function getCartTotalQuantity()
    {
        $cart = Cart::getContent();
        $totalQuantity = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $totalQuantity += $item->quantity;
            }
        }

        return $totalQuantity;
    }
}
