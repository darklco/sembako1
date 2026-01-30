<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // READ
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    // FORM CREATE
    public function create()
    {
        return view('admin.products.create');
    }

    // CREATE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
            'discount' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');

            if (!empty($data['discount']) && $data['discount'] > 0) {
            $data['discount'] = now();
        }
    }

    // FORM EDIT
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
             'discount' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diupdate');

            if (
                isset($data['discount']) &&
                $data['discount'] > 0 &&
                $product->discount != $data['discount']
            ) {
                $data['discount'] = now();
            }

    }

    // DELETE
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
