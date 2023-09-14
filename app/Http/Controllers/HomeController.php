<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        return $this->load_theme('home');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
        return view('home', ['msg'=>'ini adalah role user']);
    }

    public function sellerHome()
    {
        return view('home', ['msg'=>'ini adalah role seller']);
    }

    public function mitraHome()
    {
        return view('home', ['msg'=>'ini adalah role mitra']);
    }
}
