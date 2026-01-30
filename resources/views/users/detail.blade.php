@extends('users.layout.app')

@section('title', 'Detail Transaksi')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --primary: #642714;
        --primary-dark: #4a1d0f;
        --accent: #ec9105;
        --accent-dark: #d17f04;
        --bg-cream: #fff0d2;
        --white: #ffffff;
        --text-dark: #1a1a1a;
        --text-muted: #af9b74;
        --border: #f3e5cc;
        --success: #059669;
        --success-light: #d1fae5;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #fff8e7 0%, var(--bg-cream) 100%) !important;
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
    }

    .detail-container {
        padding: 48px 40px;
        max-width: 1000px;
        margin: 0 auto;
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Back Button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: white;
        color: var(--primary);
        border: 2px solid var(--border);
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 32px;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.06);
    }

    .btn-back:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateX(-6px);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.15);
    }

    .btn-back i {
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .btn-back:hover i {
        transform: translateX(-4px);
    }

    /* Main Card */
    .detail-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(100, 39, 20, 0.1);
        overflow: hidden;
        border: 1px solid rgba(243, 229, 204, 0.5);
    }

    /* Header Section */
    .detail-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .detail-header::before {
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

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .header-left h2 {
        margin: 0 0 12px 0;
        font-size: 28px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-icon {
        width: 48px;
        height: 48px;
        background: rgba(236, 145, 5, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 24px;
    }

    .trx-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 16px;
        font-weight: 800;
        box-shadow: 0 4px 12px rgba(236, 145, 5, 0.3);
        font-family: 'Courier New', monospace;
    }

    .status-badge-large {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--success) 0%, #047857 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    /* Detail Body */
    .detail-body {
        padding: 40px;
    }

    /* Info Grid */
    .info-section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 18px;
        color: var(--primary);
        font-weight: 800;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(180deg, var(--accent), var(--accent-dark));
        border-radius: 2px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-card {
        background: linear-gradient(135deg, #fdfaf5 0%, #fff8ed 100%);
        padding: 24px;
        border-radius: 16px;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--accent), var(--accent-dark));
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(100, 39, 20, 0.1);
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 18px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(236, 145, 5, 0.15);
    }

    .info-label {
        font-size: 12px;
        color: var(--text-muted);
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 18px;
        color: var(--primary);
        font-weight: 800;
        line-height: 1.3;
    }

    .info-value.success {
        color: var(--success);
    }

    /* Items Section */
    .items-section {
        margin-bottom: 40px;
    }

    .item-list {
        background: linear-gradient(135deg, #fdfaf5 0%, #fff8ed 100%);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .item-header {
        display: grid;
        grid-template-columns: 2fr 120px 150px 150px;
        gap: 20px;
        padding: 18px 28px;
        background: white;
        border-bottom: 2px solid var(--border);
    }

    .item-header-cell {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .item-header-cell i {
        color: var(--accent);
    }

    .item-row {
        display: grid;
        grid-template-columns: 2fr 120px 150px 150px;
        gap: 20px;
        padding: 20px 28px;
        border-bottom: 1px solid rgba(243, 229, 204, 0.4);
        align-items: center;
        transition: all 0.2s ease;
    }

    .item-row:hover {
        background: white;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-name {
        font-weight: 700;
        color: var(--primary);
        font-size: 15px;
    }

    .item-qty {
        font-weight: 700;
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .qty-badge {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
    }

    .item-price, .item-subtotal {
        text-align: right;
        font-weight: 700;
        color: var(--primary);
        font-size: 15px;
    }

    .item-subtotal {
        color: var(--accent);
        font-size: 16px;
    }

    /* Summary Section */
    .summary-section {
        margin-bottom: 32px;
    }

    .summary-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 32px;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(100, 39, 20, 0.25);
    }

    .summary-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
    }

    .summary-content {
        position: relative;
        z-index: 1;
    }

    .summary-rows {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 24px;
        border-bottom: 2px dashed rgba(255, 255, 255, 0.2);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        font-weight: 600;
    }

    .summary-row-label {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .summary-row-value {
        font-weight: 700;
        color: white;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-label {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .total-amount {
        font-size: 36px;
        font-weight: 800;
        color: var(--accent);
        margin: 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        letter-spacing: -1px;
    }

    /* Action Buttons */
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .btn-action {
        padding: 18px 24px;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
    }

    .btn-action::before {
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

    .btn-action:hover::before {
        width: 400px;
        height: 400px;
    }

    .btn-action span {
        position: relative;
        z-index: 1;
    }

    .btn-print {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        box-shadow: 0 6px 20px rgba(236, 145, 5, 0.3);
    }

    .btn-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(236, 145, 5, 0.4);
    }

    .btn-share {
        background: white;
        color: var(--primary);
        border: 2px solid var(--border);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.1);
    }

    .btn-share:hover {
        background: var(--bg-cream);
        border-color: var(--accent);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(100, 39, 20, 0.15);
    }

    /* Timeline (Optional Enhancement) */
    .timeline-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px dashed var(--border);
    }

    .timeline-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
    }

    .timeline-dot {
        width: 12px;
        height: 12px;
        background: var(--success);
        border-radius: 50%;
        margin-top: 6px;
        flex-shrink: 0;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.2);
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-time {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .timeline-text {
        font-size: 14px;
        color: var(--text-dark);
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-container {
            padding: 32px 20px;
        }

        .detail-header {
            padding: 32px 24px;
        }

        .header-top {
            flex-direction: column;
            gap: 16px;
        }

        .header-left h2 {
            font-size: 24px;
        }

        .detail-body {
            padding: 32px 24px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .item-header {
            display: none;
        }

        .item-row {
            grid-template-columns: 1fr;
            gap: 12px;
            padding: 20px;
        }

        .item-qty, .item-price, .item-subtotal {
            text-align: left;
        }

        .summary-card {
            padding: 24px;
        }

        .total-amount {
            font-size: 28px;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .header-left h2 {
            font-size: 20px;
        }

        .trx-id-badge {
            font-size: 14px;
            padding: 6px 16px;
        }

        .total-amount {
            font-size: 24px;
        }
    }
</style>

<div class="detail-container">
    <a href="{{ route('users.riwayat') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Riwayat</span>
    </a>

    <div class="detail-card">
        <!-- Header -->
        <div class="detail-header">
            <div class="header-content">
                <div class="header-top">
                    <div class="header-left">
                        <h2>
                            <span class="header-icon">
                                <i class="fa-solid fa-file-invoice"></i>
                            </span>
                            Detail Transaksi
                        </h2>
                        <div class="trx-id-badge">
                            <i class="fa-solid fa-hashtag"></i>
                            TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                    
                    <div class="status-badge-large">
                        <i class="fa-solid fa-circle-check"></i>
                        Berhasil
                    </div>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="detail-body">
            <!-- Info Section -->
            <div class="info-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-circle-info"></i>
                    Informasi Transaksi
                </h3>
                
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div class="info-label">Tanggal Transaksi</div>
                        <div class="info-value">{{ $transaction->created_at->format('d F Y') }}</div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="info-label">Waktu Transaksi</div>
                        <div class="info-value">{{ $transaction->created_at->format('H:i:s') }} WIB</div>
                    </div>
                    
                    {{-- <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="info-label">Kasir</div>
                        <div class="info-value">{{ $transaction->user->name ?? 'Admin' }}</div>
                    </div> --}}
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div class="info-label">Status Pembayaran</div>
                        <div class="info-value success">
                            <i class="fa-solid fa-circle-check"></i>
                            BERHASIL
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div class="info-label">Total Item</div>
                        <div class="info-value">{{ $transaction->items->count() }} Produk</div>
                    </div>
                </div>
            </div>

            <!-- Items Section -->
            <div class="items-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-shopping-cart"></i>
                    Daftar Produk
                </h3>
                
                <div class="item-list">
                    <div class="item-header">
                        <div class="item-header-cell">
                            <i class="fa-solid fa-box"></i>
                            Nama Produk
                        </div>
                        <div class="item-header-cell">
                            <i class="fa-solid fa-hashtag"></i>
                            Jumlah
                        </div>
                        <div class="item-header-cell">
                            <i class="fa-solid fa-tag"></i>
                            Harga Satuan
                        </div>
                        <div class="item-header-cell">
                            <i class="fa-solid fa-calculator"></i>
                            Subtotal
                        </div>
                    </div>
                    
                    @foreach($transaction->items as $item)
                    <div class="item-row">
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-qty">
                            <span class="qty-badge">{{ $item->qty }}x</span>
                        </div>
                        <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        <div class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Summary Section -->
            <div class="summary-section">
                <div class="summary-card">
                    <div class="summary-content">
                        <div class="summary-rows">
                            <div class="summary-row">
                                <span class="summary-row-label">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    Total Item
                                </span>
                                <span class="summary-row-value">{{ $transaction->items->sum('qty') }} Produk</span>
                            </div>
                            
                            <div class="summary-row">
                                <span class="summary-row-label">
                                    <i class="fa-solid fa-calculator"></i>
                                    Subtotal
                                </span>
                                <span class="summary-row-value">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="summary-total">
                            <span class="total-label">
                                <i class="fa-solid fa-money-bill-wave"></i>
                                Total Pembayaran
                            </span>
                            <h2 class="total-amount">Rp {{ number_format($transaction->total, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('users.print', $transaction->id) }}" class="btn-action btn-print" target="_blank">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak Struk</span>
                </a>
                
                <button class="btn-action btn-share" onclick="shareTransaction()">
                    <i class="fa-solid fa-share-nodes"></i>
                    <span>Bagikan</span>
                </button>
            </div>

            <!-- Timeline (Optional) -->
            {{-- <div class="timeline-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-timeline"></i>
                    Riwayat Aktivitas
                </h3>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-time">{{ $transaction->created_at->format('H:i:s') }}</div>
                        <div class="timeline-text">Transaksi berhasil dibuat</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-time">{{ $transaction->created_at->format('H:i:s') }}</div>
                        <div class="timeline-text">Pembayaran berhasil diproses</div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<script>
function shareTransaction() {
    const transactionId = "TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}";
    const total = "Rp {{ number_format($transaction->total, 0, ',', '.') }}";
    const text = `Transaksi ${transactionId}\nTotal: ${total}\nStatus: Berhasil`;
    
    if (navigator.share) {
        navigator.share({
            title: 'Detail Transaksi',
            text: text,
            url: window.location.href
        }).catch(() => {
            copyToClipboard(text);
        });
    } else {
        copyToClipboard(text);
    }
}

function copyToClipboard(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    
    alert('Detail transaksi berhasil disalin!');
}

// Animation on load
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.info-card, .item-row');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.4s ease-out';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 50);
    });
});
</script>

@endsectionx