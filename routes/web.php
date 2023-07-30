<?php

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
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::get('categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('categories/{category}', 'CategoryController@update')->name('categories.update');
    Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

    // Product
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
