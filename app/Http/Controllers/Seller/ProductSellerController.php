<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSku;

class ProductSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'productseller';
    }

    public function index()
    {
        $totalProducts = ProductSku::getTotalProduct('all');
        $this->data['totalProducts'] = $totalProducts;

        return view('seller.items.product_index', $this->data);
    }
}

