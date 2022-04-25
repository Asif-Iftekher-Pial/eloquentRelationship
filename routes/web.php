<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::get('/index',[HomeController::class,'indexall'])->name('index');
route::post('/saveCategory',[CategoryController::class,'saveCategory'])->name('saveCategory');
// sub cat
route::get('subcat',[CategoryController::class,'subcat'])->name('subcat');
route::post('/savesubCategory',[CategoryController::class,'savesubCategory'])->name('savesubCategory');

// product section
route::get('/product',[ProductController::class,'product'])->name('product');
route::post('/prosave',[ProductController::class,'saveproduct'])->name('prosave');

route::get('viewproducts',[ProductController::class,'viewproducts'])->name('viewproducts');

// filters

route::get('/bycategory/{id}',[ProductController::class,'bycategory'])->name('bycategory');
route::get('/bysubcategory/{id}',[ProductController::class,'bysubcategory'])->name('bysubcategory');
route::get('/tohigher',[ProductController::class,'tohigher'])->name('tohigher');
route::get('/delete/{id}',[ProductController::class,'deleteProduct']);

