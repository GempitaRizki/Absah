<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Category
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Product
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('products/create', [ProductController::class, 'create']);
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{productID}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{productID}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('products/{productID}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    //images
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
    Route::get('attributes/create', [AttributeController::class, 'create']);
    Route::get('attributes/{attributeID}/options', [AttributeController::class, 'options']);
    Route::post('attributes/options/{optionID}/edit', [AttributeController::class, 'store_option']);
    Route::delete('attributes/{optionID}/options', [AttributeController::class, 'remove_option']);
    Route::get('attributes/options/{optionID}/edit', [AttributeController::class, 'edit_option'])->name('admin.attributes.options.update');
    Route::put('attributes/options/{optionID}/edit', [AttributeController::class, 'update_option'])->name('admin.attributes.options.store');

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
