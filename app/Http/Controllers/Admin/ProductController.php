<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Str;
use Auth;
use DB;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
	{

		$this->data['currentAdminMenu'] = 'catalog';
		$this->data['currentAdminSubMenu'] = 'product';

		$this->data['statuses'] = Product::statuses();
        $this->data['types'] = [];
	}
    
     public function index()
    {
        $this->data['products'] = Product::orderBy('name', 'ASC')->paginate(10);

		return view('admin.products.index', $this->data);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

		$this->data['categories'] = $categories->toArray();
		$this->data['product'] = null;
		$this->data['productID'] = 0;
		$this->data['categoryIDs'] = [];

		return view('admin.products.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
		$params['user_id'] = Auth::user()->id;

        $saved = false;
        $saved = DB::transaction(function() use ($params){
            $product = Product::create($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if ($saved) {
            Session::flash('Success', 'Product has been saved');
        
        } else {
            Session::flash('error', 'Product not be saved');
            
            return redirect('admin/products');
        }

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
