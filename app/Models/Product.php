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
        'stock',
        'image'
    ];

    public function show(Product $product)
    {
        return view('users.productsshow', compact('product'));
    }
}
