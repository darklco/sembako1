@extends('users.layout.app')

@section('title', 'Transaksi Kasir')

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

    body {
        background-color: var(--bg-krem) !important;
        font-family: 'Inter', sans-serif;
    }

    .kasir-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .kasir-header h1 {
        font-size: 26px;
        color: var(--primary-mature);
        font-weight: 800;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-box {
        position: relative;
        max-width: 500px;
        margin-bottom: 10px;
    }

    .search-box input {
        width: 100%;
        padding: 15px 25px;
        border: 2px solid var(--text-muted);
        border-radius: 12px;
        background: var(--white);
        font-size: 15px;
        transition: all 0.3s;
    }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 25px;
        margin-top: 20px;
    }

    .produk-section {
        background: var(--white);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(100, 39, 20, 0.05);
        border: 1px solid rgba(175, 155, 116, 0.2);
    }

    .produk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
    }

    .produk-card {
        background: var(--white);
        border: 1.5px solid #f3e5cc;
        border-radius: 15px;
        padding: 18px;
        transition: all 0.3s ease;
        text-align: center;
    }

    .produk-card img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .no-image {
        height: 120px;
        background: #fdfaf5;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 12px;
        margin-bottom: 10px;
    }

    .total-box {
        background: var(--primary-mature);
        color: var(--bg-krem);
        padding: 20px;
        border-radius: 15px;
        margin-top: 20px;
        text-align: center;
    }

    .total-box h2 {
        margin: 5px 0 0;
        font-size: 32px;
        font-weight: 800;
        color: var(--accent-gold);
    }

    .btn-proses {
        display: block;
        width: 100%;
        margin-top: 15px;
        padding: 18px;
        background: var(--accent-gold);
        color: var(--primary-mature);
        border-radius: 12px;
        font-weight: 800;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-proses:disabled {
        background: #e0e0e0;
        color: #999;
        cursor: not-allowed;
    }

    .keranjang-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
    .qty-controls { display: flex; align-items: center; gap: 8px; background: #fdfaf5; padding: 5px; border-radius: 8px; }
    .qty-controls button { width: 20px; height: 20px; border: none; background: var(--primary-mature); color: white; border-radius: 4px; cursor: pointer; }
</style>

<div class="kasir-container">
    <div class="kasir-header">
        <h1>Sembakoku <span style="color: var(--accent-gold)">POS</span></h1>
        <div class="search-box">
            <input type="text" placeholder="Cari produk..." id="searchInput">
        </div>
    </div>

    <div class="main-grid">
        <div class="produk-section">
            <div class="section-title" style="margin-bottom: 20px; font-weight: 700; color: var(--primary-mature);">
                <span>📦 Katalog Produk</span>
            </div>

            <div class="produk-grid">
                @foreach($products as $p)
                <div class="produk-card">
                    @if($p->image)
                        <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                    
                    <strong>{{ $p->name }}</strong>
                    <p class="harga" style="color: var(--accent-gold); font-weight: 800; margin: 10px 0;">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </p>
                    <span class="stok" style="font-size: 12px; color: var(--text-muted); background: #fff9ed; padding: 4px 10px; border-radius: 20px; display: inline-block; margin-bottom: 10px;">
                        Stok: {{ $p->stock }}
                    </span>
                    
                    {{-- Tombol sekarang mengirim ID Produk --}}
                    <button 
                        onclick="tambahKeKeranjang('{{ $p->name }}', {{ $p->price }}, {{ $p->stock }}, {{ $p->id }})" 
                        style="width: 100%; padding: 10px; background: var(--primary-mature); color: white; border: none; border-radius: 10px; cursor: pointer;"
                        {{ $p->stock <= 0 ? 'disabled' : '' }}>
                        {{ $p->stock <= 0 ? 'Habis' : 'Tambah' }}
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <div class="keranjang-section">
            <div class="section-title" style="margin-bottom: 20px; font-weight: 700;">🛒 Keranjang</div>
            <div id="keranjangContent">
                <div class="empty-cart" style="text-align: center; padding: 40px 0; color: var(--text-muted);">
                    <p>Keranjang Kosong</p>
                </div>
            </div>

            <div class="total-box">
                <p style="margin:0; font-size: 13px; opacity: 0.8;">Total Tagihan</p>
                <h2>Rp <span id="totalAmount">0</span></h2>
            </div>

            <button id="btnProses" onclick="prosesKePembayaran()" class="btn-proses" disabled>
                PROSES BAYAR →
            </button>
        </div>
    </div>
</div>

<script>
    let keranjang = [];

    function tambahKeKeranjang(nama, harga, stokMax, id) {
        const item = keranjang.find(i => i.product_id === id);
        if (item) {
            if (item.qty < stokMax) {
                item.qty++;
            } else {
                alert('Stok tidak mencukupi!');
            }
        } else {
            keranjang.push({ product_id: id, nama, harga, qty: 1, stokMax });
        }
        updateUI();
    }

    function updateQty(id, delta) {
        const item = keranjang.find(i => i.product_id === id);
        if (item) {
            if (delta > 0 && item.qty >= item.stokMax) {
                alert('Stok terbatas!');
                return;
            }
            item.qty += delta;
            if (item.qty <= 0) keranjang = keranjang.filter(i => i.product_id !== id);
        }
        updateUI();
    }

    function updateUI() {
        const content = document.getElementById('keranjangContent');
        const btnProses = document.getElementById('btnProses');

        if (keranjang.length === 0) {
            content.innerHTML = '<div class="empty-cart" style="text-align: center; padding: 40px 0; color: var(--text-muted);"><p>Keranjang Kosong</p></div>';
            btnProses.disabled = true;
        } else {
            btnProses.disabled = false;
            let html = '<table class="keranjang-table"><thead><tr style="font-size: 10px; color: var(--text-muted);"><th>ITEM</th><th>QTY</th><th style="text-align:right">TOTAL</th></tr></thead><tbody>';
            keranjang.forEach(item => {
                html += `
                    <tr>
                        <td style="font-size: 13px;">${item.nama}</td>
                        <td>
                            <div class="qty-controls">
                                <button onclick="updateQty(${item.product_id}, -1)">-</button>
                                <span style="font-size: 13px;">${item.qty}</span>
                                <button onclick="updateQty(${item.product_id}, 1)">+</button>
                            </div>
                        </td>
                        <td style="text-align:right; font-weight:700; color:var(--primary-mature)">
                            ${(item.harga * item.qty).toLocaleString('id-ID')}
                        </td>
                    </tr>
                `;
            });
            html += '</tbody></table>';
            content.innerHTML = html;
        }

        const total = keranjang.reduce((sum, i) => sum + (i.harga * i.qty), 0);
        document.getElementById('totalAmount').textContent = total.toLocaleString('id-ID');
    }

    // FUNGSI PROSES KE DATABASE
    async function prosesKePembayaran() {
        if (keranjang.length === 0) return;

        const btn = document.getElementById('btnProses');
        btn.disabled = true;
        btn.innerHTML = "Processing...";

        // Payload data untuk dikirim ke TransactionController
        const payload = {
            items: keranjang.map(item => ({
                product_id: item.product_id,
                qty: item.qty
            }))
        };

        try {
            const response = await fetch("{{ url('admin/transaction') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (response.ok) {
                // Berhasil: Simpan data ke localStorage untuk halaman nota/pembayaran
                localStorage.setItem('checkoutTotal', result.total_belanja);
                localStorage.setItem('checkoutItems', JSON.stringify(keranjang));
                
                alert("Transaksi Berhasil! Stok telah diperbarui.");
                window.location.href = "{{ route('users.pembayaran') }}";
            } else {
                alert("Gagal: " + (result.error || result.message));
                btn.disabled = false;
                btn.innerHTML = "PROSES BAYAR →";
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan koneksi server.");
            btn.disabled = false;
            btn.innerHTML = "PROSES BAYAR →";
        }
    }

    document.getElementById('searchInput').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.produk-card').forEach(card => {
            const name = card.querySelector('strong').textContent.toLowerCase();
            card.style.display = name.includes(term) ? 'block' : 'none';
        });
    });
</script>

@endsection