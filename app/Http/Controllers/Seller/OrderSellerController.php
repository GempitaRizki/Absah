<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'orderseller';
    }

    public function index()
    {
        return view('seller.Items.orderIndex', $this->data);
    }

    public function Store(Request $request)
    {
        
    }
}
