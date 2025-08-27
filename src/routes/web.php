<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

// 商品検索だけリソース外にあるなら、個別に記述
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// これが全CRUDのルーティングを一括で定義してくれます
Route::resource('products', ProductController::class);

