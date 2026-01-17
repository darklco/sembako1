<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalProducts = Product::count();
        $lowStock = Product::where('stock', '<=', 5)->count();
        $totalTransactions = Transaction::count();

        
        $salesData = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total') 
        )
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $labels = $salesData->pluck('date');
        $totals = $salesData->pluck('total');

        return view('admin.dashboard', compact(
            'totalProducts', 
            'lowStock', 
            'totalTransactions', 
            'labels', 
            'totals'
        ));
    }
}