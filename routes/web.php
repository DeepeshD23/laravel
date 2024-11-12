<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route ::get('/product',[ProductController::class,'index'])-> name('products.index');
Route ::get('/product/create',[ProductController::class,'create'])-> name('products.create');
Route ::post('/product',[ProductController::class,'store'])-> name('products.store');
Route ::get('/product/{product}/edit',[ProductController::class,'edit'])-> name('products.edit');
Route ::put('/product/{product}',[ProductController::class,'update'])-> name('products.update');
Route ::post('/product/{product}',[ProductController::class,'destroy'])-> name('products.destroy');

// Route::controller(ProductController::class)->group(function(){
//     Route ::get ('/product','index')-> name('products.index');
//     Route ::get ('/product/create','create')-> name('products.create');
//     Route ::post ('/product','store')-> name('products.store');
//     Route ::get ('/product/{product}/edit','edit')-> name('products.edit');
//     Route ::put ('/product/{product}','update')-> name('products.update');
//     Route ::delete ('/product/{product}','destroy')-> name('products.destroy');

// });
