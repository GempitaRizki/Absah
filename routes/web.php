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
use App\Http\Controllers\Auth\Login\SellerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Error\HandleErrorController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Seller\AktivitasPenggunaSellerController;
use App\Http\Controllers\Seller\AuthSellerController;
use App\Http\Controllers\seller\DashboardSellerController;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\Seller\OrderSellerController;
use App\Http\Controllers\Seller\PembayaranSellerController;
use App\Http\Controllers\Seller\PajakSellerController;
use App\Http\Controllers\Seller\ProductSellerController;
use App\Http\Controllers\Seller\NegoSellerController;
use App\Http\Controllers\Seller\ChatSellerController;
use App\Http\Controllers\Seller\DaftarPenggunaSellerController;
use App\Http\Controllers\Seller\KomplainSellerController;
use App\Http\Controllers\Seller\DummySellerController;
use App\Http\Controllers\Seller\partials\DownloadFormatController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\LoginUserController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');


//Route Keranjang
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/carts', [CartController::class, 'index'])->name('cart.show');
    Route::get('/carts/remove/{itemId}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::post('/cart/store/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/carts', [CartController::class, 'update'])->name('cart.update');
    Route::post('update-to-cart', [CartController::class, 'updatetocart'])->name('updatetocart');
    Route::get('/mini-cart', [CartController::class, 'show'])->name('mini_cart.show');
    Route::get('carts/remove', [CartController::class, 'destroyAll'])->name('cart.destroy-all');

    //dashboard user
    Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('dashboard.user');
});

//menampilkan gambar pertama pada database
Route::get('image/{id}', [ImageController::class, 'show']);


//product Controller dari user / Di definisikan sebagai ControllersProductController // 05/09/2023 change to UserControllerProduct
Route::controller(ProductUserController::class)->group(function () {
    Route::get('/products', [ProductUserController::class, 'index']);
    Route::get('/product/{slug}', [ProductUserController::class, 'show']);
    Route::get('/products/quick-view/{slug}', [ProductUserController::class, 'quickView']);
});


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
    //user control

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

Auth::routes();

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
Route::get('/register/buyer/info-sekolah/form', [AuthUserController::class, 'indexForm'])->name('index.form');

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
Route::get('/register/seller/form/upload', [AuthSellerController::class, 'indexUpload'])->name('uploadFiles');
Route::post('/register/seller/form/upload', [AuthSellerController::class, 'uploadFileStore'])->name('uploadForm');
Route::post('/delete-file/{key}', [AuthSellerController::class, 'DeleteFile'])->name('deleteFile');

//handle error 
Route::get('/error/404', [HandleErrorController::class, 'index404'])->name('handle404');
Route::get('/error/403', [HandleErrorController::class, 'index403'])->name('handle403');


//store add db 
Route::post('/save-and-continue', [AuthSellerController::class, 'store'])->name('saveAndContinue');


//seller login controller
Route::get('/seller/login', [SellerController::class, 'index'])->name('seller.login');
Route::post('/seller/login', [SellerController::class, 'login'])->name('seller-post');
Route::post('/seller/logout', [SellerController::class, 'logout'])->name('seller.logout');

//user Login Controller
Route::get('/user/login', [LoginUserController::class, 'index'])->name('user.login');

//Seller Content Management System
Route::middleware(['auth', 'activity.logger', 'role:seller'])->namespace('Seller')->prefix('seller')->group(function () {

    Route::get('/dashboard', [DashboardSellerController::class, 'index'])->name('seller.dashboard');


    //order
    Route::get('/order', [OrderSellerController::class, 'index'])->name('order.index');


    //pembayaran 
    Route::get('/pembayaran', [PembayaranSellerController::class, 'index'])->name('pembayaran.index');


    //pajak
    Route::get('/pajak', [PajakSellerController::class, 'index'])->name('pajak.index');
    Route::post('/pajak', [PajakSellerController::class, 'store'])->name('store-pajak');

    //product
    Route::get('/product', [ProductSellerController::class, 'index'])->name('product.index');
    Route::get('/product/info-awal', [ProductSellerController::class, 'indexinfo'])->name('index-awal');
    Route::post('product/info-awal', [ProductSellerController::class, 'indexInfoStore'])->name('store-index-awal');

    //info umum 
    // routes/web.php
    // routes/web.php

    Route::get('/get-sub-categories', [ProductSellerController::class, 'getSubCategories'])->name('get-sub-categories');
    Route::get('/get-sub-category-satu', [ProductSellerController::class, 'getSubCategorySatu'])->name('get-sub-categories-satu');
    Route::get('/get-sub-category-dua', [ProductSellerController::class, 'getSubCategoryDua'])->name('get-sub-categories-dua');
    Route::get('/get-sub-category-tiga', [ProductSellerController::class, 'getSubCategoryTiga'])->name('get-sub-categories-tiga');
    Route::get('/get-sub-category-empat', [ProductSellerController::class, 'getSubCategoryEmpat'])->name('get-sub-categories-empat');
    Route::get('/get-sub-category-lima', [ProductSellerController::class, 'getSubCategoryLima'])->name('get-sub-categories-lima');
    Route::get('/get-sub-category-enam', [ProductSellerController::class, 'getSubCategoryEnam'])->name('get-sub-categories-enam');


    Route::get('/showindexumum', [ProductSellerController::class, 'showindexumum'])->name('getInfoUmum');
    Route::get('/getTipeKategori', [ProductSellerController::class, 'getTipeKategori']);
    Route::get('/getKategoriByType', [ProductSellerController::class, 'getCategoriesByType']);
    Route::post('/save-info-umum', [ProductSellerController::class, 'saveInfoUmum'])->name('save_info_umum');
    //product navbar download 
    Route::get('/product/downloadtemplate', [DownloadFormatController::class, 'index'])->name('downloadtemplate');
    Route::get('/download-template/{type}', [DownloadFormatController::class, 'download'])->name('download');



    //Nego
    Route::get('/nego', [NegoSellerController::class, 'index'])->name('nego.index');

    //chat
    Route::get('/chat', [ChatSellerController::class, 'index'])->name('chat.index');


    //Komplain
    Route::get('/komplain', [KomplainSellerController::class, 'index'])->name('komplain.index');


    //daftar pengguna
    Route::get('/daftarpengguna', [DaftarPenggunaSellerController::class, 'index'])->name('daftarpengguna.index');
    Route::get('/daftarpengguna/create', [DaftarPenggunaSellerController::class, 'create'])->name('daftarpengguna.create');
    Route::post('/daftarpengguna', [DaftarPenggunaSellerController::class, 'store'])->name('daftarpengguna.store');


    //aktifitas pengguna
    Route::get('/aktivitaspengguna', [AktivitasPenggunaSellerController::class, 'index'])->name('aktivitaspengguna.index');
    Route::get('/pdf/user-activities', [AktivitasPenggunaSellerController::class, 'generatePDF'])->name('download.pdf');
});


// Route::get('mumetbanget/setan', [ControllerForTestingView::class, 'index']);

