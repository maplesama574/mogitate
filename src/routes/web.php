<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;


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
//不必要かもしれない↓
Route::get('/', function () {
    return view('welcome');
});

//ここからは必要
//index.blade.phpに送る
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
//新規作成
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');


//products コントローラ
Route::get('/products/{productid}', [ProductsController::class, 'index']);

//seasons　コントローラ
Route::get('/products/{productid}', [SeasonsController::class, 'index']);

//中間テーブル
Route::get('/products/{productid}', [ProductsController::class, 'index']);