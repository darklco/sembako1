<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Notification;
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
        // Validasi data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'is_consignment' => 'nullable|boolean',
            'original_price' => 'nullable|integer|min:0',
            'profit' => 'nullable|integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Set is_consignment to boolean
        $data['is_consignment'] = $request->has('is_consignment') ? true : false;

        // Jika barang titipan, pastikan original_price dan profit ada
        if ($data['is_consignment']) {
            // Price sudah dihitung di frontend (original_price + profit)
            // Simpan original_price dan profit
            $data['original_price'] = $request->original_price;
            $data['profit'] = $request->profit;
        } else {
            // Jika bukan barang titipan, set null
            $data['original_price'] = null;
            $data['profit'] = null;
        }

        // Create product - HANYA SEKALI!
        $product = Product::create($data);

        // Kirim notifikasi kalau ada diskon (hanya untuk barang bukan titipan)
        if (!$data['is_consignment'] && !empty($data['discount']) && $data['discount'] > 0) {
            Notification::create([
                'title' => 'Diskon Baru: ' . $product->name,
                'message' => 'Produk ' . $product->name . ' mendapat diskon ' . $product->discount . '%',
                'is_read' => false,
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'is_consignment' => 'nullable|boolean',
            'original_price' => 'nullable|integer|min:0',
            'profit' => 'nullable|integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Set is_consignment to boolean
        $data['is_consignment'] = $request->has('is_consignment') ? true : false;

        // Jika barang titipan, pastikan original_price dan profit ada
        if ($data['is_consignment']) {
            $data['original_price'] = $request->original_price;
            $data['profit'] = $request->profit;
        } else {
            $data['original_price'] = null;
            $data['profit'] = null;
        }

        // Kirim notifikasi kalau diskon berubah atau baru ditambah (hanya untuk barang bukan titipan)
        if (
            !$data['is_consignment'] &&
            isset($data['discount']) &&
            $data['discount'] > 0 &&
            $product->discount != $data['discount']
        ) {
            Notification::create([
                'title' => 'Update Diskon: ' . $product->name,
                'message' => 'Diskon produk ' . $product->name . ' diupdate menjadi ' . $data['discount'] . '%',
                'is_read' => false,
            ]);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diupdate');
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