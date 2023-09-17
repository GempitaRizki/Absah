<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Models\ProductImage;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->data['currentUserMenu'] = 'categories';
        $this->data['currentUserSubMenu'] = 'category';
        
    }

    public function index()
    {
        $categories = Category::where('parent_id', 0)->get(); 
        $products = Product::all(); 
    
        $productImages = ProductImage::whereIn('product_id', $products->pluck('id'))->get();
        
        return view('dashboard.index', compact('categories', 'products', 'productImages'));
    }
    
     

}
