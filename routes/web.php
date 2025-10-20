<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Route ini akan menghasilkan URL seperti /products, /products/create, dll.

Route::get('/latihan1', function() {
    return view('welcome');
});

Route::get('/tetris', function() {
    return view('tetris');
});

Route::get('minecraft', function() {
    return view('minecraft');
});
Route::resource('products', ProductController::class);
Route::get('/', [ProductController::class, 'index'])->name('index');

Route::get('/latihan2/{nama}', function($nama) {
    echo "nama saya adalah " . $nama;
});

Route::get('/yoyokularcobra', function () {
    return view('yoyok');
});

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/test-view-data', function() {
    $nama = "yoyok";
    $alamat = "tabanan";

    return view('view_data', compact('nama', 'alamat'));
});