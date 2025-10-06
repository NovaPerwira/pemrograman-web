<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Route ini akan menghasilkan URL seperti /products, /products/create, dll.
Route::resource('products', ProductController::class);
Route::get('/', [ProductController::class, 'index'])->name('products.index');
