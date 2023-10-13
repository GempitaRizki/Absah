<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NegoSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'negoSeller';
    }

    public function index()
    {
        return view('seller.Items.negoIndex');
    }
}
