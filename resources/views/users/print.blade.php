<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #TRX-{{ $transaction->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            padding: 20px;
            background: #f5f5f5;
        }

        .receipt-container {
            max-width: 320px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .store-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .store-info {
            font-size: 11px;
            line-height: 1.5;
        }

        .receipt-info {
            font-size: 11px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #000;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .items-section {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #000;
        }

        .item-row {
            font-size: 11px;
            margin-bottom: 8px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            padding-left: 10px;
        }

        .total-section {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #000;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .total-row.grand-total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #000;
        }

        .receipt-footer {
            text-align: center;
            font-size: 11px;
            line-height: 1.6;
        }

        .thank-you {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .print-button {
            text-align: center;
            margin: 20px 0;
        }

        .btn-print {
            background: #642714;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .btn-print:hover {
            background: #4a1d0f;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .receipt-container {
                box-shadow: none;
                max-width: 100%;
            }

            .print-button {
                display: none;
            }
        }

        @page {
            size: 80mm auto;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="print-button">
        <button class="btn-print" onclick="window.print()">Cetak Struk</button>
    </div>

    <div class="receipt-container">
        <div class="receipt-header">
            <div class="store-name">SEMBAKOKU</div>
            <div class="store-info">
                Jl. Nginden Senolo. 23, Surabaya<br>
                Telp: (+62) 1234-5678
            </div>
        </div>

        <div class="receipt-info">
            <div class="info-row">
                <span>No. Transaksi</span>
                <span><strong>#TRX-{{ $transaction->id }}</strong></span>
            </div>
            <div class="info-row">
                <span>Tanggal</span>
                <span>{{ $transaction->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span>Waktu</span>
                <span>{{ $transaction->created_at->format('H:i:s') }} WIB</span>
            </div>
            {{-- <div class="info-row">
                <span>Kasir</span>
                <span>{{ $transaction->user->name ?? 'Admin' }}</span>
            </div> --}}
        </div>

        <div class="items-section">
            @foreach($transaction->items as $item)
            <div class="item-row">
                <div class="item-name">{{ $item->product->name }}</div>
                <div class="item-detail">
                    <span>{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="total-section">
            <div class="total-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
            <div class="total-row grand-total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="receipt-footer">
            <div class="thank-you">TERIMA KASIH</div>
            <div>Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan</div>
            <div style="margin-top: 10px;">www.sembakoku.com</div>
        </div>
    </div>
  <div class="print-button">
    <a href="{{ route('users.riwayat') }}" class="btn-print">
        Kembali
    </a>
</div>


    <script>
        // Auto print on page load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>