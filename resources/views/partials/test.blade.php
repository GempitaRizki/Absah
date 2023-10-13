public function index()
{
    $user = Auth::user();
    $user_id = $user->id;

    $cart = Cart::firstOrNew(['user_id' => $user_id, 'status' => 1]);
    if (!$cart->exists) {
        $cart->save();
    }

    $cartItems = CartItem::where('cart_id', $cart->id)->get();
    $productIds = $cartItems->pluck('product_id')->toArray();

    $products = Product::with('images')->whereIn('id', $productIds)->get();

    // ...

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