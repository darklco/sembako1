<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // UNTUK ADMIN: Bisa lihat semua & pilih tanggal
    public function index(Request $request) 
    {
        $query = Transaction::query();

        // Fitur Kalender: Memproses filter jika Admin memilih tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->latest()->paginate(15);
        return view('admin.transaction', compact('transactions'));
    }

    // UNTUK KASIR: Otomatis reset setiap hari (hanya tampil hari ini)
    public function riwayatKasir()
    {
        // Logika: Ambil data yang HANYA dibuat tanggal hari ini
       $transactions = Transaction::whereDate('created_at', Carbon::today())
                        ->latest()
                        ->get();

        $totalPendapatan = $transactions->sum('total');
        $jumlahTransaksi = $transactions->count();

        return view('users.riwayat', compact('transactions', 'totalPendapatan', 'jumlahTransaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . now()->format('YmdHis'),
                'total' => 0,
            ]);

            foreach ($request->items as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok {$product->name} tidak cukup");
                }

                $subtotal = $product->price * $item['qty'];
                $total += $subtotal;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $item['qty']);
            }

            $transaction->update(['total' => $total]);

            DB::commit();
            session(['last_transaction_id' => $transaction->id]);

            return response()->json([
                'message' => 'Transaction successful',
                'invoice' => $transaction->invoice_number,
                'total' => $total,
                'redirect_url' => route('users.pembayaran')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Transaction failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('items.product');
        return view('admin.showtransaction', compact('transaction'));
    }

    /**
     * Display transaction detail for users
     */
   public function detail($id)
    {
        $transaction = Transaction::with(['items.product'])
            ->findOrFail($id);

        return view('users.detail', compact('transaction'));
    }

    /**
     * Print receipt
     */
    public function print($id)
    {
        $transaction = Transaction::with(['items.product'])
            ->findOrFail($id);

        return view('users.print', compact('transaction'));
    }

}