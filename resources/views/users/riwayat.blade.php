@extends('users.layout.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-mature: #642714;    /* Cokelat Tua Canva */
        --accent-gold: #ec9105;       /* Orange Gold Canva */
        --bg-krem: #fff0d2;           /* Krem Muda Canva */
        --white: #ffffff;
        --text-muted: #af9b74;        /* Abu-abu Cokelat Canva */
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

    /* Stats Section */
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

    .stat-card:hover { transform: translateY(-5px); }

    .stat-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        font-weight: 700;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: var(--primary-mature);
        margin: 10px 0 0;
    }

    /* Table Section */
    .table-card {
        background: var(--white);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(100, 39, 20, 0.05);
        overflow: hidden;
    }

    .table-header {
        padding: 20px 25px;
        background: #fdfaf5;
        border-bottom: 1px solid #f3e5cc;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        text-transform: uppercase;
        color: var(--text-muted);
        border-bottom: 2px solid #f3e5cc;
    }

    .transaksi-table td {
        padding: 18px 20px;
        border-bottom: 1px solid #fdfaf5;
        color: var(--primary-mature);
    }

    .transaksi-id {
        font-weight: 800;
        color: var(--accent-gold);
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

    .total-amount {
        font-weight: 800;
        color: var(--primary-mature);
    }

    .btn-clear {
        background: #fff5f5;
        color: #e53e3e;
        border: 1px solid #feb2b2;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .empty-state {
        padding: 50px;
        text-align: center;
        color: var(--text-muted);
    }
</style>

<div class="riwayat-container">
    <div class="riwayat-header">
        <h2>Riwayat Transaksi</h2>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-label">Total Pendapatan</span>
            <h3 class="stat-value" id="statPendapatan">Rp 0</h3>
        </div>
        <div class="stat-card">
            <span class="stat-label">Jumlah Transaksi</span>
            <h3 class="stat-value" id="statTransaksi">0</h3>
        </div>
        <div class="stat-card">
            <span class="stat-label">Terakhir Update</span>
            <h3 class="stat-value" id="statWaktu" style="font-size: 16px;">-</h3>
        </div>
    </div>

    <div class="table-card">
        <div class="table-header">
            <h3 style="margin:0; font-size:16px; color:var(--primary-mature)">Daftar Transaksi</h3>
            <div style="display: flex; gap: 10px;">
                <input type="text" id="searchInput" placeholder="Cari Produk..." style="padding:8px 15px; border-radius:20px; border:1px solid #f3e5cc; width:200px;">
                <button class="btn-clear" onclick="hapusRiwayat()">Reset Data</button>
            </div>
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
                    </tr>
                </thead>
                <tbody id="transaksiBody">
                    </tbody>
            </table>
            <div id="emptyMsg" class="empty-state" style="display:none;">
                <p>Belum ada riwayat transaksi.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function muatDataRiwayat() {
        // Ambil data dari localStorage
        const daftarRiwayat = JSON.parse(localStorage.getItem('daftarRiwayat')) || [];
        const body = document.getElementById('transaksiBody');
        const emptyMsg = document.getElementById('emptyMsg');
        
        // Reset Tabel
        body.innerHTML = '';

        if (daftarRiwayat.length === 0) {
            emptyMsg.style.display = 'block';
            updateStats(0, 0);
            return;
        }

        emptyMsg.style.display = 'none';
        let totalPendapatan = 0;

        // Urutkan dari yang terbaru (paling atas)
        daftarRiwayat.reverse().forEach(trx => {
            totalPendapatan += trx.total;
            
            const row = `
                <tr>
                    <td><span class="transaksi-id">#${trx.id}</span></td>
                    <td>
                        <div style="font-weight:600">${trx.waktu.split(',')[0]}</div>
                        <div style="font-size:11px; color:var(--text-muted)">${trx.waktu.split(',')[1] || ''}</div>
                    </td>
                    <td style="font-size: 13px; font-weight: 500;">${trx.nama}</td>
                    <td><span class="total-amount">Rp ${formatRupiah(trx.total)}</span></td>
                    <td><span class="status-badge">BERHASIL</span></td>
                </tr>
            `;
            body.insertAdjacentHTML('beforeend', row);
        });

        updateStats(totalPendapatan, daftarRiwayat.length);
    }

    function updateStats(total, jumlah) {
        document.getElementById('statPendapatan').textContent = 'Rp ' + formatRupiah(total);
        document.getElementById('statTransaksi').textContent = jumlah;
        document.getElementById('statWaktu').textContent = new Date().toLocaleTimeString('id-ID') + ' WIB';
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function hapusRiwayat() {
        if (confirm('Apakah Anda yakin ingin menghapus semua riwayat transaksi?')) {
            localStorage.removeItem('daftarRiwayat');
            muatDataRiwayat();
        }
    }

    // Search function
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#transaksiBody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
    });

    // Jalankan saat halaman dibuka
    muatDataRiwayat();
</script>

@endsection