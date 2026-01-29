<style>
    /* 1. RESET BODY */
    body {
        margin: 0;
        padding: 0;
        background-color: #fff0d2 !important;
        overflow-x: hidden;
    }

    /* 2. SIDEBAR TETAP (FIXED) */
    .sidebar {
        width: 260px;
        background-color: #ffffff;
        height: 100vh;
        position: fixed; /* Mengunci di layar */
        left: 0; 
        top: 0;
        display: flex;
        flex-direction: column;
        border-right: 1px solid rgba(100, 39, 20, 0.1);
        z-index: 1000;
    }

    /* Logo Brand */
    .sidebar-brand {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        height: 100px !important; 
        overflow: hidden !important; 
        border-bottom: 1px solid rgba(236, 145, 5, 0.1);
    }

    .sidebar-brand img {
        height: 50px !important;
        transform: scale(2.8) !important;
        object-fit: contain !important;
    }

    /* Link Navigasi */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        color: #642714;
        font-weight: 600;
        border-radius: 12px;
        margin: 5px 15px;
        transition: 0.2s;
    }

    .nav-link.active {
        background-color: #642714;
        color: #ffffff;
    }

    .nav-link i {
        margin-right: 15px;
        width: 20px;
        text-align: center;
    }

    /* 3. KONTEN UTAMA (PENTING AGAR TIDAK KOSONG) */
    .pos-container {
        margin-left: 260px; /* Jarak agar tidak tertutup sidebar */
        padding: 40px;
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 420px; /* Kolom kiri (produk) & kanan (keranjang) */
        gap: 24px;
        align-items: start; /* Mencegah keranjang belanja ikut panjang ke bawah */
    }

    /* 4. KERANJANG BELANJA STICKY (BIAR TIDAK ADA BOLONG DI KANAN) */
    .cart-section {
        background: #ffffff;
        border-radius: 8px;
        padding: 28px;
        border: 1px solid #f3e5cc;
        position: sticky; /* Kunci keranjang belanja */
        top: 20px; 
        max-height: calc(100vh - 80px); /* Batasi tinggi agar bisa di-scroll sendiri */
        overflow-y: auto;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.05);
    }

    /* Responsive untuk HP */
    @media (max-width: 1024px) {
        .pos-container {
            grid-template-columns: 1fr;
            margin-left: 0;
        }
        .sidebar {
            left: -260px;
        }
    }
</style>

<div class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('users.index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Sembakoku Logo">
        </a>
    </div>

    <nav style="margin-top: 15px;">
        <a href="{{ route('users.products') }}" class="nav-link {{ request()->routeIs('users.products') ? 'active' : '' }}">
            <i class="fa-solid fa-store"></i>
            <span>Produk</span>
        </a>

        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>Transaksi</span>
        </a>

        <a href="{{ route('users.riwayat') }}" class="nav-link {{ request()->routeIs('users.riwayat') ? 'active' : '' }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>Riwayat</span>
        </a>
    </nav>
</div>