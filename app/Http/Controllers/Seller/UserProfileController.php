<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'variantSeller';
    }
    public function Index()
    {
        return view('seller.daftarproduk.profile');
    }
}
