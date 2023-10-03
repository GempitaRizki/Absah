<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\Seller\AuthSellerController;
use App\Http\Controllers\Seller\Uploads\UploadDataRegisterController;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\Seller\FileUploadController;
use App\Http\Controllers\SendMailController;
use App\Livewire\FileUploadComponent;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Route Keranjang
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/carts', [CartController::class, 'index'])->name('cart.show');
    Route::get('/carts/remove/{itemId}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::post('/cart/store/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/carts', [CartController::class, 'update'])->name('cart.update');
    Route::post('update-to-cart', [CartController::class, 'updatetocart'])->name('updatetocart');
    Route::get('/mini-cart', [CartController::class, 'show'])->name('mini_cart.show');
    Route::get('carts/remove', [CartController::class, 'destroyAll'])->name('cart.destroy-all');
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
Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('favorites', [FavoriteController::class, 'store'])->name('favorites.store');


//Seller Register
Route::get('/register/seller', [AuthSellerController::class, 'index'])->name('index.seller');
Route::post('/register/seller', [AuthSellerController::class, 'IndexStore'])->name('StoreSellerSession');
Route::get('/register/seller/form', [AuthSellerController::class, 'form'])->name('sellerIndexForm');
Route::post('/register/seller/form', [AuthSellerController::class, 'FormStore'])->name('StoreSellerIndex');
Route::get('/register/seller/form/info-ttd', [AuthSellerController::class, 'indexForm'])->name('indexForm.info-ttd');
Route::post('/register/seller/form/info-ttd', [AuthSellerController::class, 'IndexFormStore'])->name('StoreSellerIndexForm');

Route::get('/register/seller/form/location', [AuthSellerController::class, 'IndexLocation'])->name('IndexSellerLocation');
Route::get('/register/seller/form/bank', [AuthSellerController::class, 'IndexBank'])->name('indexBank');
Route::post('/register/seller/form/bank', [AuthSellerController::class, 'IndexBankStore'])->name('submitBankInfo');
Route::get('/register/seller/registration-summary', [AuthSellerController::class, 'summary'])->name('registrationSummary');

//User Register
Route::get('/register/buyer', [AuthUserController::class, 'index'])->name('index.users');
Route::post('/register/buyer', [AuthUserController::class, 'indexStore'])->name('StoreBuyerSession');
Route::get('/register/buyer/info-sekolah', [AuthUserController::class, 'infoSekolah'])->name('index.infoSekolah');
Route::post('/register/buyer/info-sekolah', [AuthUserController::class, 'infoSekolahStore'])->name('index.infoSekolahStore');

//Location seller
Route::get('/get-provinces', [AuthSellerController::class, 'getProvinces'])->name('get-provinces');
Route::get('/get-districts/{provinceId}', [AuthSellerController::class, 'getDistrictsByProvince'])->name('get-districts-by-province');
Route::get('/get-subdistricts/{districtId}', [AuthSellerController::class, 'getSubDistrictsByDistrict'])->name('get-subdistricts-by-district');
Route::get('/get-villages/{subdistrictId}', [AuthSellerController::class, 'getVillagesBySubDistrict'])->name('get-villages-by-subdistrict');
Route::post('/register/seller/form/location', [AuthSellerController::class, 'storeLocation'])->name('LocationServiceStore');

//wilayah jual
Route::get('/register/seller/form/wilayah-jual', [AuthSellerController::class, 'IndexWilayahJual'])->name('WilayahJualIndex');
Route::post('/register/seller/form/wilayah-jual', [AuthSellerController::class, 'StoreWilayahJual'])->name('WilayahJual-Store');


//uploadfile
Route::get('/register/seller/form/upload', [FileUploadController::class, 'index'])->name('uploadFiles');
Route::post('/register/seller/form/upload', [FileUploadController::class, 'store'])->name('uploadForm');
Route::post('/delete-file/{key}', 'Seller\FileUploadController@deleteFile')->name('deleteFile');


//test mail 
Route::get('/send-mail', [SendMailController::class, 'index']);


