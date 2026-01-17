<?php

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller;
use App\Models\Product; 
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon; 
class KasirController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        return view('users.index', compact('products'));
    }

    public function riwayat()
    {
        // 1. Filter transaksi: Hanya yang dibuat HARI INI saja
        $transactions = Transaction::whereDate('created_at', Carbon::today())
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 2. Hitung Total Pendapatan HARI INI
        $totalPendapatan = Transaction::whereDate('created_at', Carbon::today())
                            ->sum('total');

        // 3. Hitung Jumlah Transaksi HARI INI
        $jumlahTransaksi = Transaction::whereDate('created_at', Carbon::today())
                            ->count();

        // Kirim semua variabel ke halaman riwayat
        return view('users.riwayat', compact('transactions', 'totalPendapatan', 'jumlahTransaksi'));
    }

    public function pembayaran()
    {
        // Mengambil ID dari session transaksi terakhir
        $transactionId = session('last_transaction_id');
        
        // Cari data transaksi beserta detail itemnya
        $transaction = Transaction::with('items.product')->find($transactionId);

        if (!$transaction) {
            return redirect()->route('users.index')->with('error', 'Silakan belanja dulu!');
        }

        return view('users.pembayaran', compact('transaction'));
    }
}