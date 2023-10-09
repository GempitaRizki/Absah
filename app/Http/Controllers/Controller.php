<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Models\Cart;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];
    protected $uploadsFolder = 'uploads/';

    protected $redirectTo = '/info-sekolah';

    public function __construct()
    {

        $this->_initAdminMenu();
        $this->_initUserMenu();
    }

    private function _initAdminMenu()
    {
        $this->data['currentAdminMenu'] = 'dashboard';
        $this->data['currentAdminSubMenu'] = '';
    }

    private function _initUserMenu()
    {
        $this->data['currentUserMenu'] = 'category';
        $this->data['currentUserSubMenu'] = '';
    }

    protected function load_theme($view, $data = [])
    {
        return view('themes.' . env('APP_THEME') . '.' . $view, $data);
    }

    protected function loadTheme($view, $data = [])
    {
        return view('themes/' . env('APP_THEME') . '/' . $view, $data);
    }
};