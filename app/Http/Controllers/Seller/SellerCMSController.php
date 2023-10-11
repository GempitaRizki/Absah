<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSku;

class SellerCMSController extends Controller
{

    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'catalog';
        $this->data['currentAdminSubMenu'] = 'product';

        $this->data['statuses'] = ProductSku::statuses();
        // $this->data['types'] = ProductSku::types();
    }
    public function index()
    {

        $this->data['product_sku'] = ProductSku::orderBy('name', 'ASC')->paginate(5);

        return view('cms.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
