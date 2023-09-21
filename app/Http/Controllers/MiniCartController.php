<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiniCartController extends Controller
{
    public function __construct()
    {
        $this->data['cartCategory'] = 'cartCategory';
    }

    public function index()
    {
        $user_id = auth();
        $cart = Cart::auth->check() 
    }
}
