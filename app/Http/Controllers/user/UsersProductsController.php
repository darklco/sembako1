<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class UsersProductsController extends Controller
{
    /**
     * Menampilkan semua produk (READ ONLY)
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('users.products', compact('products'));
    }

    /**
     * Menampilkan detail satu produk
     */
    public function show(Product $product)
    {   
        return view('users.showproducts', compact('product'));
    }
}
