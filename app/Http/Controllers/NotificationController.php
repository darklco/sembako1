<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Product;

class NotificationController extends Controller
{
    public function index()
    {
        
        Notification::where('is_read', false)->update(['is_read' => true]);

        $notifications = Product::where('discount', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('users.notification', compact('notifications'));
    }
}