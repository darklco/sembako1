@extends('users.layout.app')

@section('title', 'Detail Transaksi')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-mature: #642714;
        --accent-gold: #ec9105;
        --bg-krem: #fff0d2;
        --white: #ffffff;
        --text-muted: #af9b74;
    }

    .detail-container {
        padding: 30px;
        max-width: 900px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--white);
        color: var(--primary-mature);
        border: 2px solid #f3e5cc;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }

    .btn-back:hover {
        background: var(--primary-mature);
        color: var(--white);
        border-color: var(--primary-mature);
        transform: translateX(-4px);
    }

    .detail-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(100, 39, 20, 0.08);
        overflow: hidden;
    }

    .detail-header {
        background: linear-gradient(135deg, var(--primary-mature) 0%, #4a1d0f 100%);
        padding: 30px;
        color: white;
    }

    .detail-header h2 {
        margin: 0 0 8px 0;
        font-size: 24px;
        font-weight: 800;
    }

    .detail-header .trx-id {
        color: var(--accent-gold);
        font-size: 18px;
        font-weight: 700;
    }

    .detail-body {
        padding: 30px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        background: #fdfaf5;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid var(--accent-gold);
    }

    .info-label {
        font-size: 12px;
        color: var(--text-muted);
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 16px;
        color: var(--primary-mature);
        font-weight: 700;
    }

    .items-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 16px;
        color: var(--primary-mature);
        font-weight: 800;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .item-list {
        background: #fdfaf5;
        border-radius: 10px;
        overflow: hidden;
    }

    .item-row {
        display: grid;
        grid-template-columns: 1fr 100px 120px 150px;
        gap: 16px;
        padding: 16px 20px;
        border-bottom: 1px solid #f3e5cc;
        align-items: center;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-row.header {
        background: var(--white);
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
    }

    .item-name {
        font-weight: 600;
        color: var(--primary-mature);
    }

    .item-qty, .item-price, .item-subtotal {
        text-align: right;
        font-weight: 700;
        color: var(--primary-mature);
    }

    .total-section {
        background: linear-gradient(135deg, var(--primary-mature) 0%, #4a1d0f 100%);
        padding: 24px;
        border-radius: 12px;
        text-align: right;
    }

    .total-label {
        font-size: 14px;
        color: var(--bg-krem);
        opacity: 0.9;
        margin-bottom: 8px;
    }

    .total-amount {
        font-size: 32px;
        font-weight: 800;
        color: var(--accent-gold);
        margin: 0;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-print-large {
        flex: 1;
        padding: 16px;
        background: var(--accent-gold);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
        display: inline-block;
    }

    .btn-print-large:hover {
        background: #d17d04;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(236, 145, 5, 0.3);
    }

    @media (max-width: 768px) {
        .detail-container {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .item-row {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .item-row.header {
            display: none;
        }

        .item-qty, .item-price, .item-subtotal {
            text-align: left;
        }

        .total-section {
            text-align: center;
        }
    }
</style>

<div class="detail-container">
    <a href="{{ route('users.riwayat') }}" class="btn-back">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Kembali ke Riwayat
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h2>Detail Transaksi</h2>
            <div class="trx-id">#TRX-{{ $transaction->id }}</div>
        </div>

        <div class="detail-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Tanggal Transaksi</div>
                    <div class="info-value">{{ $transaction->created_at->format('d F Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Waktu Transaksi</div>
                    <div class="info-value">{{ $transaction->created_at->format('H:i:s') }} WIB</div>
                </div>
                {{-- <div class="info-item">
                    <div class="info-label">Kasir</div>
                    <div class="info-value">{{ $transaction->user->name ?? 'Admin' }}</div>
                </div> --}}
                <div class="info-item">
                    <div class="info-label">Status Pembayaran</div>
                    <div class="info-value" style="color: #2c7a7b;">BERHASIL</div>
                </div>
            </div>

            <div class="items-section">
                <h3 class="section-title">Daftar Produk</h3>
                <div class="item-list">
                    <div class="item-row header">
                        <div>Nama Produk</div>
                        <div>Jumlah</div>
                        <div>Harga Satuan</div>
                        <div>Subtotal</div>
                    </div>
                    @foreach($transaction->items as $item)
                    <div class="item-row">
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-qty">{{ $item->qty }} x</div>
                        <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        <div class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="total-section">
                <div class="total-label">Total Pembayaran</div>
                <h2 class="total-amount">Rp {{ number_format($transaction->total, 0, ',', '.') }}</h2>
            </div>

            <div class="action-buttons">
                <a href="{{ route('users.print', $transaction->id) }}" class="btn-print-large" target="_blank">
                    Cetak Struk
                </a>
            </div>
        </div>
    </div>
</div>

@endsection