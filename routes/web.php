<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Auth\MenuRegisterController;
use App\Http\Controllers\Auth\SellerRegisterController;
use App\Http\Controllers\FavoriteController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Route Keranjang
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/carts', [CartController::class, 'index'])->name('cart.show');
    Route::get('/carts/remove/{itemId}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::post('/cart/store/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/carts', [CartController::class, 'update'])->name('cart.update');
    Route::post('update-to-cart',[CartController::class, 'updatetocart']);
    Route::get('/mini-cart', [CartController::class, 'show'])->name('mini_cart.show');
});

//menampilkan gambar pertama pada database
Route::get('image/{id}', [ImageController::class, 'show']);


//product Controller dari user / Di definisikan sebagai ControllersProductController // 05/09/2023 change to UserControllerProduct
Route::controller(ProductUserController::class)->group(function () {
    Route::get('/products', [ProductUserController::class, 'index']);
    Route::get('/product/{slug}', [ProductUserController::class, 'show']);
    Route::get('/products/quick-view/{slug}', [ProductUserController::class, 'quickView']);
});

Auth::routes();

//Admin middleware
Route::middleware(['auth', 'role:admin'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('attributes', AttributeController::class);
    // Route::resource('roles', RoleController::class);
    Route::resource('user', UserController::class);

    // Route Image
    Route::get('products/{productID}/images', [ProductController::class, 'images']);
    Route::get('products/{productID}/add-image', [ProductController::class, 'add_image']);
    Route::post('products/images/{productID}', [ProductController::class, 'upload_image']);
    Route::delete('products/images/{imageID}', [ProductController::class, 'remove_image']);
});


// User route // ini nanti buat cms user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/', [HomeController::class, 'userHome'])->name('home');
});

// Seller route// ini nanti buat cms seller
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/home', [HomeController::class, 'sellerHome'])->name('home.seller');
});

// Mitra route// ini nanti buat cms mitra
Route::middleware(['auth', 'role:mitra'])->group(function () {
    Route::get('/mitra/home', [HomeController::class, 'mitraHome'])->name('home.mitra');
});

// Mitra route// ini nanti buat cms mitra
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'AdminHome'])->name('admin.mitra');
});
//favorite resource
Route::resource('favorites', FavoriteController::class);

//register option change
Route::get('/seller/register', [SellerRegisterController::class, 'showRegistrationForm'])->name('register.seller');

//
Route::get('/register/user', [UserRegisterController::class, 'FormOneRegistrationUser'])->name('register.buyer');
Route::post('/register/user', [UserRegisterController::class, 'storageUser']);
