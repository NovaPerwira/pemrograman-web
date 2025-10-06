<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // READ: Menampilkan semua produk
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'));
    }

    // CREATE: Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('products.create');
    }

    // CREATE: Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'price' => 'required|numeric']);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat.');
    }

    // UPDATE: Menampilkan form untuk mengedit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // UPDATE: Memperbarui produk di database
    public function update(Request $request, Product $product)
    {
        $request->validate(['name' => 'required', 'price' => 'required|numeric']);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // DELETE: Menghapus produk dari database
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
   