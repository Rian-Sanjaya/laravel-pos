<?php

use App\Http\Controllers\CategoryContoller;
use App\Http\Controllers\ProductContoller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', fn() => redirect()->route('login'));

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/kategori/data', 'App\Http\Controllers\CategoryController@data')->name('kategori.data');
    // Route::get('/kategori', 'App\Http\Controllers\CategoryController@index')->name('kategori.index');
    Route::resource('/kategori', 'App\Http\Controllers\CategoryController');

    Route::get('/produk/data', 'App\Http\Controllers\ProductController@data')->name('produk.data');
    Route::post('/produk/delete-selected', 'App\Http\Controllers\ProductController@deleteSelected')->name('produk.delete_selected');
    Route::post('/produk/cetak-barcode', 'App\Http\Controllers\ProductController@cetakBarcode')->name('produk.cetak_barcode');
    Route::resource('/produk', 'App\Http\Controllers\ProductController');
});
