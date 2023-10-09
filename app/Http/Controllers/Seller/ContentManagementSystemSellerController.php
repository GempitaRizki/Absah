<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentManagementSystemSellerController extends Controller
{
    public function Index()
    {
        return view('Seller.IndexCMS');
    }
}
