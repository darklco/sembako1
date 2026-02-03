<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'stock',
        'image',
        'is_consignment',
        'original_price',
        'profit',
    ];

    public function show(Product $product)
    {
        return view('users.productsshow', compact('product'));
    }

     public function getFinalPriceAttribute()
    {
        if ($this->is_consignment) {
            // Harga konsinyasi = original_price + profit
            return $this->original_price + $this->profit;
        }

        // Harga biasa
        return $this->price - ($this->price * $this->discount / 100);
    }
}
