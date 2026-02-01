<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahkan ini
use App\Models\Product;             // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menyuntikkan variabel $unreadCount ke sidebar secara otomatis
        View::composer('users.layout.sidebar', function ($view) {
            // Kita hitung produk yang kolom diskonnya lebih dari 0
            $unreadCount = Product::where('discount', '>', 0)->count();
            
            $view->with('unreadCount', $unreadCount);
        });
    }
}