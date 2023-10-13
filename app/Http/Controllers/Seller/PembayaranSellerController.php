<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'pembayaranseller';
    }

    public function index()
    {
        return view('seller.Items.pembayaranIndex', $this->data);
    }
}
