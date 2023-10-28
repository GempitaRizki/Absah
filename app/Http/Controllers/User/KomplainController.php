<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    public function __construct()
    {
        $this->data['currentUserMenu'] = 'komplainUser';
    }

    public function index()
    {
        return view('user.Items.komplainIndex', $this->data);
    }
}

