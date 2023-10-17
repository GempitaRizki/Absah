<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreDataController extends Controller
{
    public function store(Request $request)
    {
        // Mendapatkan data yang dikirim dari formulir
        $productTypeId = $request->input('product_type_id');
        $priceTypeId = $request->input('price_type');
        $conditionId = $request->input('condition_id');
        $attributeId = $request->input('attribute');

        // Mengecek apakah data sudah ada dalam session
        if (session()->has('temporaryData')) {
            $temporaryData = session('temporaryData');
        } else {
            $temporaryData = [];
        }

        // Menyimpan data dalam session sesuai dengan ID yang dipilih
        $temporaryData = [
            'productTypeId' => $productTypeId,
            'priceTypeId' => $priceTypeId,
            'conditionId' => $conditionId,
            'attributeId' => $attributeId,
        ];

        session(['temporaryData' => $temporaryData]);

        // Redirect atau lakukan yang lain sesuai kebutuhan
        return redirect()->route('index-awal');
    }
}
