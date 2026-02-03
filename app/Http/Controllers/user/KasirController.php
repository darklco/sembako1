<?php

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller;
use App\Models\Product; 
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;
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


public function storeTransaction(Request $request)
{
    $items = $request->input('items'); // [{product_id, qty}, ...]

    if (!$items || count($items) === 0) {
        return response()->json(['message' => 'Keranjang kosong!'], 422);
    }

    DB::beginTransaction();

    try {
        $total = 0;
        $transaction = Transaction::create([
            'invoice_number' => 'INV'.time(),
            'total' => 0, // nanti diupdate
        ]);

        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) continue;

            $qty = $item['qty'];
            $price = $product->final_price; // pakai final_price otomatis
            $subtotal = $price * $qty;
            $total += $subtotal;

            // Kurangi stock
            $product->stock -= $qty;
            $product->save();

            // Simpan detail transaksi
            $transaction->items()->create([
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
            ]);
        }

        $transaction->update(['total' => $total]);

        DB::commit();

        // Simpan ke session untuk halaman pembayaran
        session(['last_transaction_id' => $transaction->id]);

        return response()->json(['success' => true, 'total' => $total]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => $e->getMessage()], 500);
    }
}

}