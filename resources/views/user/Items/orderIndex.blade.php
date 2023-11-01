@extends('cms.user.index')

@section('content')
    <ul class="pagination pagination-month justify-content-center">
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => 'semua']) }}">
                <p class="page-month mb-0"> Semua Order </p>
                <p class="page-year mb-0">{{ $totalOrders }}</p>
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_BARU]) }}">
                <p class="page-month mb-0"> Baru Order </p>
                @if ($newOrder !== null)
                    {{ $newOrder }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link"
                href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_KONFIRMASI_PENGIRIMAN]) }}">
                <p class="page-month mb-0"> Konfirmasi / Proses </p>
                @if ($konfirmasiOrder !== null)
                    {{ $konfirmasiOrder }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link"
                href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_KONFIRMASI_PEMBATALAN_PENJUAL]) }}">
                <p class="page-month mb-0"> Konfirmasi Batal </p>
                @if ($konfirmasiBatal !== null)
                    {{ $konfirmasiBatal }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link"
                href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_DIBATALKAN_PEMBELI]) }}">
                <p class="page-month mb-0"> Dibatalkan Pembeli </p>
                @if ($dibatalkanPembeli !== null)
                    {{ $dibatalkanPembeli }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_DIKIRIM]) }}">
                <p class="page-month mb-0"> Dikirim </p>
                @if ($dikirim !== null)
                    {{ $dikirim }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_DITERIMA]) }}">
                <p class="page-month mb-0"> Diterima </p>
                @if ($diterima !== null)
                    {{ $diterima }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_SUDAH_BAST]) }}">
                <p class="page-month mb-0"> Sudah BAST </p>
                @if ($sudahBAST !== null)
                    {{ $sudahBAST }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link"
                href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_MENUNGGU_PEMBAYARAN]) }}">
                <p class="page-month mb-0"> Menunggu Pembayaran </p>
                @if ($menungguPembayaran !== null)
                    {{ $menungguPembayaran }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_TERBAYAR]) }}">
                <p class="page-month mb-0"> Dibayar </p>
                @if ($dibayar !== null)
                    {{ $dibayar }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link"
                href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_PESANAN_SELESAI]) }}">
                <p class="page-month mb-0"> Selesai </p>
                @if ($selesai !== null)
                    {{ $selesai }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link"
                href="{{ route('order.index', ['status' => \App\Models\IprOrder::PESANAN_PESANAN_SELESAI]) }}">
                <p class="page-month mb-0"> Dalam Complain </p>
                @if ($selesai !== null)
                    {{ $selesai }}
                @else
                    0
                @endif
            </a>
        </li>
        <li class="page-item mr-2 text-center">
            <a class="page-link" href="{{ route('order.index', ['status' => 'dibekukan']) }}">
                <p class="page-month mb-0"> Dibekukan </p>
                @if ($dibekukan !== null)
                    {{ $dibekukan }}
                @else
                    0
                @endif
            </a>
        </li>
    </ul>
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                    <a class="nav-link active">Total Nominal : Rp{{ number_format($totalPayment) }}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Order</th>
                            <th>Tanggal Pesanan</th>
                            <th>Total Pesanan </th>
                            <th>Status</th>
                            <th>Penjual</th>
                            <th>Penjual wajib kirim
                                dalam jangka waktu</th>
                            <th>Tiba di sekolah</th>
                            <th>Tanggal BAST</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
