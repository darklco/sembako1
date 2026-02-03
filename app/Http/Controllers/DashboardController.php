<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStock = Product::where('stock', '<=', 5)->count();
        $totalTransactions = Transaction::count();

        // Ambil data 7 hari terakhir
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Query untuk split barang sendiri vs titipan
        $salesData = DB::table('transactions')
            ->join('transaction_items', 'transactions.id', '=', 'transaction_items.transaction_id')
            ->join('products', 'transaction_items.product_id', '=', 'products.id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(transactions.created_at) as date'),
                DB::raw('SUM(CASE WHEN products.is_consignment = 0 THEN transaction_items.subtotal ELSE 0 END) as total_own'),
                DB::raw('SUM(CASE WHEN products.is_consignment = 1 THEN transaction_items.subtotal ELSE 0 END) as total_consignment')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan array untuk 7 hari (termasuk yang kosong)
        $labels = [];
        $totalsOwn = [];
        $totalsConsignment = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('d M');
            
            $dayData = $salesData->firstWhere('date', $date);
            $totalsOwn[] = $dayData ? (float) $dayData->total_own : 0;
            $totalsConsignment[] = $dayData ? (float) $dayData->total_consignment : 0;
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'lowStock',
            'totalTransactions',
            'labels',
            'totalsOwn',
            'totalsConsignment'
        ));
    }
}