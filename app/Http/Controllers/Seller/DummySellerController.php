<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategoryExtended;

class DummySellerController extends Controller
{
    public function queryType1()
    {
        $categories = ProductCategoryExtended::whereIn('id', [1, 2])
            ->with('children')
            ->get();

        $filteredCategories = $categories->filter(function ($category) {
            return $category->scopeByParentAndIds([1, 2], $category->children->pluck('id')->toArray());
        });

        return view('category.index', compact('filteredCategories'));
    }


    public function queryType2()
    {
        $categories = ProductCategoryExtended::whereIn('parent_id', [1, 2])
            ->with('parent')
            ->get();

        return view('category.index', compact('categories'));
    }
}
