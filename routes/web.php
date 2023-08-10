<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/products', 'ProductController@index');
Route::get('/product/{slug}', 'ProductController@show');
Route::get('/products/quick-view/{slug}', 'ProductController@quickView');

Route::get('/carts', 'CartController@index');
Route::get('/carts/remove/{cartID}', 'CartController@destroy');
Route::post('/carts', 'CartController@store');
Route::post('/carts/update', 'CartController@update');

Route::get('orders/checkout', 'OrderController@checkout');
Route::post('orders/checkout', 'OrderController@doCheckout');
Route::post('orders/shipping-cost', 'OrderController@shippingCost');
Route::post('orders/set-shipping', 'OrderController@setShipping');
Route::get('orders/received/{orderID}', 'OrderController@received');
Route::get('orders/cities', 'OrderController@cities');
Route::get('orders', 'OrderController@index');
Route::get('orders/{orderID}', 'OrderController@show');

Route::post('payments/notification', 'PaymentController@notification');
Route::get('payments/completed', 'PaymentController@completed');
Route::get('payments/failed', 'PaymentController@failed');
Route::get('payments/unfinish', 'PaymentController@unfinish');

Route::resource('favorites', 'FavoriteController');

Route::get('profile', 'Auth\ProfileController@index');
Route::post('profile', 'Auth\ProfileController@update');


Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //CATEGORY
    Route::resource('categories', CategoryController::class);

    // Product
    Route::resource('products', ProductController::class);

    //images
    Route::resource('products', 'ProductController');
    Route::get('products/{productID}/images', [ProductController::class, 'images']);
    Route::get('products/{productID}/add-image', [ProductController::class, 'add_image']);
    Route::post('products/images/{productID}', [ProductController::class, 'upload_image']);
    Route::delete('products/images/{imageID}', [ProductController::class, 'remove_image']);

    //Attribute
    Route::get('attributes', [AttributeController::class, 'index'])->name('admin.attributes.index');
    Route::get('attributes/create', [AttributeController::class, 'create']);
    Route::post('attributes', [AttributeController::class, 'store']); 
    Route::get('attributes/{attributeID}/edit', [AttributeController::class, 'edit']);
    Route::put('attributes/{attributeID}', [AttributeController::class, 'update']);
    Route::delete('attributes/{attributeID}', [AttributeController::class, 'destroy']);
    Route::get('attributes/options/{optionID}/edit', [AttributeController::class, 'edit_option'])->name('admin.attributes.options.update');
    Route::put('attributes/options/{optionID}/edit', [AttributeController::class, 'update_option'])->name('admin.attributes.options.store');
    Route::get('attributes/{attributeID}/options', [AttributeController::class, 'options']);
    Route::get('attributes/options/{optionID}/edit', [AttributeController::class, 'edit_option'])->name('admin.attributes.options.update');
    Route::put('attributes/options/{optionID}/edit', [AttributeController::class, 'update_option'])->name('admin.attributes.options.store');
    Route::post('attributes/options/{optionID}/edit', [AttributeController::class, 'store_option']);
    Route::delete('attributes/{optionID}/options', [AttributeController::class, 'remove_option']);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
