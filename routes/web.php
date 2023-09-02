<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\MultiAuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController as ControllersProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    ['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],
    function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('attributes', AttributeController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('user', UserController::class);
        //Route Image
        Route::get('products/{productID}/images', [ProductController::class, 'images']);
        Route::get('products/{productID}/add-image', [ProductController::class, 'add_image']);
        Route::post('products/images/{productID}', [ProductController::class, 'upload_image']);
        Route::delete('products/images/{imageID}', [ProductController::class, 'remove_image']);
    }
);

Auth::routes();

Route::get('/', [DashboardController::class, 'showmenu']);

//call image storage
//? Masih Bug//01/09/2023 22:04 Done storage./ path


//Route Keranjang -> middleware harus login s
Route::group(['middleware' => 'auth'], function(){
    Route::get('/carts', [CartController::class, 'index']);
    Route::get('/carts/remove/{cartID}', [CartController::class, 'destroy']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::post('/carts/update', [CartController::class, 'update']);
    //menampilkan gambar pertama pada database
    Route::get('image/{id}', [ImageController::class, 'show']);

});

//product Controller dari user / Di definisikan sebagai ControllersProductController
Route::get('/products', [ControllersProductController::class, 'index']);
Route::get('/product/{slug}', [ControllersProductController::class, 'show']);
Route::get('/products/quick-view/{slug}', [ControllerProductController::class, 'quickView']);


