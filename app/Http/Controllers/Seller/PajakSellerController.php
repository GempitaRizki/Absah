<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PajakSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'pajakseller';
    }

    public function index()
    {
        return view('seller.Items.pajakIndex', $this->data);
    }
}
