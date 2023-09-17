<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth');
	}
	
	public function index()
	{
		$favorites = Favorite::where('user_id', \Auth::user()->id)
			->orderBy('created_at', 'desc')->paginate(10);
		
		$this->data['favorites'] = $favorites;

		return $this->load_theme('favorites.index', $this->data);
	}


	
	public function store(Request $request)
	{
		$request->validate([
			'product_slug' => 'required|string', 
		]);
	
		$product = Product::where('slug', $request->product_slug)->first();
			if (!$product) {
			return response('Product not found', 404);
		}
	
		$existingFavorite = Favorite::where('user_id', \Auth::user()->id)
			->where('product_id', $product->id)
			->first();
	
		if ($existingFavorite) {
			return response('You have added this product to your favorites before', 422);
		}
	
		Favorite::create([
			'user_id' => \Auth::user()->id,
			'product_id' => $product->id,
		]);
	
		return response('Product has been added to the favorites menu!', 200);
	}

	
	public function destroy($id)
	{
		$favorite = Favorite::findOrFail($id);
		$favorite->delete();

		\Session::flash('success', 'Your favorite has been removed');
		
		return redirect('favorites');
	}

}