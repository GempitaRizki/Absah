<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IprOrder;
use App\Models\UserSekolah;

class OrderUserController extends Controller
{
    public function __construct()
    {
        $this->data['currentUserMenu'] = 'orderUser';
    }

    public function index()
    {
        $status = null;
        $totalOrders = IprOrder::getTotalOrderBuyerByStatus($status);
        $newOrder = IprOrder::getTotalPesananBaruSeller();
        $konfirmasiOrder = IprOrder::getTotalPesananBaruSeller();
        $konfirmasiBatal = IprOrder::getTotalPesananBaruSeller();
        $dibatalkanPembeli = IprOrder::getTotalPesananBaruSeller();
        $dikirim = IprOrder::getTotalPesananBaruSeller();
        $diterima = IprOrder::getTotalPesananBaruSeller();
        $sudahBAST = IprOrder::getTotalPesananBaruSeller();
        $menungguPembayaran = IprOrder::getTotalPesananBaruSeller();
        $dibayar = IprOrder::getTotalPesananBaruSeller();
        $selesai = IprOrder::getTotalPesananBaruSeller();
        $dibekukan = IprOrder::getTotalOrderStoreByStatusBuyerPembekuan();

        $totalPayment = IprOrder::getTotalAmountOrderStoreByStatusBuyerPembukuan();

        return view('user.Items.orderIndex', compact('dibekukan', 'selesai', 'dibayar', 'totalOrders', 'newOrder', 'konfirmasiOrder', 'konfirmasiBatal', 'dibatalkanPembeli', 'dikirim', 'diterima', 'sudahBAST', 'menungguPembayaran', 'totalPayment'));
    }


    public function getTotalOrderBuyerByStatus($status = null)
    {
        $userId = auth()->user()->id;
        $sekolah = UserSekolah::where(['user_id' => $userId, 'status' => 1])->first();

        if ($sekolah) {
            $query = IprOrder::where('sekolah_id', $sekolah->sekolah_id);
        } else {
            $query = IprOrder::query();
        }
        if ($status !== null) {
            $query->where('status_id', $status);
        }

        return $query->count();
    }

}
