<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Http\Requests\ProductImageRequest;

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
    
        $saved = DB::transaction(function() use ($params) {
            $product = Product::create($params);
            $product->categories()->sync($params['category_ids']);
    
            return true;
        });
    
        if ($saved) {
            Session::flash('success', 'Product has been created');
            return redirect()->route('admin.products.index');
        } else {
            Session::flash('error', 'Product could not be created');
            return redirect()->back()->withInput();
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
        if (empty($id)) {
            return redirect('admin/products/create');
        }
    
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
    
        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = $product;
        $this->data['productID'] = $product->id;
        $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();
    
        return view('admin.products.form', $this->data);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
    
        $product = Product::findOrFail($id);
        $saved = false;
    
        $saved = DB::transaction(function () use ($product, $params) {
            $product->update($params);
            $product->categories()->sync($params['category_ids']);
    
            return true;
        });
    
        if ($saved) {
            Session::flash('success', 'Product has been updated');
            return redirect()->route('admin.products.index');
        } else {
            Session::flash('error', 'Product could not be updated');
            return redirect()->back();
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->delete()) {
            return redirect('admin/products')->with('success', 'Product has been deleted');
        }

        return redirect('admin/products');
    }

	public function images($id)
	{
        if (empty($id)) {
            return redirect('admin/products/create');
        }

		$product = Product::findOrFail($id);

		$this->data['productID'] = $product->id;
		$this->data['productImages'] = $product->productImages;

		return view('admin.products.images', $this->data);
	}

    public function add_image($id)
	{
		if (empty($id)) {
			return redirect('admin/products');
		}

		$product = Product::findOrFail($id);

		$this->data['productID'] = $product->id;
		$this->data['product'] = $product;

		return view('admin.products.image_form', $this->data);
	}

    public function upload_image(ProductImageRequest $request, $id)
	{
		$product = Product::findOrFail($id);

		if ($request->has('image')) {
			$image = $request->file('image');
			$name = $product->slug . '_' . time();
			$fileName = $name . '.' . $image->getClientOriginalExtension();

            $folder = 'public/images/original';

			$filePath = $image->storeAs($folder . '/original', $fileName, 'public');


			$params = array_merge(
				[
					'product_id' => $product->id,
					'path' => $filePath,
				],
			);

			if (ProductImage::create($params)) {
				Session::flash('success', 'Image has been uploaded');
			} else {
				Session::flash('error', 'Image could not be uploaded');
			}

			return redirect('admin/products/' . $id . '/images');
		}
	}

        public function remove_image($id)
        {
            $image = ProductImage::findOrFail($id);
    
            if ($image->delete()) {
                Session::flash('success', 'Image has been deleted');
            }
    
            return redirect('admin/products/' . $image->product->id . '/images');
        }
    }