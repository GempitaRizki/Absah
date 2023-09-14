<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\CustomAuthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ValidationRegisterController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\InfoSekolahController;
use App\Http\Controllers\Spare\DataSekolahController;
use App\Http\Controllers\TestGetApiController;
//Jika ingin merubah controller yang di import dapat untuk melakukan perintah
//php artisan route:cache , php artisan route:clear dan composer dumpautoload -o 


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

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//call image storage
//? Masih Bug//01/09/2023 22:04 Done storage./ path


//Route Keranjang -> middleware harus login s
Route::group(['middleware' => 'auth'], function () {
    Route::get('/carts', [CartController::class, 'index']);
    Route::get('/carts/remove/{cartID}', [CartController::class, 'destroy']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::post('/carts/update', [CartController::class, 'update']);
    //menampilkan gambar pertama pada database
    Route::get('image/{id}', [ImageController::class, 'show']);
});

//product Controller dari user / Di definisikan sebagai ControllersProductController // 05/09/2023 change to UserControllerProduct
Route::controller(ProductUserController::class)->group(function(){
    Route::get('/products', [ProductUserController::class, 'index']);
    Route::get('/product/{slug}', [ProductUserController::class, 'show']);
    Route::get('/products/quick-view/{slug}', [ProductUserController::class, 'quickView']);
});

//custom login controller, Get request to redirect only yoo bro haha
// Route::controller(ValidationRegisterController::class)->group(function(){
//     Route::get('/register', [ValidationRegisterController::class, 'index'])->name('registerPage');
//     Route::get('/register/sekolah', [ValidationRegisterController::class, 'nextindex'])->name('registerForm');
//     Route::post('/register', [ValidationRegisterController::class, 'registerUser'])->name('register.submit');
// });
   
//Test using custom auth
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'index')->name('register.form');
    Route::get('/register/users','form')->name('register.validate');
    Route::post('/store', 'store')->name('store');
    Route::get('/register/users/info-sekolah', 'infosekolah');
});

Route::controller(DataSekolahController::class)->group(function(){
    Route::get('/register/users/info-sekolah', 'DataSekolahIndex');
    Route::post('/register/users/info-sekolah', 'store')->name('DataSekolah');
});

Route::get('optionarea', [TestGetApiController::class, 'index'])->name('optionarea');
Route::get('provinces', [TestGetApiController::class, 'provinces'])->name('provinces');
Route::get('cities', [TestGetApiController::class, 'cities'])->name('cities');
Route::get('districts', [TestGetApiController::class, 'districts'])->name('districts');
Route::get('villages', [TestGetApiController::class, 'villages'])->name('villages');


Route::post('register/users/info-sekolah', [TestGetApiController::class, 'store'])->name('saveauth');

