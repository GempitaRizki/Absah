<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'chatSeller';
    }

    public function index()
    {
        return view('seller.Items.chatIndex', $this->data);
    }
}
