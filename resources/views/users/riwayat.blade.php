@extends('users.layout.app')

@section('title', 'Riwayat Transaksi')

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

    .riwayat-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }

    .riwayat-header h2 {
        font-size: 26px;
        color: var(--primary-mature);
        font-weight: 800;
        margin-bottom: 25px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--white);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(100, 39, 20, 0.05);
        border-bottom: 4px solid var(--primary-mature);
        transition: 0.3s;
    }

    .stat-label {
        font-size: 12px;
        text-transform: uppercase;
        color: var(--text-muted);
        font-weight: 700;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: var(--primary-mature);
        margin: 10px 0 0;
    }

    .table-card {
        background: var(--white);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(100, 39, 20, 0.05);
        overflow: hidden;
    }

    .transaksi-table {
        width: 100%;
        border-collapse: collapse;
    }

    .transaksi-table th {
        background: #fdfaf5;
        padding: 15px 20px;
        text-align: left;
        font-size: 12px;
        color: var(--text-muted);
        border-bottom: 2px solid #f3e5cc;
    }

    .transaksi-table td {
        padding: 18px 20px;
        border-bottom: 1px solid #fdfaf5;
        color: var(--primary-mature);
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        background: #e6fffa;
        color: #2c7a7b;
        border: 1px solid #b2f5ea;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-detail {
        padding: 8px 16px;
        background: var(--primary-mature);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-detail:hover {
        background: #4a1d0f;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(100, 39, 20, 0.2);
    }

    .btn-print {
        padding: 8px 16px;
        background: var(--accent-gold);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-print:hover {
        background: #d17d04;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(236, 145, 5, 0.2);
    }
</style>

<div class="riwayat-container">
    <div class="riwayat-header">
        <h2>Riwayat Transaksi</h2>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-label">Total Pendapatan (Hari Ini)</span>
            <h3 class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
        </div>
        <div class="stat-card">
            <span class="stat-label">Jumlah Transaksi (Hari Ini)</span>
            <h3 class="stat-value">{{ $jumlahTransaksi }}</h3>
        </div>
        <div class="stat-card">
            <span class="stat-label">Terakhir Update</span>
            <h3 class="stat-value" style="font-size: 16px;">{{ now()->format('H:i:s') }} WIB</h3>
        </div>
    </div>

    <div class="table-card">
        <div style="padding: 20px 25px; background: #fdfaf5; border-bottom: 1px solid #f3e5cc;">
            <h3 style="margin:0; font-size:16px; color:var(--primary-mature)">Daftar Transaksi Hari Ini</h3>
        </div>
        
        <div style="overflow-x:auto;">
            <table class="transaksi-table">
                <thead>
                    <tr>
                        <th>ID TRX</th>
                        <th>Waktu</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td><span style="font-weight: 800; color: var(--accent-gold);">#TRX-{{ $trx->id }}</span></td>
                        <td>
                            <div style="font-weight:600">{{ $trx->created_at->format('d/m/Y') }}</div>
                            <div style="font-size:11px; color:var(--text-muted)">{{ $trx->created_at->format('H:i:s') }}</div>
                        </td>
                        <td style="font-size: 13px; font-weight: 500;">
                            @foreach($trx->items as $item)
                                {{ $item->product->name }} ({{ $item->quantity }}x){{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                        <td><span style="font-weight: 800;">Rp {{ number_format($trx->total, 0, ',', '.') }}</span></td>
                        <td><span class="status-badge">BERHASIL</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('users.detail', $trx->id) }}" class="btn-detail">
                                    Detail
                                </a>
                                <a href="{{ route('users.print', $trx->id) }}" class="btn-print" target="_blank">
                                    Cetak Struk
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 50px; text-align: center; color: var(--text-muted);">
                            Belum ada riwayat transaksi untuk hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection