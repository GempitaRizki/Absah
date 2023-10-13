<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomplainSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'komplainSeller';
    }

    public function index()
    {
        return view('seller.Items.komplainIndex');
    }
}
