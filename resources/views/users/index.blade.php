@extends('users.layout.app')

@section('title', 'Transaksi Kasir')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #642714;
        --accent: #ec9105;
        --bg-cream: #fff0d2;
        --white: #ffffff;
        --text-muted: #af9b74;
        --border: #f3e5cc;
    }

    body { 
        background-color: var(--bg-cream) !important; 
        font-family: 'Inter', sans-serif;
        color: #1a1a1a;
    }

    .pos-container { 
        padding: 40px;
        min-height: 100vh;
    }

    .pos-header {
        margin-bottom: 32px;
    }

    .pos-header h1 { 
        font-size: 28px;
        color: var(--primary);
        font-weight: 700;
        margin: 0 0 8px 0;
    }

    .pos-subtitle {
        font-size: 15px;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    .search-container {
        margin-bottom: 24px;
    }

    .search-box { 
        width: 100%;
        max-width: 500px;
        padding: 14px 20px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        transition: all 0.3s ease;
        background: var(--white);
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.05);
    }

    .search-box:focus {
        border-color: var(--accent);
        box-shadow: 0 4px 16px rgba(236, 145, 5, 0.15);
        transform: translateY(-1px);
    }

    .search-box::placeholder {
        color: var(--text-muted);
        font-weight: 400;
    }

    .main-grid { 
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 24px;
    }

    /* Product Section */
    .products-section { 
        background: var(--white);
        border-radius: 8px;
        padding: 28px;
        border: 1px solid var(--border);
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--primary);
        margin: 0 0 24px 0;
    }

    .products-grid { 
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }

    .product-card { 
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .product-card:hover { 
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.1);
        border-color: var(--accent);
    }

    .product-image-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        margin-bottom: 12px;
        border-radius: 6px;
        overflow: hidden;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image { 
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d1d5db;
        font-size: 13px;
        background: #fafafa;
    }

    .product-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        margin: 0 0 8px 0;
        display: block;
    }

    .product-stock {
        font-size: 12px;
        color: var(--text-muted);
        background: #fef8ed;
        padding: 4px 10px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 16px;
        font-weight: 700;
        color: var(--accent);
        margin: 0 0 16px 0;
    }

    .btn-add-product {
        width: 100%;
        padding: 10px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .btn-add-product:hover:not(:disabled) {
        background: #4a1d0f;
        transform: translateY(-1px);
    }

    .btn-add-product:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    /* Cart Section */
    .cart-section { 
        background: var(--white);
        border-radius: 8px;
        padding: 28px;
        position: sticky;
        top: 20px;
        height: fit-content;
        border: 1px solid var(--border);
    }

    .cart-content {
        min-height: 200px;
        margin-bottom: 20px;
    }

    .empty-cart {
        text-align: center;
        color: var(--text-muted);
        padding: 60px 20px;
        font-size: 14px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table td {
        padding: 14px 0;
        border-bottom: 1px solid #f5f5f5;
        vertical-align: middle;
    }

    .cart-item-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 4px;
    }

    .cart-item-price {
        font-size: 12px;
        color: var(--text-muted);
    }

    .qty-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-end;
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        border: none;
        background: var(--primary);
        color: white;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .qty-btn:hover {
        background: #4a1d0f;
    }

    .qty-value {
        font-weight: 600;
        color: var(--primary);
        min-width: 30px;
        text-align: center;
    }

    .total-box {
        background: var(--primary);
        padding: 24px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 16px;
    }

    .total-label {
        font-size: 13px;
        color: var(--bg-cream);
        opacity: 0.9;
        margin: 0 0 8px 0;
    }

    .total-amount {
        font-size: 32px;
        font-weight: 700;
        color: var(--accent);
        margin: 0;
    }

    .btn-checkout {
        width: 100%;
        padding: 16px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .btn-checkout:hover:not(:disabled) {
        background: #d17d04;
        transform: translateY(-1px);
    }

    .btn-checkout:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
        }

        .cart-section {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .pos-container {
            padding: 24px;
        }

        .pos-header h1 {
            font-size: 24px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
        }

        .search-box {
            max-width: 100%;
        }
    }
</style>

<div class="pos-container">
    <div class="pos-header">
        <h1>Sembakoku <span style="color: var(--accent)">POS</span></h1>
        <p class="pos-subtitle">Point of Sale System</p>
        
        <div class="search-container">
            <input 
                type="text" 
                placeholder="Cari produk berdasarkan nama..." 
                id="searchInput" 
                class="search-box">
        </div>
    </div>

    <div class="main-grid">
        <!-- Products Section -->
        <div class="products-section">
            <h3 class="section-title">Katalog Produk</h3>
            <div class="products-grid">
                @foreach($products as $p)
                <div class="product-card">
                    <div class="product-image-wrapper">
                        @if($p->image)
                            <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" class="product-image">
                        @else
                            <div class="no-image">No Image</div>
                        @endif
                    </div>
                    
                    <strong class="product-name">{{ $p->name }}</strong>
                    
                    <span class="product-stock">
                        Stok: <b id="stok-val-{{ $p->id }}">{{ $p->stock }}</b>
                    </span>
                    
                    <p class="product-price">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </p>
                    
                    <button 
                        onclick="tambahKeKeranjang({{ $p->id }}, '{{ $p->name }}', {{ $p->price }}, {{ $p->stock }})" 
                        id="btn-add-{{ $p->id }}"
                        class="btn-add-product"
                        {{ $p->stock <= 0 ? 'disabled' : '' }}>
                        {{ $p->stock <= 0 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Section -->
        <div class="cart-section">
            <h3 class="section-title">Keranjang Belanja</h3>
            
            <div id="keranjangContent" class="cart-content">
                <div class="empty-cart">
                    <p>Keranjang masih kosong</p>
                </div>
            </div>

            <div class="total-box">
                <p class="total-label">Total Pembayaran</p>
                <h2 class="total-amount">Rp <span id="totalAmountDisplay">0</span></h2>
            </div>

            <button id="btnProses" onclick="prosesKePembayaran()" class="btn-checkout" disabled>
                Proses Pembayaran
            </button>
        </div>
    </div>
</div>

<script>
    let keranjang = [];

    function tambahKeKeranjang(id, nama, harga, stokMax) {
        const item = keranjang.find(i => i.product_id === id);
        let qtySekarang = item ? item.qty : 0;
        
        if (qtySekarang < stokMax) {
            if (item) {
                item.qty++;
            } else {
                keranjang.push({ product_id: id, nama, harga, qty: 1, stokMax: stokMax });
            }
            renderKeranjang();
        } else {
            alert('Stok tidak cukup untuk menambah item ini.');
        }
    }

    function updateQty(id, delta) {
        const item = keranjang.find(i => i.product_id === id);
        if (item) {
            const newQty = item.qty + delta;
            if (newQty > item.stokMax) {
                alert('Melebihi stok tersedia!');
                return;
            }
            item.qty = newQty;
            if (item.qty <= 0) {
                keranjang = keranjang.filter(i => i.product_id !== id);
            }
        }
        renderKeranjang();
    }

    function renderKeranjang() {
        const container = document.getElementById('keranjangContent');
        const btn = document.getElementById('btnProses');
        const displayTotal = document.getElementById('totalAmountDisplay');

        if (keranjang.length === 0) {
            container.innerHTML = '<div class="empty-cart"><p>Keranjang masih kosong</p></div>';
            btn.disabled = true;
            displayTotal.innerText = '0';
            return;
        }

        btn.disabled = false;
        let html = '<table class="cart-table">';
        let totalHarga = 0;
        
        keranjang.forEach(item => {
            const subtotal = item.harga * item.qty;
            totalHarga += subtotal;
            html += `
                <tr>
                    <td>
                        <div class="cart-item-name">${item.nama}</div>
                        <div class="cart-item-price">@ Rp ${item.harga.toLocaleString('id-ID')}</div>
                    </td>
                    <td style="width: 140px;">
                        <div class="qty-controls">
                            <button class="qty-btn" onclick="updateQty(${item.product_id}, -1)">−</button>
                            <span class="qty-value">${item.qty}</span>
                            <button class="qty-btn" onclick="updateQty(${item.product_id}, 1)">+</button>
                        </div>
                    </td>
                </tr>`;
        });
        
        html += '</table>';
        container.innerHTML = html;
        displayTotal.innerText = totalHarga.toLocaleString('id-ID');
    }

    async function prosesKePembayaran() {
        const btn = document.getElementById('btnProses');
        btn.disabled = true;
        btn.innerText = 'Memproses...';

        try {
            const response = await fetch("{{ url('admin/transaction') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ 
                    items: keranjang.map(i => ({ product_id: i.product_id, qty: i.qty })) 
                })
            });

            const result = await response.json();
            
            if (response.ok) {
                localStorage.setItem('checkoutTotal', result.total);
                localStorage.setItem('checkoutNama', keranjang.map(i => `${i.nama} (${i.qty}x)`).join(', '));
                
                window.location.href = "{{ route('users.pembayaran') }}";
            } else {
                alert(result.message || "Gagal memproses transaksi.");
                btn.disabled = false;
                btn.innerText = 'Proses Pembayaran';
            }
        } catch (e) {
            console.error(e);
            alert("Terjadi kesalahan koneksi.");
            btn.disabled = false;
            btn.innerText = 'Proses Pembayaran';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const inputCari = document.getElementById('searchInput');
        if(inputCari) {
            inputCari.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                document.querySelectorAll('.product-card').forEach(card => {
                    const namaProduk = card.querySelector('.product-name').innerText.toLowerCase();
                    card.style.display = namaProduk.includes(term) ? 'block' : 'none';
                });
            });
        }
    });
</script>
@endsection