<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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

Route::get('/', function () {
    $products = Product::all();
    return view('welcome',compact('products'));
});

Route::post('/product-store',[ProductController::class,'store'])->name('product.store');
Route::post('/product-edit',[ProductController::class,'edit'])->name('product.edit');
Route::get('/product-list',[ProductController::class,'list'])->name('product.list');
Route::get('/product-delete',[ProductController::class,'delete'])->name('product.delete');

