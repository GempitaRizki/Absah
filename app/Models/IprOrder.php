<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;


class IprOrder extends Model
{
    const PESANAN_AKTIF = ['57', '58', '59', '60', '159', '61', '62', '63', '135', '72', '156', '157'];
    const PESANAN_BARU = '57';
    const PESANAN_KONFIRMASI_PENGIRIMAN = '58';
    const PESANAN_KONFIRMASI_PEMBELI = '108';
    const PESANAN_KONFIRMASI_PENJUAL = '109';
    const PESANAN_KONFIRMASI_BATAL_PENGIRIMAN_PENJUAL = '129';
    const PESANAN_KONFIRMASI_BATAL_PENGIRIMAN_PEMBELI = '131';
    const PESANAN_DITOLAK = '69';
    const PESANAN_DITOLAK_PENJUAL = '130';
    const PESANAN_DIKIRIM = '59';
    const PESANAN_DITERIMA = '60';
    const PESANAN_MENUNGGU_PEMBAYARAN = '61';
    const PESANAN_TERBAYAR = '62';
    const PESANAN_PESANAN_SELESAI = '63';
    const PESANAN_VERIFIKASI_PEMBAYARAN = '72';
    const PAYMENT_METHOD_TRANSFER = '64';
    const SHIPPING_METHOD_KURIR_PRIBADI = '66';
    const SHIPPING_METHOD_KURIR_JALADARA = '1';
    const SHIPPING_METHOD_STATUS = '68';
    const PESANAN_DALAM_KOMPLAIN = '135';
    const PESANAN_DIBATALKAN_PEMBELI = '149';
    const PESANAN_KONFIRMASI_PEMBATALAN_PEMBELI = '156';
    const PESANAN_KONFIRMASI_PEMBATALAN_PENJUAL = '157';
    const PESANAN_PEMBELI_MERUBAH_PESANAN = '167';
    const PESANAN_SUDAH_BAST = '159';
    const PESANAN_DITUTUP = '168';
    const MIN_50 = '50000000';
    const MAX_200 = '200000000';
    const ESTIMASI_PEMBAYARAN = '1 Hari Setelah Barang Diterima';
    const MSG_PESANAN_DIBUAT = 'Pesanan Dibuat';
    const MSG_PESANAN_MENUNGGU_KONFIRMASI_PENGIRIMAN = 'Menunggu Konfirmasi Pengiriman';
    const MSG_PESANAN_MENUNGGU_KONFIRMASI_PEMBELI = 'Menunggu Konfirmasi Pembeli';
    const MSG_PESANAN_MENUNGGU_KONFIRMASI_PENJUAL = 'Menunggu Konfirmasi Penjual';
    const MSG_PESANAN_DIKIRIM = 'Dalam Pengiriman';
    const MSG_PESANAN_DITERIMA = 'Pesanan Diterima';
    const MSG_PESANAN_SELESAI = 'Pesanan Selesai';
    const MSG_PESANAN_DIBATALKAN_PEMBELI = 'Pesanan Dibatalkan Pembeli';
    const MSG_PESANAN_DIBATALKAN_PENJUAL = 'Pesanan Dibatalkan Penjual';
    const MSG_PESANAN_PEMBELI_MERUBAH_PESANAN = 'Pembeli Merubah Pesanan';
    const MSG_PESANAN_RUSAK_DIBATALKAN_PEMBELI = 'Pesanan Dibatalkan Karena Barang Tidak Sesuai / Rusak Semua';
    const MSG_PESANAN_KONFIRMASI_BATAL_PENGIRIMAN_PENJUAL = 'Penerimaan Pembatalan Pengiriman';
    const MSG_PESANAN_KONFIRMASI_BATAL_PENGIRIMAN_PEMBELI = 'Konfirmasi Pembatalan Pengiriman';
    const MSG_PESANAN_TOLAK_BATAL_PENGIRIMAN_PENJUAL = 'Penolakan Pembatalan Pengiriman';
    const MSG_PESANAN_DALAM_KOMPLAIN = 'Pesanan Masih Dalam Komplain';
    const MSG_KOMPLAIN_PESANAN_DITOLAK = 'Komplain Pesanan Ditolak Penjual';
    const MSG_PESANAN_DIBATALKAN = 'Pesanan Dibatalkan';
    const MSG_PESANAN_KONFIRMASI_PEMBATALAN_PEMBELI = 'Pesanan Menunggu Konfirmasi Pembatalan Pembeli';
    const MSG_PESANAN_KONFIRMASI_PEMBATALAN_PENJUAL = 'Pesanan Menunggu Konfirmasi Pembatalan Penjual';
    const MSG_PESANAN_SUDAH_BAST = 'BAST dibuat Sekolah';
    const MSG_PESANAN_DITUTUP = 'Pesanan Ditutup';
    const MSG_MENUNGGU_PEMBAYARAN = 'Menunggu Pembayaran';
    const MSG_PEMBAYARAN_VERIFIKASI = 'Verifikasi Pembayaran';
    const MSG_TERBAYAR = 'Terbayar';
    const MSG_PEMBELI_KONFIRMASI_PEMBAYARAN = 'Pembeli Konfirmasi Pembayaran';
    const MSG_PEMBELI_MELAKUKAN_NEGO = 'Pembeli Melakukan Nego';
    const MSG_PENJUAL_MELAKUKAN_NEGO = 'Penjual Melakukan Nego';
    const MSG_PENJUAL_TOTAL_NEGO = 'Nego di Tolak';
    const MSG_PENJUAL_TERIMA_NEGO = 'Nego di Terima';
    const TANGGAL_MULAI_PPN_SEBELAS_PERSEN = '2022-04-01';

    use HasFactory;
    protected $table = 'ipr_order';
    protected $fillable = [
        'nomor_order',
        'nomor_invoice',
        'date_order',
        'payment_method',
        'user_id',
        'status_id',
        'store_id',
        'shipping_data',
        'shipping_method',
        'shipping_status',
        'shipping_cost',
        'shipping_resi',
        'shipping_estimate',
        'confirm_shipping_date',
        'sumber_dana_id',
        'cart_id',
        'denda',
        'estimasi_pembayaran',
        'is_edit',
        'edit_confirm',
        'sekolah_id',
        'shipping_note',
        'bank_id',
        'is_beku',
        'payment_numbers',
        'payment_note',
        'reorder',
        'gantung',
        'tiba_sekolah',
        'total_pesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(MasterStatus::class, 'shipping_method', 'id');
    }

    public function shippingStatus()
    {
        return $this->belongsTo(MasterStatus::class, 'shipping_status', 'id');
    }

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana_id', 'id');
    }

    public static function getTotalOrderBuyerByStatus($status = null)
    {
        $userId = auth()->user()->id;
        $sekolahId = UserSekolah::where(['user_id' => $userId, 'status' => 1])->first();

        $query = IprOrder::where('sekolah_id', $sekolahId ? $sekolahId->sekolah_id : null);

        if ($status !== null) {
            $query->where('status_id', $status);
        }

        return $query->count();
    }


    public static function getTotalOrderStoreByStatusBuyerPembekuan()
    {
        $userId = auth()->user()->id;
        $userSekolah = UserSekolah::where(['user_id' => $userId, 'status' => 1])->first();

        if ($userSekolah) {
            return IprOrder::where(['is_beku' => 1, 'sekolah_id' => $userSekolah->sekolah_id])->count();
        } else {
            return 0;
        }
    }

    public static function getTotalAmountOrderStoreByStatusBuyerPembukuan()
    {
        $userId = auth()->user()->id;

        if (Schema::hasTable('order_product')) {
            $shippingCost = IprOrder::where(['is_beku' => 1, 'user_id' => $userId])->sum('shipping_cost');
            $productCost = IprOrder::selectRaw('SUM(order_product.qty * order_product.price) as product_cost')
                ->leftJoin('order_product', 'orders.id', '=', 'order_product.order_id')
                ->where(['orders.is_beku' => 1, 'orders.user_id' => $userId])
                ->first();

            $model = $productCost->product_cost + $shippingCost;
        } else {
            $model = 0;
        }

        return $model;
    }



    public static function getTotalPesananBaruSeller()
    {
        $storeId = Store::getStoreIdByUserLogin();
        $model = IprOrder::where(['store_id' => $storeId, 'status_id' => self::PESANAN_BARU])->count();

        return $model;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->nomor_order = 'ABS' . now()->format('Ym') . str_pad(IprOrder::count() + 1, 7, '0', STR_PAD_LEFT);
        
            $order->date_order = now();
        });
    }
}
