@extends('users.layout.app')


@section('title', 'Riwayat Transaksi')

@section('content')

<style>
    .riwayat-container {
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .riwayat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .riwayat-header h2 {
        font-size: 28px;
        color: #2c3e50;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-size: 13px;
        color: #7f8c8d;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #3498db;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }

    .btn-success {
        background: #27ae60;
        color: white;
    }

    .btn-success:hover {
        background: #229954;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
    }

    .btn-outline {
        background: white;
        color: #7f8c8d;
        border: 2px solid #e0e0e0;
    }

    .btn-outline:hover {
        border-color: #3498db;
        color: #3498db;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border-left: 4px solid #3498db;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }

    .stat-card.success {
        border-left-color: #27ae60;
    }

    .stat-card.warning {
        border-left-color: #f39c12;
    }

    .stat-card.info {
        border-left-color: #9b59b6;
    }

    .stat-label {
        font-size: 13px;
        color: #7f8c8d;
        margin-bottom: 8px;
        display: block;
    }

    .stat-value {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        margin: 0;
    }

    .stat-icon {
        font-size: 32px;
        float: right;
        opacity: 0.3;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .table-header {
        padding: 20px 25px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h3 {
        margin: 0;
        font-size: 18px;
        color: #2c3e50;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .transaksi-table {
        width: 100%;
        border-collapse: collapse;
    }

    .transaksi-table thead {
        background: #f8f9fa;
    }

    .transaksi-table th {
        padding: 15px 20px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .transaksi-table td {
        padding: 18px 20px;
        border-bottom: 1px solid #f0f0f0;
        color: #2c3e50;
    }

    .transaksi-table tbody tr {
        transition: all 0.2s;
        cursor: pointer;
    }

    .transaksi-table tbody tr:hover {
        background: #f8f9fa;
    }

    .transaksi-id {
        font-family: 'Courier New', monospace;
        color: #3498db;
        font-weight: 600;
    }

    .tanggal-cell {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .tanggal-date {
        font-weight: 600;
        color: #2c3e50;
    }

    .tanggal-time {
        font-size: 12px;
        color: #95a5a6;
    }

    .total-amount {
        font-size: 16px;
        font-weight: bold;
        color: #27ae60;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .status-success {
        background: #d4edda;
        color: #155724;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        padding: 8px 12px;
        background: #ecf0f1;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }

    .btn-icon:hover {
        background: #3498db;
        color: white;
        transform: scale(1.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #95a5a6;
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        margin: 0 0 10px 0;
        color: #7f8c8d;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 25px;
        border-top: 2px solid #f0f0f0;
    }

    .pagination button {
        padding: 8px 14px;
        border: 2px solid #e0e0e0;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }

    .pagination button:hover:not(:disabled) {
        border-color: #3498db;
        color: #3498db;
    }

    .pagination button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination button.active {
        background: #3498db;
        color: white;
        border-color: #3498db;
    }

    .items-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .item-badge {
        background: #ecf0f1;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        color: #7f8c8d;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .riwayat-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .transaksi-table th,
        .transaksi-table td {
            padding: 12px 15px;
            font-size: 13px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="riwayat-container">
    
    <div class="riwayat-header">
        <h2>📊 Riwayat Transaksi</h2>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="exportData()">
                📥 Export Excel
            </button>
            <button class="btn btn-success" onclick="cetakLaporan()">
                🖨️ Cetak Laporan
            </button>
        </div>
    </div>

    <!-- STATISTIK CARDS -->
    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-icon">💰</span>
            <span class="stat-label">Total Pendapatan</span>
            <h3 class="stat-value">Rp 1.250.000</h3>
        </div>
        <div class="stat-card success">
            <span class="stat-icon">📈</span>
            <span class="stat-label">Transaksi Hari Ini</span>
            <h3 class="stat-value">15</h3>
        </div>
        <div class="stat-card warning">
            <span class="stat-icon">🛒</span>
            <span class="stat-label">Total Item Terjual</span>
            <h3 class="stat-value">127</h3>
        </div>
        <div class="stat-card info">
            <span class="stat-icon">📊</span>
            <span class="stat-label">Rata-rata Transaksi</span>
            <h3 class="stat-value">Rp 83.333</h3>
        </div>
    </div>

    <!-- FILTER SECTION -->
    <div class="filter-section">
        <div class="filter-grid">
            <div class="filter-group">
                <label>Dari Tanggal</label>
                <input type="date" id="dateFrom" value="2024-04-01">
            </div>
            <div class="filter-group">
                <label>Sampai Tanggal</label>
                <input type="date" id="dateTo" value="2024-04-30">
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select id="statusFilter">
                    <option value="all">Semua Status</option>
                    <option value="success">Berhasil</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
            </div>
            <div class="filter-group">
                <button class="btn btn-primary" onclick="filterTransaksi()" style="width: 100%;">
                    🔍 Filter
                </button>
            </div>
        </div>
    </div>

    <!-- TABLE TRANSAKSI -->
    <div class="table-card">
        <div class="table-header">
            <h3>Daftar Transaksi</h3>
            <input type="text" placeholder="Cari transaksi..." style="padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 8px; width: 250px;">
        </div>
        
        <div class="table-wrapper">
            <table class="transaksi-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal & Waktu</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Kasir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="transaksiBody">
                    <tr onclick="showDetail('TRX001')">
                        <td><span class="transaksi-id">#TRX001</span></td>
                        <td>
                            <div class="tanggal-cell">
                                <span class="tanggal-date">23 April 2024</span>
                                <span class="tanggal-time">14:30 WIB</span>
                            </div>
                        </td>
                        <td>
                            <div class="items-info">
                                <span>Beras 5kg</span>
                                <span class="item-badge">+0 lainnya</span>
                            </div>
                        </td>
                        <td><span class="total-amount">Rp 65.000</span></td>
                        <td><span class="status-badge status-success">Berhasil</span></td>
                        <td>Admin 1</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" onclick="event.stopPropagation(); lihatDetail('TRX001')" title="Detail">👁️</button>
                                <button class="btn-icon" onclick="event.stopPropagation(); cetakStruk('TRX001')" title="Cetak">🖨️</button>
                            </div>
                        </td>
                    </tr>
                    <tr onclick="showDetail('TRX002')">
                        <td><span class="transaksi-id">#TRX002</span></td>
                        <td>
                            <div class="tanggal-cell">
                                <span class="tanggal-date">24 April 2024</span>
                                <span class="tanggal-time">09:15 WIB</span>
                            </div>
                        </td>
                        <td>
                            <div class="items-info">
                                <span>Minyak 2L, Gula 1kg</span>
                                <span class="item-badge">+2 lainnya</span>
                            </div>
                        </td>
                        <td><span class="total-amount">Rp 120.000</span></td>
                        <td><span class="status-badge status-success">Berhasil</span></td>
                        <td>Admin 2</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" onclick="event.stopPropagation(); lihatDetail('TRX002')" title="Detail">👁️</button>
                                <button class="btn-icon" onclick="event.stopPropagation(); cetakStruk('TRX002')" title="Cetak">🖨️</button>
                            </div>
                        </td>
                    </tr>
                    <tr onclick="showDetail('TRX003')">
                        <td><span class="transaksi-id">#TRX003</span></td>
                        <td>
                            <div class="tanggal-cell">
                                <span class="tanggal-date">24 April 2024</span>
                                <span class="tanggal-time">11:45 WIB</span>
                            </div>
                        </td>
                        <td>
                            <div class="items-info">
                                <span>Telur 1kg, Tepung 1kg</span>
                                <span class="item-badge">+1 lainnya</span>
                            </div>
                        </td>
                        <td><span class="total-amount">Rp 52.000</span></td>
                        <td><span class="status-badge status-success">Berhasil</span></td>
                        <td>Admin 1</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" onclick="event.stopPropagation(); lihatDetail('TRX003')" title="Detail">👁️</button>
                                <button class="btn-icon" onclick="event.stopPropagation(); cetakStruk('TRX003')" title="Cetak">🖨️</button>
                            </div>
                        </td>
                    </tr>
                    <tr onclick="showDetail('TRX004')">
                        <td><span class="transaksi-id">#TRX004</span></td>
                        <td>
                            <div class="tanggal-cell">
                                <span class="tanggal-date">24 April 2024</span>
                                <span class="tanggal-time">16:20 WIB</span>
                            </div>
                        </td>
                        <td>
                            <div class="items-info">
                                <span>Kopi 100g</span>
                                <span class="item-badge">+0 lainnya</span>
                            </div>
                        </td>
                        <td><span class="total-amount">Rp 18.000</span></td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>Admin 2</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" onclick="event.stopPropagation(); lihatDetail('TRX004')" title="Detail">👁️</button>
                                <button class="btn-icon" onclick="event.stopPropagation(); cetakStruk('TRX004')" title="Cetak">🖨️</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="pagination">
            <button disabled>← Prev</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>Next →</button>
        </div>
    </div>

</div>

<script>
    function showDetail(id) {
        alert(`Menampilkan detail transaksi ${id}`);
    }

    function lihatDetail(id) {
        alert(`Detail lengkap transaksi ${id}:\n\n• ID: ${id}\n• Total: Rp 65.000\n• Status: Berhasil\n• Metode: Tunai\n• Items: 1 produk`);
    }

    function cetakStruk(id) {
        alert(`Mencetak struk untuk transaksi ${id}...`);
    }

    function filterTransaksi() {
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;
        const status = document.getElementById('statusFilter').value;
        
        alert(`Filter diterapkan:\n\nDari: ${dateFrom}\nSampai: ${dateTo}\nStatus: ${status}`);
    }

    function exportData() {
        alert('📥 Mengexport data ke Excel...\n\nFile akan segera diunduh.');
    }

    function cetakLaporan() {
        alert('🖨️ Mencetak laporan transaksi...');
    }

    // Search functionality
    const searchInput = document.querySelector('input[placeholder="Cari transaksi..."]');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#transaksiBody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection
