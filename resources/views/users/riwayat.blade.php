@extends('users.layout.app')

@section('title', 'Riwayat Transaksi')

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

    .riwayat-container {
        padding: 48px 40px;
        max-width: 1600px;
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

    /* Header Section */
    .riwayat-header {
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-left {
        flex: 1;
    }

    .riwayat-header h2 {
        font-size: 36px;
        color: var(--primary);
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(236, 145, 5, 0.25);
    }

    .header-subtitle {
        font-size: 15px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .header-actions {
        display: flex;
        gap: 12px;
    }

    .btn-refresh {
        padding: 12px 24px;
        background: white;
        color: var(--primary);
        border: 2px solid var(--border);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.06);
    }

    .btn-refresh:hover {
        background: var(--bg-cream);
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.12);
    }

    .btn-export {
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(236, 145, 5, 0.25);
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(236, 145, 5, 0.35);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 28px;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(100, 39, 20, 0.08);
        border: 1px solid rgba(243, 229, 204, 0.5);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-dark) 100%);
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(100, 39, 20, 0.15);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon.revenue {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .stat-icon.transaction {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
    }

    .stat-icon.time {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .stat-label {
        font-size: 13px;
        text-transform: uppercase;
        color: var(--text-muted);
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--primary);
        margin: 0;
        line-height: 1.2;
        letter-spacing: -1px;
    }

    .stat-change {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 8px;
        padding: 4px 12px;
        border-radius: 20px;
        background: var(--success-light);
        color: var(--success);
    }

    /* Filter and Search Section */
    .controls-section {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .search-wrapper {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 16px;
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        padding: 14px 18px 14px 50px;
        border: 2px solid var(--border);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        outline: none;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.04);
    }

    .search-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(236, 145, 5, 0.12);
    }

    .filter-select {
        padding: 14px 18px;
        border: 2px solid var(--border);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        background: white;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.04);
    }

    .filter-select:hover {
        border-color: var(--accent);
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(100, 39, 20, 0.1);
        overflow: hidden;
        border: 1px solid rgba(243, 229, 204, 0.5);
    }

    .table-header {
        padding: 24px 32px;
        background: linear-gradient(135deg, #fdfaf5 0%, #fff8ed 100%);
        border-bottom: 2px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(180deg, var(--accent), var(--accent-dark));
        border-radius: 2px;
    }

    .table-count {
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 600;
        background: white;
        padding: 6px 16px;
        border-radius: 20px;
        border: 1px solid var(--border);
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .transaksi-table {
        width: 100%;
        border-collapse: collapse;
    }

    .transaksi-table thead {
        background: #fdfaf5;
    }

    .transaksi-table th {
        padding: 18px 24px;
        text-align: left;
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border);
        white-space: nowrap;
    }

    .transaksi-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(243, 229, 204, 0.4);
    }

    .transaksi-table tbody tr:hover {
        background: linear-gradient(90deg, rgba(236, 145, 5, 0.03) 0%, transparent 100%);
    }

    .transaksi-table tbody tr:last-child {
        border-bottom: none;
    }

    .transaksi-table td {
        padding: 20px 24px;
        color: var(--text-dark);
        font-size: 14px;
        vertical-align: middle;
    }

    .trx-id {
        font-weight: 800;
        color: var(--accent);
        font-size: 15px;
        font-family: 'Courier New', monospace;
    }

    .trx-date {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 4px;
    }

    .trx-time {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .product-list {
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
        max-width: 300px;
    }

    .product-item {
        display: inline;
        color: var(--text-dark);
    }

    .product-qty {
        color: var(--accent);
        font-weight: 600;
    }

    .trx-total {
        font-weight: 800;
        font-size: 16px;
        color: var(--primary);
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge.success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #6ee7b7;
    }

    .status-badge i {
        font-size: 10px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-detail, .btn-print {
        padding: 10px 18px;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-detail {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(100, 39, 20, 0.3);
    }

    .btn-print {
        background: white;
        color: var(--accent);
        border: 2px solid var(--accent);
    }

    .btn-print:hover {
        background: var(--accent);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(236, 145, 5, 0.25);
    }

    /* Empty State */
    .empty-state {
        padding: 80px 20px;
        text-align: center;
    }

    .empty-state-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #f8f8f8 0%, #e9e9e9 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #ccc;
    }

    .empty-state-text {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .empty-state-subtext {
        font-size: 14px;
        color: var(--text-muted);
        opacity: 0.7;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 32px;
        padding: 20px;
    }

    .page-btn {
        padding: 10px 16px;
        border: 2px solid var(--border);
        background: white;
        color: var(--primary);
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .page-btn:hover {
        border-color: var(--accent);
        background: var(--bg-cream);
    }

    .page-btn.active {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        border-color: var(--accent);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .riwayat-container {
            padding: 32px 20px;
        }

        .riwayat-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .riwayat-header h2 {
            font-size: 28px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .header-actions {
            width: 100%;
        }

        .btn-refresh, .btn-export {
            flex: 1;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-value {
            font-size: 26px;
        }

        .controls-section {
            flex-direction: column;
        }

        .search-wrapper {
            width: 100%;
            min-width: auto;
        }

        .table-header {
            padding: 20px;
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .transaksi-table th,
        .transaksi-table td {
            padding: 14px 16px;
            font-size: 13px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-detail, .btn-print {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .riwayat-header h2 {
            font-size: 24px;
        }

        .table-wrapper {
            overflow-x: scroll;
        }

        .transaksi-table {
            min-width: 800px;
        }
    }

    /* Loading Animation */
    .loading-row {
        animation: pulse 1.5s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
</style>

<div class="riwayat-container">
    <div class="riwayat-header">
        <div class="header-left">
            <h2>
                <span class="header-icon">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </span>
                Riwayat Transaksi
            </h2>
            <p class="header-subtitle">Pantau dan kelola semua transaksi yang telah dilakukan</p>
        </div>
        
        <div class="header-actions">
            <button class="btn-refresh" onclick="location.reload()">
                <i class="fa-solid fa-arrows-rotate"></i>
                Refresh
            </button>
            {{-- <button class="btn-export">
                <i class="fa-solid fa-download"></i>
                Export Data
            </button> --}}
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <span class="stat-label">Total Pendapatan</span>
                    <h3 class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    <span class="stat-change">
                        <i class="fa-solid fa-arrow-up"></i>
                        Hari Ini
                    </span>
                </div>
                <div class="stat-icon revenue">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <span class="stat-label">Jumlah Transaksi</span>
                    <h3 class="stat-value">{{ $jumlahTransaksi }}</h3>
                    <span class="stat-change">
                        <i class="fa-solid fa-chart-line"></i>
                        Transaksi Hari Ini
                    </span>
                </div>
                <div class="stat-icon transaction">
                    <i class="fa-solid fa-receipt"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <span class="stat-label">Terakhir Update</span>
                    <h3 class="stat-value" style="font-size: 18px;">{{ now()->format('H:i:s') }} WIB</h3>
                    <span class="stat-change">
                        <i class="fa-solid fa-clock"></i>
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
                <div class="stat-icon time">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="controls-section">
        <div class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input 
                type="text" 
                class="search-input" 
                id="searchInput"
                placeholder="Cari transaksi berdasarkan ID atau produk...">
        </div>
        
        {{-- <select class="filter-select" id="filterStatus">
            <option value="all">Semua Status</option>
            <option value="success">Berhasil</option>
            <option value="pending">Pending</option>
            <option value="failed">Gagal</option>
        </select>

        <select class="filter-select" id="filterDate">
            <option value="today">Hari Ini</option>
            <option value="week">Minggu Ini</option>
            <option value="month">Bulan Ini</option>
            <option value="all">Semua</option>
        </select> --}}
    </div>

    <div class="table-card">
        <div class="table-header">
            <h3 class="table-title">Daftar Transaksi</h3>
            <span class="table-count">
                <i class="fa-solid fa-list"></i>
                {{ count($transactions) }} Transaksi
            </span>
        </div>
        
        <div class="table-wrapper">
            <table class="transaksi-table">
                <thead>
                    <tr>
                        <th><i class="fa-solid fa-hashtag"></i> ID Transaksi</th>
                        <th><i class="fa-solid fa-calendar"></i> Waktu</th>
                        <th><i class="fa-solid fa-box"></i> Produk</th>
                        <th><i class="fa-solid fa-money-bill-wave"></i> Total</th>
                        <th><i class="fa-solid fa-circle-check"></i> Status</th>
                        <th><i class="fa-solid fa-ellipsis-vertical"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody id="transactionTable">
                    @forelse($transactions as $trx)
                    <tr>
                        <td>
                            <span class="trx-id">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <div class="trx-date">{{ $trx->created_at->format('d/m/Y') }}</div>
                            <div class="trx-time">{{ $trx->created_at->format('H:i:s') }} WIB</div>
                        </td>
                        <td>
                            <div class="product-list">
                                @foreach($trx->items as $item)
                                    <span class="product-item">
                                        {{ $item->product->name }} 
                                        <span class="product-qty">({{ $item->quantity }}x)</span>{{ !$loop->last ? ', ' : '' }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <span class="trx-total">Rp {{ number_format($trx->total, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="status-badge success">
                                <i class="fa-solid fa-circle-check"></i>
                                Berhasil
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('users.detail', $trx->id) }}" class="btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                    Detail
                                </a>
                                <a href="{{ route('users.print', $trx->id) }}" class="btn-print" target="_blank">
                                    <i class="fa-solid fa-print"></i>
                                    Cetak
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <p class="empty-state-text">Belum ada transaksi</p>
                                <p class="empty-state-subtext">Transaksi yang dilakukan akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const filterDate = document.getElementById('filterDate');
    const tableRows = document.querySelectorAll('#transactionTable tr:not(:last-child)');

    // Search functionality
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const term = e.target.value.toLowerCase().trim();
                
                tableRows.forEach(row => {
                    const trxId = row.querySelector('.trx-id')?.textContent.toLowerCase() || '';
                    const products = row.querySelector('.product-list')?.textContent.toLowerCase() || '';
                    
                    const isVisible = trxId.includes(term) || products.includes(term);
                    row.style.display = isVisible ? '' : 'none';
                });
            }, 300);
        });

        // Clear search on ESC
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
                searchInput.blur();
            }
        });
    }

    // Filter functionality (placeholder - implement based on your needs)
    if (filterStatus) {
        filterStatus.addEventListener('change', () => {
            // Implement status filter logic
            console.log('Filter by status:', filterStatus.value);
        });
    }

    if (filterDate) {
        filterDate.addEventListener('change', () => {
            // Implement date filter logic
            console.log('Filter by date:', filterDate.value);
        });
    }

    // Add loading animation to table rows
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = 'all 0.4s ease-out';
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });
});
</script>

@endsection