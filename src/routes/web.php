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

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');

Route::get('/products/register', [ProductsController::class, 'create'])->name('products.register');

Route::get('/products/{productId}', [ProductsController::class, 'show'])->name('products.show');
Route::put('/products/{productId}', [ProductsController::class, 'update'])->name('products.update');

Route::delete('/products/{productId}/delete', [ProductsController::class, 'destroy'])->name('products.delete');
