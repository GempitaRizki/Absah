<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection\links;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$user = auth()->user(); 
	
		if ($user) {
			$items = CartItem::whereHas('cart', function ($query) use ($user) {
				$query->where('user_id', $user->id);
			})->get();
		} else {
			$items = [
				
			];
		}
	
		$favorites = Favorite::all();
		$products = Product::all();
		$class = Cart::all();
	
		return view('themes.ezone.carts.index', compact('items', 'favorites', 'products', 'class'));
	}

	public function store(Request $request)
	{ 
		{
			$params = $request->except('_token');

			$product = Product::findOrFail($params['product_id']);
			$user_id = auth()->user()->id;

			$slug = $product->slug;
			$store_id = null;

			$cart = Cart::where('user_id', $user_id)->where('status', 1)->first();

			if (!$cart) {
				$cart = Cart::create([
					'user_id' => $user_id,
					'store_id' => $store_id,
					'status' => 1,
				]);
			}

			$existingCartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
			if ($existingCartItem) {
				$existingCartItem->quantity += $params['qty'];
				$existingCartItem->save();
			} else {
				CartItem::create([
					'quantity' => $params['qty'],
					'cart_id' => $cart->id,
					'product_id' => $product->id,
					'price' => $product->price
				]);
			}

			Session::flash('success', 'Product ' . $product->name . ' has been added to cart');
			return redirect()->route('cart.show', ['slug' => $slug]);
		}
	}



	private function _getItemQuantity($itemId)
	{
		$items = \Cart::getContent();
		$itemQuantity = 0;
		if ($items) {
			foreach ($items as $item) {
				if ($item->id == $itemId) {
					$itemQuantity = $item->quantity;
					break;
				}
			}
		}

		return $itemQuantity;
	}

	private function _checkProductInventory($product, $itemQuantity)
	{
		if ($product->productInventory->qty < $itemQuantity) {
			throw new \App\Exceptions\OutOfStockException('The product ' . $product->sku . ' is out of stock');
		}
	}


	private function _getCartItem($cartID)
	{
		$items = CartItem::getContent();

		return $items[$cartID];
	}


	public function update(Request $request)
	{
		$params = $request->except('_token');

		if ($items = $params['items']) {
			foreach ($items as $cartID => $item) {
				$cartItem = $this->_getCartItem($cartID);
				$this->_checkProductInventory($cartItem->associatedModel, $item['quantity']);

				\Cart::update(
					$cartID,
					[
						'quantity' => [
							'relative' => false,
							'value' => $item['quantity'],
						],
					]
				);
			}

			\Session::flash('success', 'The cart has been updated');
			return redirect('carts');
		}
	}


	public function destroy($id)
	{
		$user = auth()->user();
	
		if ($user) {
			$cartItem = CartItem::where('id', $id)->first();
	
			if ($cartItem && $cartItem->cart->user_id === $user->id) {
				$cartItem->delete();
	
				Session::flash('success', 'Item removed from cart successfully.');
			} else {
				Session::flash('error', 'Unable to remove item from cart.');
			}
		} else {

		}
	
		return redirect('carts');
	}

}
