@extends('users.layout.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --primary: #642714;
        --accent: #ec9105;
        --bg-cream: #fff0d2;
        --white: #ffffff;
        --text-muted: #af9b74;
        --border: #f3e5cc;
        --danger: #ef4444;
    }
    body { background: linear-gradient(135deg, #fff8e7 0%, var(--bg-cream) 100%) !important; font-family: 'Inter', sans-serif; }
    
    .products-container { padding: 25px 32px; max-width: 1600px; margin: 0 auto; }
    
    /* Judul & Icon Atas */
    .page-header { margin-bottom: 20px; }
    .page-title { font-size: 28px; font-weight: 800; color: var(--primary); display: flex; align-items: center; gap: 12px; margin: 0; }
    .icon-box { background: var(--accent); color: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }

    .main-pos-grid { display: grid; grid-template-columns: 1fr 380px; gap: 20px; align-items: start; }
    
    /* Grid Produk Tanpa Space Berlebih */
    .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
    .product-card { background: var(--white); border-radius: 15px; overflow: hidden; transition: 0.2s; box-shadow: 0 4px 10px rgba(100, 39, 20, 0.05); display: flex; flex-direction: column; border: 1px solid var(--border); }
    .product-card:hover { transform: translateY(-3px); border-color: var(--accent); }
    
    .product-image-wrapper { width: 100%; aspect-ratio: 1/1; position: relative; background: #fafafa; border-bottom: 1px solid #f5ead6; }
    .product-image { width: 100%; height: 100%; object-fit: contain; padding: 10px; }
    .discount-badge { position: absolute; top: 10px; right: 10px; background: var(--danger); color: white; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 800; z-index: 2; }
    
    /* Rapiin Nama Produk & Harga */
    .product-body { padding: 12px; flex-grow: 1; display: flex; flex-direction: column; text-align: center; gap: 2px; }
    .product-title { font-size: 18px; font-weight: 800; color: var(--primary); margin: 0; line-height: 1.2; }
    .stock-info { font-size: 11px; color: var(--text-muted); margin-bottom: 4px; }
    
    .price-section { margin-top: auto; padding-top: 5px; }
    .current-price { font-size: 20px; font-weight: 800; color: var(--accent); }
    .old-price { font-size: 12px; color: var(--text-muted); text-decoration: line-through; margin-bottom: -2px; }

    /* Tombol Tambah Padat */
    .btn-add { width: 100%; margin-top: 10px; padding: 10px; border-radius: 10px; border: none; background: var(--primary); color: white; cursor: pointer; font-weight: 700; font-size: 13px; transition: 0.2s; }
    .btn-add:hover { background: #4a1d0f; }

    /* Keranjang */
    .cart-card { background: white; border-radius: 18px; padding: 20px; position: sticky; top: 20px; border: 1px solid var(--border); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    .total-container { background: var(--primary); color: white; padding: 18px; border-radius: 15px; margin: 15px 0; text-align: center; }
    .btn-pay { width: 100%; padding: 16px; background: var(--accent); color: white; border: none; border-radius: 12px; font-weight: 800; font-size: 16px; cursor: pointer; }
    .btn-pay:disabled { background: #e0d0b0; cursor: not-allowed; }
</style>

<div class="products-container">
    <div class="page-header">
        <h1 class="page-title">
            <div class="icon-box"><i class="fa-solid fa-cash-register"></i></div>
            SEMBAKO KU
        </h1>
        <p style="color: var(--text-muted); margin: 5px 0 0 55px; font-size: 14px;">Pilih produk untuk transaksi baru</p>
    </div>

    <div class="main-pos-grid">
        <div class="products-grid">
            @foreach($products as $p)
            @php 
                $hasDiscount = ($p->discount_price && $p->discount_price < $p->price) || ($p->discount > 0);
                $percent = $p->discount ?: ($p->price > 0 ? round((($p->price - $p->discount_price) / $p->price) * 100) : 0);
            @endphp
            <div class="product-card">
                <div class="product-image-wrapper">
                    @if($hasDiscount) <div class="discount-badge">{{ $percent }}% OFF</div> @endif
                    <img src="{{ asset('storage/' . $p->image) }}" class="product-image">
                </div>
                <div class="product-body">
                    <h5 class="product-title">{{ $p->name }}</h5>
                    <span class="stock-info">Stok: {{ $p->stock }}</span>
                    
                    <div class="price-section">
                        @if($hasDiscount) <div class="old-price">Rp {{ number_format($p->price, 0, ',', '.') }}</div> @endif
                        <div class="current-price">Rp {{ number_format($p->final_price, 0, ',', '.') }}</div>
                    </div>

                    <button class="btn-add" onclick="addToCart({{ $p->id }}, '{{ $p->name }}', {{ $p->final_price }}, {{ $p->stock }})">
                        <i class="fa-solid fa-plus"></i> Tambah Ke Keranjang
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="cart-card">
            <h3 style="color: var(--primary); margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-cart-shopping"></i> Keranjang
            </h3>
            <div id="cartItems" style="min-height: 100px; max-height: 400px; overflow-y: auto;">
                <p style="text-align: center; color: #ccc; margin-top: 30px;">Keranjang kosong</p>
            </div>
            
            <div class="total-container">
                <p style="font-size: 12px; margin: 0; opacity: 0.8;">Total Pembayaran</p>
                <h2 id="totalText" style="margin: 0; color: var(--accent); font-size: 30px;">Rp 0</h2>
            </div>
            
            <button id="payButton" class="btn-pay" disabled onclick="processCheckout()">
                PROSES PEMBAYARAN
            </button>
        </div>
    </div>
</div>

<script>
    let cart = [];

    function addToCart(id, name, price, stock) {
        let item = cart.find(i => i.product_id === id);
        if(item) {
            if(item.qty < stock) item.qty++;
            else alert('Stok maksimal!');
        } else {
            cart.push({ product_id: id, nama: name, harga: price, qty: 1, maxStock: stock });
        }
        updateUI();
    }

    function changeQty(id, delta) {
        let item = cart.find(i => i.product_id === id);
        if(item) {
            item.qty += delta;
            if(item.qty <= 0) cart = cart.filter(i => i.product_id !== id);
            if(item.qty > item.maxStock) { alert('Stok terbatas!'); item.qty = item.maxStock; }
        }
        updateUI();
    }

    function updateUI() {
        const container = document.getElementById('cartItems');
        const totalText = document.getElementById('totalText');
        const payBtn = document.getElementById('payButton');
        let total = 0;

        if(cart.length === 0) {
            container.innerHTML = '<p style="text-align: center; color: #ccc; margin-top: 30px;">Keranjang kosong</p>';
            totalText.innerText = 'Rp 0';
            payBtn.disabled = true;
            return;
        }

        let html = '<table style="width: 100%; border-collapse: collapse;">';
        cart.forEach(item => {
            total += (item.harga * item.qty);
            html += `<tr style="border-bottom: 1px solid #f3e5cc;">
                <td style="padding: 12px 0;">
                    <div style="font-weight:800; color:var(--primary); font-size:14px;">${item.nama}</div>
                    <div style="color:var(--text-muted); font-size:12px;">Rp ${item.harga.toLocaleString('id-ID')}</div>
                </td>
                <td style="text-align: right;">
                    <div style="display:flex; align-items:center; justify-content:flex-end; gap:8px;">
                        <button onclick="changeQty(${item.product_id}, -1)" style="width:24px; height:24px; border-radius:5px; border:none; background:#eee;">-</button>
                        <span style="font-weight:800; color:var(--primary); min-width:20px; text-align:center;">${item.qty}</span>
                        <button onclick="changeQty(${item.product_id}, 1)" style="width:24px; height:24px; border-radius:5px; border:none; background:var(--accent); color:white;">+</button>
                    </div>
                </td>
            </tr>`;
        });
        container.innerHTML = html + '</table>';
        totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
        payBtn.disabled = false;
    }

    async function processCheckout() {
        const btn = document.getElementById('payButton');
        btn.disabled = true;
        btn.innerText = 'MEMPROSES...';

        try {
            const response = await fetch("{{ url('admin/transaction') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ items: cart.map(i => ({ product_id: i.product_id, qty: i.qty })) })
            });

            const result = await response.json();
            if (response.ok) {
                localStorage.setItem('checkoutTotal', result.total);
                window.location.href = "{{ route('users.pembayaran') }}";
            } else {
                alert(result.message || "Gagal.");
                btn.disabled = false;
                btn.innerText = 'PROSES PEMBAYARAN';
            }
        } catch (e) {
            alert("Koneksi bermasalah.");
            btn.disabled = false;
            btn.innerText = 'PROSES PEMBAYARAN';
        }
    }
</script>
@endsection