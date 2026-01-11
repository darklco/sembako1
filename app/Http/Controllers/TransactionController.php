<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $total = 0;

        DB::beginTransaction();

        try {
            foreach ($request->items as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                // Cek stok
                if ($product->stock < $item['qty']) {
                    throw new \Exception("the item {$product->name} is out of stock");
                }

                // Hitung subtotal
                $subtotal = $product->price * $item['qty'];
                $total += $subtotal;

                // Kurangi stok
                $product->stock -= $item['qty'];
                $product->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Transaction successful',
                'total_belanja' => $total
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Transaction failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
