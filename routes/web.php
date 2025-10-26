<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Route ini akan menghasilkan URL seperti /products, /products/create, dll.

Route::get('/', function() {
    return view('welcome');
});

Route::get('/product', function() {
    return view('product');
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/tetris', function() {
    return view('tetris');
});

Route::get('minecraft', function() {
    return view('minecraft');
});

Route::get('/latihan2/{nama}', function($nama) {
    echo "nama saya adalah " . $nama;
});

Route::get('/nova', function () {
    return view('novaular');
});

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/test-view-data', function() {
    $nama = "nova";
    $alamat = "tabanan";

    return view('view_data', compact('nama', 'alamat'));
});