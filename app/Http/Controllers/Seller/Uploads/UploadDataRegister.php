<?php

namespace App\Http\Controllers\Seller\Uploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadDataRegister extends Controller
{
    public function index()
    {
        return view('Seller.Uploads');
    }

    public function store(Request $request)
    {

    	$imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('upload'), $imageName);

    	return response()->json(['uploaded' => '/upload/'.$imageName]);

    }
}
