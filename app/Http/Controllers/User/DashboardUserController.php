<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function __construct()
    {
        $this->data['currentUserMenu'] = 'dashboarduser';
    }

    public function index()
    {
        return view('user.Items.dashboardIndex');
    }
}
