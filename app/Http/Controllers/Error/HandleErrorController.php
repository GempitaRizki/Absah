<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleErrorController extends Controller
{
    public function index()
    {
        return view('error.404');
    }

    public function index403()
    {
        return view('error.403');
    }
}
