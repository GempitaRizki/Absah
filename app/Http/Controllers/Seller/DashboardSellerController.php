<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'dashboardseller';
    }

    public function index()
    {
        return view('seller.Items.dashboardIndex', $this->data);
    }
}
