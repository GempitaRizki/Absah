<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\CartController;
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
use App\Http\Controllers\Seller\partials\DownloadFormatController;
use App\Http\Controllers\User\OrderUserController;
use App\Http\Controllers\User\LoginUserController;
use App\Http\Controllers\Seller\ParentSellerController;
use App\Http\Controllers\Seller\UserProfileController;
use App\Http\Controllers\Seller\WizardController;
use App\Http\Controllers\User\ProductDetailController;;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/product/cart', [CartController::class, 'index'])->name('cart.Index');


//menampilkan gambar pertama pada database
Route::get('image/{id}', [ImageController::class, 'show']);


Route::get('/product/{slug}', [ProductDetailController::class, 'index'])->name('product.detail');


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
    Route::get('/user/order', [OrderUserController::class, 'index'])->name('order.user');

    //keranjang

    Route::get('/user/komplain', [KomplainSellerController::class, 'index'])->name('komplain.user');
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
Route::get('/error/500', [HandleErrorController::class, 'codeError'])->name('syntaxError');

//store add db 
Route::post('/save-and-continue', [AuthSellerController::class, 'store'])->name('saveAndContinue');


//seller login controller
Route::get('/seller/login', [SellerController::class, 'index'])->name('seller.login');
Route::post('/seller/login', [SellerController::class, 'login'])->name('seller-post');
Route::post('/seller/logout', [SellerController::class, 'logout'])->name('seller.logout');

//user Login Controller
Route::get('/user/login', [LoginUserController::class, 'index'])->name('user.login');
Route::post('/user/login', [LoginUserController::class, 'login'])->name('user.login.store');


Route::get('/user/dashboard', [LoginUserController::class, 'DashoardUser'])->name('Dashboard.User');
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


    //wizard view
    Route::get('/wizard', [WizardController::class, 'index']);


    Route::get('/product', [ProductSellerController::class, 'index'])->name('product.index');
    Route::get('/product/info-awal', [ProductSellerController::class, 'indexinfo'])->name('index-awal');
    Route::post('product/info-awal', [ProductSellerController::class, 'indexInfoStore'])->name('store-index-awal');
    Route::get('/price', [ProductSellerController::class, 'indexPrice'])->name('IndexPrice');
    Route::post('product-prices/store', [ProductSellerController::class, 'storePrice'])->name('product-prices.store');
    Route::get('/fileupload', [ProductSellerController::class, 'uploadFile'])->name('product-upload-file');

    //info umum 

    // routes/web.php

    Route::get('/get-sub-categories', [ParentSellerController::class, 'getSubCategories'])->name('get-sub-categories');
    Route::get('/get-sub-category-satu', [ParentSellerController::class, 'getSubCategorySatu'])->name('get-sub-categories-satu');
    Route::get('/get-sub-category-dua', [ParentSellerController::class, 'getSubCategoryDua'])->name('get-sub-categories-dua');
    Route::get('/get-sub-category-tiga', [ParentSellerController::class, 'getSubCategoryTiga'])->name('get-sub-categories-tiga');
    Route::get('/get-sub-category-empat', [ParentSellerController::class, 'getSubCategoryEmpat'])->name('get-sub-categories-empat');
    Route::get('/get-sub-category-lima', [ParentSellerController::class, 'getSubCategoryLima'])->name('get-sub-categories-lima');
    Route::get('/get-sub-category-enam', [ParentSellerController::class, 'getSubCategoryEnam'])->name('get-sub-categories-enam');


    Route::get('/showindexumum', [ProductSellerController::class, 'showindexumum'])->name('getInfoUmum');
    Route::get('/getTipeKategori', [ProductSellerController::class, 'getTipeKategori']);
    Route::get('/getKategoriByType', [ProductSellerController::class, 'getCategoriesByType']);
    Route::post('/store-product', [ProductSellerController::class, 'storeProductData'])->name('store-product');
    Route::get('/variant', [ProductSellerController::class, 'showindexVariant'])->name('IndexVariant');


    //product navbar download 
    Route::get('/product/downloadtemplate', [DownloadFormatController::class, 'index'])->name('downloadtemplate');
    Route::get('/download-template/{type}', [DownloadFormatController::class, 'download'])->name('download');

    //Upload view on wizard
    Route::get('/upload', [ProductSellerController::class, 'indexFileUpload'])->name('upload.index');
    Route::post('/upload-file', [ProductSellerController::class, 'uploadFile'])
        ->name('upload-file');
    //summary 
    Route::get('/product/pubish', [ProductSellerController::class, 'SummaryProduct'])->name('summary.publish');

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


    //profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
});
