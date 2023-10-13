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
        $this->_initSellerMenu();
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

    private function _initSellerMenu()
    {
        $this->data['currentSellerMenu'] = 'dashboardseller';
        $this->data['currentSellerMenu'] = 'orderseller';
        $this->data['currentSellerMenu'] = 'pembayaranseller';
        $this->data['currentSellerMenu'] = 'pajakseller';
        $this->data['currentSellerMenu'] = 'productseller';
        $this->data['currentSellerMenu'] = 'negoSeller';
        $this->data['currentSellerMenu'] = 'chatSeller';
        $this->data['currentSellerMenu'] = 'komplainSeller';
        $this->data['currentSellerMenu'] = 'daftarpenggunaSeller';
        $this->data['currentSellerMenu'] = 'aktivitaspenggunaSeller';
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