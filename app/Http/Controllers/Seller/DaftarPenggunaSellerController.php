<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSekolah; 

class DaftarPenggunaSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'daftarpenggunaSeller';
    }

    public function index()
    {
        $user = auth()->user();
    
        $storeDetail = $user->storeDetail;
    
        if ($storeDetail) {
            $dataProvider = UserSekolah::where('sekolah_id', $storeDetail->store_id)->get();
            $this->data['dataProvider'] = $dataProvider;
        } else {
            $this->data['dataProvider'] = collect();
        }
    
        return view('seller.Items.daftarpenggunaIndex', $this->data);
    }
}
