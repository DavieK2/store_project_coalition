<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('products.index', ['products' => Product::orderBy('created_at', 'desc')->get() ]) );


Route::controller(ProductController::class)->group( function(){

    Route::post('/product/create', 'store');
    Route::post('/product/update/{product}', 'update');
    Route::get('/products', 'getProducts');

});
