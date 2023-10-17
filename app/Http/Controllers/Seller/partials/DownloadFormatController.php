<?php

namespace App\Http\Controllers\Seller\partials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DownloadFormatController extends Controller
{
    public function index()
    {
        return view('seller.daftarproduk.downloadtemplate');
    }

    public function download($type)
    {
        switch ($type) {
            case 'produk-umum':
                $fileName = 'product_umum.xlsx';
                break;
            case 'master-kategori':
                $fileName = 'master_kategori.xlsx';
                break;
            case 'master-tag-ppn':
                $fileName = 'master_tag_ppn.xlsx';
                break;
            case 'master-tipe-ongkir':
                $fileName = 'master_tipe_ongkir.xlsx';
                break;
            default:
                abort(404);
        }

        $url = asset("asset/template/$fileName"); 
        return redirect($url);
    }

}

