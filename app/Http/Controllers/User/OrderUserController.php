<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
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
        $totalOrders = Order::getTotalOrderBuyerByStatus($status);
        $newOrder = Order::getTotalPesananBaruSeller();
        $konfirmasiOrder = Order::getTotalPesananBaruSeller();
        $konfirmasiBatal = Order::getTotalPesananBaruSeller();
        $dibatalkanPembeli = Order::getTotalPesananBaruSeller();
        $dikirim = Order::getTotalPesananBaruSeller();
        $diterima = Order::getTotalPesananBaruSeller();
        $sudahBAST = Order::getTotalPesananBaruSeller();
        $menungguPembayaran = Order::getTotalPesananBaruSeller();
        $dibayar = Order::getTotalPesananBaruSeller();
        $selesai = Order::getTotalPesananBaruSeller();
        $dibekukan = Order::getTotalOrderStoreByStatusBuyerPembekuan();

        $totalPayment = Order::getTotalAmountOrderStoreByStatusBuyerPembukuan();

        return view('user.Items.orderIndex', compact('dibekukan', 'selesai', 'dibayar', 'totalOrders', 'newOrder', 'konfirmasiOrder', 'konfirmasiBatal', 'dibatalkanPembeli', 'dikirim', 'diterima', 'sudahBAST', 'menungguPembayaran', 'totalPayment'));
    }


    public function getTotalOrderBuyerByStatus($status = null)
    {
        $userId = auth()->user()->id;
        $sekolah = UserSekolah::where(['user_id' => $userId, 'status' => 1])->first();

        if ($sekolah) {
            $query = Order::where('sekolah_id', $sekolah->sekolah_id);
        } else {
            $query = Order::query();
        }
        if ($status !== null) {
            $query->where('status_id', $status);
        }

        return $query->count();
    }

}
