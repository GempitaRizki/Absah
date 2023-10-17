<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreUser;

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
            $storeId = $storeDetail->store_id;
            $daftarToko = Store::all();
            $dataProvider = User::whereHas('storeUser', function ($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })->get();
        } else {
            $dataProvider = collect();
            $daftarToko = Store::all();
        }
    
        $totalPengguna = $dataProvider->count();
        $totalPenggunaAktif = $dataProvider->where('status', User::STATUS_ACTIVE)->count();
        $totalPenggunaTidakAktif = $dataProvider->where('status', User::STATUS_NOT_ACTIVE)->count();

        // \Log::info('Total Pengguna: ' . $totalPengguna);
        // \Log::info('Daftar Pengguna Aktif: ' . $totalPenggunaAktif);
        // \Log::info('Daftar Pengguna tidak aktif: ' . $totalPenggunaTidakAktif);
        
        return view('seller.Items.daftarpenggunaIndex', compact('dataProvider', 'daftarToko', 'totalPengguna', 'totalPenggunaAktif', 'totalPenggunaTidakAktif'));
    }
    

    
    
    public function create()
    {
        return view('seller.daftarpengguna.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'store_id' => 'required|integer',
        ]);
    
        $user = new User($data);
        $user->save();
    
        $storeUser = new StoreUser([
            'store_id' => $data['store_id'],
            'user_id' => $user->id,
        ]);
        $storeUser->save();
    
        return redirect()->route('daftarpengguna.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }
    
}
