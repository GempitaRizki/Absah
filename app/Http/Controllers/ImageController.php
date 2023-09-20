<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;

class ImageController extends Controller
{
    public function show($id)
    {
        $image = ProductImage::findOrFail($id);
        return response()->json(['image_url' => $image->image_url]);
    }
}
