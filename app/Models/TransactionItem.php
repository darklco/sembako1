<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 
        'product_id', 
        'qty', 
        'price', 
        'subtotal'
    ];

    /**
     * Relasi ke produk (opsional tapi berguna)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}