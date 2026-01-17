@extends('admin.layouts.app')

@section('content')

<div style="padding: 20px; box-sizing: border-box;">
    
    <a href="{{ route('admin.transactions.index') }}" style="text-decoration: none; color: #8b0000; font-weight: bold; margin-bottom: 15px; display: inline-block;">
        ← Kembali ke Daftar
    </a>

    <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1); border: 1px solid #eee;">
        
        <div style="background: #8b0000; color: white; padding: 25px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h4 style="margin: 0; font-size: 14px; text-transform: uppercase; opacity: 0.9;">Detail Penjualan</h4>
                <h2 style="margin: 5px 0 0 0; font-size: 22px;">{{ $transaction->invoice_number }}</h2>
            </div>
            <div style="text-align: right;">
                <p style="margin: 0; font-size: 13px;">Total Pembayaran</p>
                <h2 style="margin: 0; font-size: 28px; color: #ffcc00;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div style="padding: 20px;">
            <div style="margin-bottom: 20px; color: #666; font-size: 14px;">
                <strong>Tanggal:</strong> {{ $transaction->created_at->format('d/m/Y') }} | <strong>Waktu:</strong> {{ $transaction->created_at->format('H:i') }} WIB
            </div>

            <table style="width: 100%; border-collapse: collapse; min-width: 500px;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #8b0000;">
                        <th style="padding: 12px 5px; color: #8b0000; font-size: 13px;">PRODUK</th>
                        <th style="padding: 12px 5px; color: #8b0000; font-size: 13px; text-align: right;">HARGA</th>
                        <th style="padding: 12px 5px; color: #8b0000; font-size: 13px; text-align: center;">QTY</th>
                        <th style="padding: 12px 5px; color: #8b0000; font-size: 13px; text-align: right;">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->items as $item)
                    <tr style="border-bottom: 1px solid #f2f2f2;">
                        <td style="padding: 15px 5px;">
                            <div style="font-weight: bold; color: #333;">{{ $item->product->name }}</div>
                            <div style="display: inline-block; padding: 2px 8px; background: #fff5f5; border: 1px solid #ffcccc; color: #8b0000; border-radius: 4px; font-size: 11px; margin-top: 5px; font-weight: bold;">
                                📦 SISA STOK GUDANG: {{ $item->product->stock }}
                            </div>
                        </td>
                        <td style="padding: 15px 5px; text-align: right;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td style="padding: 15px 5px; text-align: center; font-weight: bold;">{{ $item->qty }}</td>
                        <td style="padding: 15px 5px; text-align: right; font-weight: bold; color: #8b0000;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 25px; text-align: right; padding-top: 15px; border-top: 2px solid #8b0000;">
                <span style="font-size: 16px; color: #777;">Grand Total:</span>
                <span style="font-size: 24px; font-weight: 800; color: #8b0000; margin-left: 15px;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection