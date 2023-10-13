<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'productseller';
    }

    public function index()
    {
        return view('seller.Items.productIndex', $this->data);
    }
}
