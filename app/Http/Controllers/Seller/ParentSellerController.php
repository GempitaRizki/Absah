<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ParentSellerController extends Controller
{
    public function getSubCategories(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategories = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');
        return response()->json(['subCategories' => $subCategories]);
    }

    public function getSubCategorySatu(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subCategorySatu = ProductCategory::where('parent_id', $categoryId)->pluck('name', 'id');

        return response()->json(['subCategorySatu' => $subCategorySatu]);
    }

    public function getSubCategoryDua(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryDua = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryDua' => $subCategoryDua]);
    }

    public function getSubCategoryTiga(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryTiga = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryTiga' => $subCategoryTiga]);
    }
    public function getSubCategoryEmpat(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryEmpat = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryEmpat' => $subCategoryEmpat]);
    }

    public function getSubCategoryLima(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryLima = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryLima' => $subCategoryLima]);
    }

    public function getSubCategoryEnam(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subCategoryEnam = ProductCategory::where('parent_id', $parent_id)->pluck('name', 'id');

        return response()->json(['subCategoryEnam' => $subCategoryEnam]);
    }
}
