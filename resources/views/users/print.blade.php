<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            padding: 40px 20px;
            background: linear-gradient(135deg, #fff8e7 0%, #fff0d2 100%);
            min-height: 100vh;
        }

        .page-header {
            text-align: center;
            margin-bottom: 32px;
            animation: fadeInDown 0.6s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-title {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #642714;
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 14px;
            color: #af9b74;
            font-weight: 500;
        }

        .receipt-container {
            max-width: 380px;
            margin: 0 auto;
            background: white;
            padding: 0;
            box-shadow: 0 10px 40px rgba(100, 39, 20, 0.15);
            border-radius: 16px;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
            position: relative;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Decorative Top */
        .receipt-top-decor {
            height: 8px;
            background: linear-gradient(90deg, #642714 0%, #ec9105 50%, #642714 100%);
        }

        /* Receipt Header */
        .receipt-header {
            text-align: center;
            padding: 28px 24px 24px;
            background: linear-gradient(135deg, #642714 0%, #4a1d0f 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .receipt-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shimmer 8s infinite linear;
        }

        @keyframes shimmer {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .store-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ec9105 0%, #d17f04 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: white;
            box-shadow: 0 4px 16px rgba(236, 145, 5, 0.4);
        }

        .store-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
            letter-spacing: 2px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .store-info {
            font-size: 11px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .store-info i {
            color: #ec9105;
            margin-right: 4px;
        }

        /* Decorative Wave */
        .wave-divider {
            height: 20px;
            background: white;
            position: relative;
            margin-top: -1px;
        }

        .wave-divider::before {
            content: '';
            position: absolute;
            top: -19px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 0 0 50% 50%;
        }

        /* Receipt Body */
        .receipt-body {
            padding: 24px;
        }

        /* Transaction Info */
        .receipt-info {
            background: linear-gradient(135deg, #fdfaf5 0%, #fff8ed 100%);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid #f3e5cc;
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e5e7eb;
        }

        .info-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #ec9105 0%, #d17f04 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .info-title {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #642714;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 8px;
            padding: 0 4px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #6b7280;
            font-weight: 600;
        }

        .info-value {
            font-weight: bold;
            color: #642714;
        }

        .trx-id {
            color: #ec9105;
            font-family: 'Courier New', monospace;
            font-size: 13px;
        }

        /* Items Section */
        .items-section {
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f3e5cc;
        }

        .section-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #fef8ed 0%, #fdf3e0 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ec9105;
            font-size: 14px;
        }

        .section-title {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #642714;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .item-row {
            font-size: 12px;
            margin-bottom: 16px;
            padding: 16px;
            background: #fafafa;
            border-radius: 10px;
            border-left: 3px solid #ec9105;
            transition: all 0.3s ease;
        }

        .item-row:hover {
            background: #fff8ed;
            transform: translateX(4px);
        }

        .item-row:last-child {
            margin-bottom: 0;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 8px;
            color: #642714;
            font-size: 13px;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            color: #6b7280;
            font-size: 11px;
        }

        .item-qty {
            font-weight: 600;
        }

        .item-subtotal {
            font-weight: bold;
            color: #ec9105;
        }

        /* Total Section */
        .total-section {
            background: linear-gradient(135deg, #642714 0%, #4a1d0f 100%);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .total-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        }

        .total-content {
            position: relative;
            z-index: 1;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .total-row:last-child {
            margin-bottom: 0;
        }

        .total-label {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
        }

        .total-value {
            font-weight: bold;
        }

        .grand-total-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin: 16px 0;
        }

        .total-row.grand-total {
            font-size: 18px;
            font-weight: bold;
        }

        .total-row.grand-total .total-label {
            color: white;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .total-row.grand-total .total-value {
            color: #ec9105;
            font-size: 22px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 12px;
            border: 1px solid #6ee7b7;
        }

        .status-icon {
            width: 8px;
            height: 8px;
            background: #059669;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        /* Receipt Footer */
        .receipt-footer {
            text-align: center;
            padding: 20px 24px;
            background: #fdfaf5;
            border-top: 1px dashed #e5e7eb;
        }

        .thank-you {
            font-weight: bold;
            margin-bottom: 12px;
            font-size: 16px;
            color: #642714;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .thank-you i {
            color: #ec9105;
            font-size: 20px;
        }

        .footer-text {
            font-size: 11px;
            line-height: 1.6;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .footer-divider {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ec9105, transparent);
            margin: 12px auto;
        }

        .website {
            font-size: 12px;
            color: #ec9105;
            font-weight: 600;
        }

        /* Decorative Bottom */
        .receipt-bottom-decor {
            height: 8px;
            background: linear-gradient(90deg, #642714 0%, #ec9105 50%, #642714 100%);
        }

        /* Action Buttons */
        .action-buttons {
            text-align: center;
            margin: 32px auto;
            display: flex;
            gap: 12px;
            max-width: 380px;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .btn {
            flex: 1;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', -apple-system, sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-print {
            background: linear-gradient(135deg, #ec9105 0%, #d17f04 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(236, 145, 5, 0.3);
        }

        .btn-print:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(236, 145, 5, 0.4);
        }

        .btn-back {
            background: white;
            color: #642714;
            border: 2px solid #f3e5cc;
            box-shadow: 0 4px 12px rgba(100, 39, 20, 0.1);
        }

        .btn-back:hover {
            background: #fdfaf5;
            border-color: #ec9105;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(100, 39, 20, 0.15);
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .page-header,
            .action-buttons {
                display: none;
            }

            .receipt-container {
                box-shadow: none;
                max-width: 100%;
                border-radius: 0;
            }

            .receipt-top-decor,
            .receipt-bottom-decor {
                display: none;
            }

            .item-row:hover {
                background: #fafafa;
                transform: none;
            }
        }

        @page {
            size: 80mm auto;
            margin: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 480px) {
            body {
                padding: 20px 16px;
            }

            .receipt-container {
                max-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
                max-width: 100%;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 class="page-title">Struk Pembayaran</h1>
        <p class="page-subtitle">Simpan atau cetak struk sebagai bukti transaksi</p>
    </div>

    <div class="receipt-container">
        <!-- Top Decoration -->
        <div class="receipt-top-decor"></div>

        <!-- Receipt Header -->
        <div class="receipt-header">
            <div class="header-content">
                <div class="store-logo">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="store-name">SEMBAKOKU</div>
                <div class="store-info">
                    <div><i class="fa-solid fa-location-dot"></i> Jl. Nginden Senolo No. 23, Surabaya</div>
                    <div><i class="fa-solid fa-phone"></i> (+62) 1234-5678</div>
                    <div><i class="fa-solid fa-envelope"></i> info@sembakoku.com</div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="wave-divider"></div>

        <!-- Receipt Body -->
        <div class="receipt-body">
            <!-- Transaction Info -->
            <div class="receipt-info">
                <div class="info-header">
                    <div class="info-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div class="info-title">Informasi Transaksi</div>
                </div>
                
                <div class="info-row">
                    <span class="info-label">No. Transaksi</span>
                    <span class="info-value trx-id">#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ $transaction->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Waktu</span>
                    <span class="info-value">{{ $transaction->created_at->format('H:i:s') }} WIB</span>
                </div>
                {{-- <div class="info-row">
                    <span class="info-label">Kasir</span>
                    <span class="info-value">{{ $transaction->user->name ?? 'Admin' }}</span>
                </div> --}}
                
                <div class="status-badge">
                    <span class="status-icon"></span>
                    <span>Pembayaran Berhasil</span>
                </div>
            </div>

            <!-- Items Section -->
            <div class="items-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fa-solid fa-shopping-cart"></i>
                    </div>
                    <div class="section-title">Detail Pembelian</div>
                </div>

                @foreach($transaction->items as $item)
                <div class="item-row">
                    <div class="item-name">{{ $item->product->name }}</div>
                    <div class="item-detail">
                        <span class="item-qty">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        <span class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total Section -->
            <div class="total-section">
                <div class="total-content">
                    <div class="total-row">
                        <span class="total-label">Subtotal</span>
                        <span class="total-value">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">PPN (0%)</span>
                        <span class="total-value">Rp 0</span>
                    </div>
                    
                    <div class="grand-total-divider"></div>
                    
                    <div class="total-row grand-total">
                        <span class="total-label">Total Bayar</span>
                        <span class="total-value">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipt Footer -->
        <div class="receipt-footer">
            <div class="thank-you">
                {{-- <i class="fa-solid fa-heart"></i> --}}
                <span>TERIMA KASIH</span>
                {{-- <i class="fa-solid fa-heart"></i> --}}
            </div>
            
            <div class="footer-text">
                Barang yang sudah dibeli<br>tidak dapat ditukar atau dikembalikan
            </div>
            
            <div class="footer-divider"></div>
            
            <div class="website">
                <i class="fa-solid fa-globe"></i> www.sembakoku.com
            </div>
        </div>

        <!-- Bottom Decoration -->
        <div class="receipt-bottom-decor"></div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button class="btn btn-print" onclick="window.print()">
            <i class="fa-solid fa-print"></i>
            <span>Cetak Struk</span>
        </button>
        <a href="{{ route('users.riwayat') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <script>
        // Optional: Auto print on page load
        // window.onload = function() { 
        //     setTimeout(() => {
        //         window.print(); 
        //     }, 500);
        // }

        // Add animation on load
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.item-row');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                item.style.transition = 'all 0.4s ease-out';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>