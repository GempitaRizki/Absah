<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faktur;
use App\Models\StoreUser;
use App\Models\MasterStatus;
use Illuminate\Support\Facades\Auth;

class PajakSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'pajakseller';
    }

    public function index()
    {
        $Fakturs = Faktur::all();
        $statusFakturList = MasterStatus::getTypeFaktur();
        $fakturOrder = MasterStatus::getStatusFaktur();

        return view('seller.Items.pajakIndex', compact('Fakturs', 'statusFakturList', 'fakturOrder'));
    }



    public function store(Request $request)
    {
        $store = StoreUser::where('user_id', Auth::user()->id)->first();
        $request->merge(['store_id' => $store->store_id]);
        $request->merge(['startdate' => now()]);
        $request->offsetUnset('enddate');    
        $statusFaktur = MasterStatus::where('id', 152)->first();
    
        $fakturData = $request->all();
        $fakturData['status_faktur'] = $statusFaktur->id;
    
        Faktur::create($fakturData);
    
        return redirect()->route('pajak.index')
            ->with('success', 'Data faktur berhasil ditambahkan.');
    }    
}
