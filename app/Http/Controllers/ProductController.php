<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Price;
use Str;

class ProductController extends Controller
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
        
            $lowPrice = null;
            $highPrice = null;
        
            if ($priceSlider = $request->query('price')) {
                $prices = explode('-', $priceSlider);
        
                $lowPrice = !empty($prices[0]) ? (float)$prices[0] : $this->data['minPrice'];
                $highPrice = !empty($prices[1]) ? (float)$prices[1] : $this->data['maxPrice'];
        
                if ($lowPrice && $highPrice) {
                    $products = $products->where('price', '>=', $lowPrice)
                        ->where('price', '<=', $highPrice)
                        ->orWhereHas('variants', function ($query) use ($lowPrice, $highPrice) {
                            $query->where('price', '>=', $lowPrice)
                                ->where('price', '<=', $highPrice);
                        });

                    $this->data['minPrice'] = $lowPrice;
                    $this->data['maxPrice'] = $highPrice;
                }
            }
        
            $this->data['products'] = $products->paginate(9);
            return $this->load_theme('products.index', $this->data);
        }
        
    public function show($slug)
	{
		$product = Product::active()->where('slug', $slug)->first();

		if (!$product) {
			return redirect('products');
		}

		if ($product->configurable()) {
			$this->data['colors'] = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
			$this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
		}

		$this->data['product'] = $product;

		return $this->load_theme('products.show', $this->data);
	}
}
