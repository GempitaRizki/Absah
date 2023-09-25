<?php

namespace App\Http\Controllers\Seller\Uploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadDataRegisterController extends Controller
{
    public function index()
    {
        return view('Seller.Uploads');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'store_id' => 'required',
            'file_category' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,pdf|max:2048', 
        ]);

        $id = $request->input('id');
        $store_id = $request->input('store_id');
        $file_category = $request->input('file_category');
        $file = $request->file('file');

        $sessionKey = "file_{$id}_{$store_id}_{$file_category}";
        $filePath = $file->store('uploads'); 
        session([$sessionKey => $filePath]);

        return redirect()->back()->with('success', 'File berhasil diunggah ke sesi.');
    }
}

