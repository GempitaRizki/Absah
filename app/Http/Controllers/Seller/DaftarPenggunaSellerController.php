<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarPenggunaSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'daftarpenggunaSeller';
    }

    public function index()
    {
        return view('seller.Items.daftarpenggunaIndex');
    }
}
