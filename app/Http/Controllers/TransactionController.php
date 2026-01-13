<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(15);
        return view('admin.transaction', compact('transactions'));
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

            return response()->json([
                'message' => 'Transaction successful',
                'invoice' => $transaction->invoice_number,
                'total' => $total
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
}