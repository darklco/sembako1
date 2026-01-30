<?php

namespace App\Http\Controllers;

use App\Models\Product;

class NotificationController extends Controller
{
    public function index()
    {
        // ambil produk yang punya diskon
        $notifications = Product::where('discount', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('users.notification', compact('notifications'));
    }
}
