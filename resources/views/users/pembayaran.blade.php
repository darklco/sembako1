@extends('users.layout.app')

@section('title', 'Pembayaran')

@section('content')

<style>
    :root {
        --primary-mature: #642714;    /* Cokelat Tua */
        --accent-gold: #ec9105;       /* Emas / Orange Mature */
        --bg-krem: #fff0d2;           /* Krem Background */
        --white: #ffffff;
        --text-muted: #af9b74;        /* Abu-abu Cokelat */
    }

    .pembayaran-container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }

    .pembayaran-header {
        margin-bottom: 30px;
    }

    .pembayaran-header h2 {
        font-size: 28px;
        color: var(--primary-mature);
        font-weight: 800;
        margin-bottom: 10px;
    }

    .breadcrumb {
        font-size: 14px;
        color: var(--text-muted);
    }

    .breadcrumb a {
        color: var(--accent-gold);
        text-decoration: none;
        font-weight: 600;
    }

    .pembayaran-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .card-section {
        background: var(--white);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(100, 39, 20, 0.05);
        border: 1px solid rgba(175, 155, 116, 0.1);
    }

    .card-section h3 {
        font-size: 20px;
        color: var(--primary-mature);
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--bg-krem);
    }

    .total-display {
        background: var(--primary-mature);
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 25px;
        color: var(--bg-krem);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
    }

    .total-display p {
        margin: 0;
        font-size: 14px;
        opacity: 0.8;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .total-display h2 {
        margin: 0;
        font-size: 40px;
        font-weight: 800;
        color: var(--accent-gold);
    }

    .form-group label {
        display: block;
        font-weight: 700;
        color: var(--primary-mature);
        margin-bottom: 10px;
        font-size: 15px;
    }

    .form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid var(--bg-krem);
        border-radius: 10px;
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-mature);
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--accent-gold);
        background: #fffdf9;
    }

    .input-with-icon::before {
        content: "Rp";
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-weight: 700;
        z-index: 1;
    }

    .input-with-icon input {
        padding-left: 48px;
    }

    .kembalian-display {
        background: #fdfaf5;
        border: 2px dashed var(--accent-gold);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }

    .kembalian-display.warning {
        background: #fff5f5;
        border-color: #e53e3e;
    }

    .kembalian-display p {
        margin: 0 0 5px 0;
        color: var(--text-muted);
        font-weight: 600;
    }

    .kembalian-display h3 {
        margin: 0;
        font-size: 32px;
        color: var(--primary-mature);
        border: none;
    }

    .kembalian-display.warning h3 {
        color: #e53e3e;
        font-size: 20px;
    }

    .btn-selesai {
        width: 100%;
        padding: 18px;
        background: var(--accent-gold);
        color: var(--white);
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 4px 12px rgba(236, 145, 5, 0.2);
    }

    .btn-selesai:hover:not(:disabled) {
        background: var(--primary-mature);
        transform: translateY(-2px);
    }

    .btn-selesai:disabled {
        background: #e0e0e0;
        color: #999;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-kembali {
        width: 100%;
        padding: 14px;
        background: transparent;
        color: var(--text-muted);
        border: 2px solid var(--bg-krem);
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-kembali:hover {
        background: var(--bg-krem);
        color: var(--primary-mature);
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--bg-krem);
        font-weight: 600;
    }

    .method-btn.active {
        background: var(--primary-mature);
        color: var(--bg-krem);
        border-color: var(--primary-mature);
    }

    @media (max-width: 968px) {
        .pembayaran-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="pembayaran-container">
    <div class="pembayaran-header">
        <h2>Pembayaran</h2>
        <p class="breadcrumb">
            <a href="/users">← Kembali ke Transaksi</a>
        </p>
    </div>

    <div class="pembayaran-grid">
        <div class="card-section">
            <h3>Ringkasan Pesanan</h3>

            <div class="total-display">
                <p>Total yang harus dibayar</p>
                <h2 id="totalBelanjaDisplay">Rp 0</h2>
            </div>

            <div id="daftarBarangDinamis">
                <div class="detail-item">
                    <span>Memuat data...</span>
                </div>
            </div>

            <div class="detail-item">
                <span>Waktu Transaksi</span>
                <span id="datetime" style="font-size: 13px; color: var(--text-muted);"></span>
            </div>
        </div>

        <div class="card-section">
            <h3>Input Pembayaran</h3>

            <div class="form-group">
                <label>Metode</label>
                <button class="method-btn active" style="width:100%; padding:12px; border-radius:10px; border:2px solid var(--primary-mature); font-weight:700;">Tunai / Cash</button>
            </div>

            <div class="form-group">
                <label>Uang Diterima</label>
                <div class="input-with-icon" style="position:relative;">
                    <input 
                        type="number" 
                        id="uangBayar" 
                        placeholder="0"
                        oninput="hitungKembalian()"
                        autofocus
                    >
                </div>
            </div>

            <div class="kembalian-display" id="kembalianDisplay">
                <p>Uang Kembalian</p>
                <h3 id="kembalian">Rp 0</h3>
            </div>

            <button class="btn-selesai" id="btnSelesai" onclick="selesaikanTransaksi()" disabled>
                KONFIRMASI BAYAR
            </button>

            <a href="/users" class="btn-kembali">Batal</a>
        </div>
    </div>
</div>

<script>
    const totalBelanja = parseInt(localStorage.getItem('checkoutTotal')) || 0;
    const items = JSON.parse(localStorage.getItem('checkoutItems')) || [];
    const rincianNama = localStorage.getItem('checkoutNama') || "Tidak ada barang";

    
    function inisialisasiHalaman() {
        // Update Total di Kotak Cokelat
        document.getElementById('totalBelanjaDisplay').textContent = 'Rp ' + formatRupiah(totalBelanja);
        
        // Update Detail Barang
        const containerBarang = document.getElementById('daftarBarangDinamis');
        containerBarang.innerHTML = `
            <div class="detail-item">
                <span style="max-width: 70%;">${rincianNama}</span>
                <span>Rp ${formatRupiah(totalBelanja)}</span>
            </div>
        `;

        updateDateTime();
    }

    function updateDateTime() {
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        document.getElementById('datetime').textContent = now.toLocaleDateString('id-ID', options) + ' WIB';
    }

    function hitungKembalian() {
        const uangBayar = parseInt(document.getElementById('uangBayar').value) || 0;
        const kembalian = uangBayar - totalBelanja;
        const kembalianEl = document.getElementById('kembalian');
        const displayEl = document.getElementById('kembalianDisplay');
        const btnSelesai = document.getElementById('btnSelesai');

        if (uangBayar === 0) {
            kembalianEl.textContent = 'Rp 0';
            displayEl.className = 'kembalian-display';
            btnSelesai.disabled = true;
        } else if (kembalian < 0) {
            kembalianEl.textContent = 'Kurang Rp ' + formatRupiah(Math.abs(kembalian));
            displayEl.className = 'kembalian-display warning';
            btnSelesai.disabled = true;
        } else {
            kembalianEl.textContent = 'Rp ' + formatRupiah(kembalian);
            displayEl.className = 'kembalian-display';
            btnSelesai.disabled = false;
        }
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function selesaikanTransaksi() {
        const uangBayar = document.getElementById('uangBayar').value;
        const kembalian = uangBayar - totalBelanja;
        
        if (confirm('Selesaikan pembayaran sekarang?')) {
            const btn = document.getElementById('btnSelesai');
            btn.textContent = '⏳ Memproses...';
            btn.style.background = '#af9b74';
            
            // SIMPAN KE RIWAYAT (Agar bisa dibaca di file Riwayat nanti)
            let riwayat = JSON.parse(localStorage.getItem('daftarRiwayat')) || [];
            riwayat.push({
                id: 'TRX-' + Math.floor(Math.random() * 9000 + 1000),
                nama: rincianNama,
                total: totalBelanja,
                waktu: new Date().toLocaleString('id-ID')
            });
            localStorage.setItem('daftarRiwayat', JSON.stringify(riwayat));

            setTimeout(() => {
                alert('✅ Pembayaran Berhasil!\nKembalian: Rp ' + formatRupiah(kembalian));
                
                // Bersihkan memori checkout setelah selesai
                localStorage.removeItem('checkoutTotal');
                localStorage.removeItem('checkoutNama');
                
                window.location.href = '/users';
            }, 800);
        }
    }

    // Jalankan fungsi inisialisasi
    inisialisasiHalaman();
</script>

@endsection