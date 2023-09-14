<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SellerRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.sellerRegister');
    }
}
