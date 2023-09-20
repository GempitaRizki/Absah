<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\ProductAttributeValue;
use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\CartItem;

use Str;

class ProductUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['q'] = null;

        $this->data['categories'] = Category::parentCategories()
            ->orderBy('name', 'asc')
            ->get();

        $this->data['minPrice'] = Product::min('price');
        $this->data['maxPrice'] = Product::max('price');
    }

    public function index(Request $request)
    {
        $products = Product::active();
    
        $products = $this->filterProducts($request, $products);
    
        $this->data['products'] = $products->paginate(9);
    
        // Menambahkan kode yang diberikan
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
    
        $cartTotalQuantity = 0;
        foreach ($items as $item) {
            $cartTotalQuantity += $item->quantity;
        }
        $cartTotal = $cartSubtotal;
    
        return $this->load_theme('products.index', array_merge($this->data, compact('cartItems', 'cartSubtotal', 'cartTotal', 'cart', 'cartTotalQuantity')));
    }
    

    public function show($slug)
    {
        $product = Product::active()->where('slug', $slug)->first();
        $productImages = ProductImage::whereIn('product_id', $product->pluck('id'))->get();
    
        if (!$product) {
            return redirect('products');
        }
    
        if ($product->configurable()) {
            $this->data['colors'] = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
            $this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        }
    
        // Menambahkan kode yang diberikan
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
            $itemProduct = Product::findOrFail($item->product_id);
            $image = ProductImage::where('product_id', $itemProduct->id)->first();
            $total = $itemProduct->price * $item->quantity;
    
            $cartItems[] = [
                'item_id' => $item->id,
                'slug' => $itemProduct->slug,
                'image' => $image->path,
                'product_name' => $itemProduct->name,
                'price' => $itemProduct->price,
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
    
        $this->data['cartItems'] = $cartItems;
        $this->data['cartSubtotal'] = $cartSubtotal;
        $this->data['cartTotal'] = $cartTotal;
        $this->data['cartTotalQuantity'] = $cartTotalQuantity;
        $this->data['cart'] = $cart;
    
        $this->data['product'] = $product;
        $this->data['productImages'] = $productImages;
    
        return $this->load_theme('products.show', $this->data);
    }
    

    private function filterProducts(Request $request, $products)
    {
        if ($q = $request->query('q')) {
            $q = str_replace('-', ' ', Str::slug($q));

            $products = $products->whereRaw('MATCH(name, slug, short_description, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

            $this->data['q'] = $q;
        }

        if ($categorySlug = $request->query('category')) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $childIds = Category::childIds($category->id);
            $categoryIds = array_merge([$category->id], $childIds);

            $products = $products->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        if ($priceSlider = $request->query('price')) {
            $prices = explode('-', $priceSlider);

            $lowPrice = !empty($prices[0]) ? (float)$prices[0] : $this->data['minPrice'];
            $highPrice = !empty($prices[1]) ? (float)$prices[1] : $this->data['maxPrice'];

            if ($lowPrice && $highPrice) {
                $products = $products->where(function ($query) use ($lowPrice, $highPrice) {
                    $query->whereBetween('price', [$lowPrice, $highPrice])
                        ->orWhereHas('variants', function ($query) use ($lowPrice, $highPrice) {
                            $query->whereBetween('price', [$lowPrice, $highPrice]);
                        });
                });

                $this->data['minPrice'] = $lowPrice;
                $this->data['maxPrice'] = $highPrice;
            }
        }

        return $products;
    }
}
