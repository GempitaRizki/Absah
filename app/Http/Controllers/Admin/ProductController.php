<?php

namespace App\Http\Controllers\Admin;

// use App\Authorizable;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Http\Requests\ProductImageRequest;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\ProductAttributeValue;
use App\Models\ProductInventory;
use Illuminate\Support\Facades\Session;
use App\Models\Price;

use Str;
use Auth;
use DB;

class ProductController extends Controller
{
	// use Authorizable;
	public function __construct()
	{

        $this->data['currentAdminMenu'] = 'catalog';
        $this->data['currentAdminSubMenu'] = 'product';

		$this->data['statuses'] = Product::statuses();
		$this->data['types'] = Product::types();
	}

	public function index()
	{
		$this->data['products'] = Product::orderBy('name', 'ASC')->paginate(10);

		return view('admin.products.index', $this->data);
	}

	public function showProduct()
	{
		$products = Product::all();
        return view('themes.ezone.carts.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$categories = Category::orderBy('name', 'ASC')->get();
		$configurableAttributes = $this->getConfigurableAttributes();

		$this->data['categories'] = $categories->toArray();
		$this->data['product'] = null;
		$this->data['productID'] = null;
		$this->data['categoryIDs'] = [];
		$this->data['configurableAttributes'] = $configurableAttributes;

		return view('admin.products.form', $this->data);
	}

	private function getConfigurableAttributes()
	{
		return Attribute::where('is_configurable', true)->get();
	}

	private function convertVariantAsName($variant)
	{
		$variantName = '';

		foreach (array_keys($variant) as $key => $code) {
			$attributeOptionID = $variant[$code];
			$attributeOption = AttributeOption::find($attributeOptionID);

			if ($attributeOption) {
				$variantName .= ' - ' . $attributeOption->name;
			}
		}

		return $variantName;
	}

	private function generateProductVariants($product, $params)
	{
		$configurableAttributes = $this->getConfigurableAttributes();

		$variantAttributes = [];
		foreach ($configurableAttributes as $attribute) {
			$variantAttributes[$attribute->code] = $params[$attribute->code];
		}


		$variants = $this->generateAttributeCombinations($variantAttributes);

		if ($variants) {
			foreach ($variants as $variant) {
				$variantParams = [
					'parent_id' => $product->id,
					'user_id' => Auth::user()->id,
					'sku' => $product->sku . '-' . implode('-', array_values($variant)),
					'type' => 'simple',
					'name' => $product->name . $this->convertVariantAsName($variant),
				];

				$variantParams['slug'] = Str::slug($variantParams['name']);

				$newProductVariant = Product::create($variantParams);

				$categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
				$newProductVariant->categories()->sync($categoryIds);

				$this->saveProductAttributeValues($newProductVariant, $variant, $product->id);
			}
		}
	}

	private function saveProductAttributeValues($product, $variant, $parentProductID)
	{
		foreach (array_values($variant) as $attributeOptionID) {
			$attributeOption = AttributeOption::find($attributeOptionID);

			$attributeValueParams = [
				'parent_product_id' => $parentProductID,
				'product_id' => $product->id,
				'attribute_id' => $attributeOption->attribute_id,
				'text_value' => $attributeOption->name,
			];

			ProductAttributeValue::create($attributeValueParams);
		}
	}

	private function generateAttributeCombinations($arrays)
	{
		$result = [[]];
		foreach ($arrays as $property => $property_values) {
			$tmp = [];
			foreach ($result as $result_item) {
				foreach ($property_values as $property_value) {
					$tmp[] = array_merge($result_item, array($property => $property_value));
				}
			}
			$result = $tmp;
		}
		return $result;
	}

	public function store(ProductRequest $request)
	{
		$params = $request->except('_token');
		$params['slug'] = Str::slug($params['name']);
		$params['user_id'] = Auth::user()->id;

		$product = DB::transaction(
			function () use ($params) {
				$categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
				$product = Product::create($params);
				$product->categories()->sync($categoryIds);

				if ($params['type'] == 'configurable') {
					$this->_generateProductVariants($product, $params);
				}

				return $product;
			}
		);

		if ($product) {
			Session::flash('success', 'Product has been saved');
		} else {
			Session::flash('error', 'Product could not be saved');
		}

		return redirect('admin/products/'. $product->id .'/edit/');
	}

	public function edit(string $id)
	{
		if (empty($id)) {
			return redirect('admin/products/create');
		}

		$product = Product::findOrFail($id);
		$product->qty = isset($product->productInventory) ? $product->productInventory->qty : null;
		$categories = Category::orderBy('name', 'ASC')->get();

		$this->data['categories'] = $categories->toArray();
		$this->data['product'] = $product;
		$this->data['productID'] = $product->id;
		$this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();
		//05/09/2023 Gempita Rizki, fitur multi categories menggunakan pluck  

		return view('admin.products.form', $this->data);
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function update(ProductRequest $request, $id)
	{
		$params = $request->except('_token');
		$params['slug'] = Str::slug($params['name']);

		$params['price'] = $request->input('price');


		$price = Product::updateOrCreate(['id' => $id], ['price' => $params['price']]);

		$params['price'] = $price->price;


		$product = Product::findOrFail($id);
		$saved = false;

		$saved = DB::transaction(
			function () use ($product, $params) {
				$categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
				$product->update($params);
				$product->categories()->sync($categoryIds);

				if ($product->type == 'configurable') {
					$this->updateProductVariants($params);
				} else {
					ProductInventory::updateOrCreate(['product_id' => $product->id], ['qty' => $params['qty']]);
				}

				return true;
			}
		);

		if ($saved) {
			Session::flash('success', 'Product has been updated');
		} else {

			Session::flash('error', 'Product could not be updated');
		}

		return redirect('admin/products');
	}

	private function updateProductVariants($params)
	{
		if ($params['variants']) {
			foreach ($params['variants'] as $productParams) {
				$product = Product::find($productParams['id']);
				$product->update($productParams);

				$product->status = $params['status'];
				$product->save();

				ProductInventory::updateOrCreate(['product_id' => $product->id], ['qty' => $productParams['qty']]);
			}
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

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name = $product->slug . '_' . time();
        $fileName = $name . '.' . $image->getClientOriginalExtension();

        $folder = ProductImage::UPLOAD_DIR; 

        $filePath = $image->storeAs($folder, $fileName, 'public');

        $params = [
            'product_id' => $product->id,
            'path' => $filePath,
        ];

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
