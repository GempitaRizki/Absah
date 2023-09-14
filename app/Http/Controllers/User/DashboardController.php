<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->data['currentUserMenu'] = 'categories';
        $this->data['currentUserSubMenu'] = 'category';
        
    }

    public function index()
    {
        $categories = Category::all()->where('parent_id', 0);
        $products = Product::all();
        
        return view('dashboard.index', compact('categories', 'products'));
    }  

}
