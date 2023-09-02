<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showmenu()
    {
        $categories = Category::all()->where('parent_id', 0);
        $products = Product::all();

        return view('dashboard.index', compact(['categories', 'products']));
    }
}
