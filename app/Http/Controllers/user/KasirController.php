<?php

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller;
use App\Models\Product; 
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        
        $products = Product::all(); 
        
       
        return view('users.index', compact('products'));
    }

    public function riwayat()
    {
        return view('users.riwayat');
    }

    public function pembayaran()
    {
        return view('users.pembayaran');
    }
}