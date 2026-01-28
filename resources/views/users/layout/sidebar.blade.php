<style>
    .sidebar {
        width: 260px;
        background-color: #ffffff;
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        display: flex;
        flex-direction: column;
        border-right: 1px solid rgba(100, 39, 20, 0.1);
        z-index: 1000;
    }

    .sidebar-brand {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 0 !important; 
        height: 100px !important; /* Tinggi kotak logo */
        overflow: hidden !important; 
        border-bottom: 1px solid rgba(236, 145, 5, 0.1);
    }

    .sidebar-brand a {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
        height: 100% !important;
    }

    .sidebar-brand img {
        /* FIX: Pakai width auto agar tidak gepeng, naikkan scale untuk buang whitespace */
        width: auto !important;
        height: 50px !important; /* Atur tinggi tulisan di dalam kotak */
        max-width: none !important;
        transform: scale(2.8) !important; /* Menutup area kosong di gambar asli */
        display: block !important;
        object-fit: contain !important;
    }

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
</style>

<div class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('users.index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Sembakoku Logo">
        </a>
    </div>

    <nav style="margin-top: 15px;">
         <a href="{{ route('users.products') }}" class="nav-link {{ request()->routeIs('users.products') ? 'active' : '' }}">
           <i class="fa-solid fa-bag" style="margin-right: 15px;"></i>
            <span>Produk</span>
        </a>

        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar" style="margin-right: 15px;"></i>
            <span>Transaksi</span>
        </a>

        <a href="{{ route('users.riwayat') }}" class="nav-link {{ request()->routeIs('users.riwayat') ? 'active' : '' }}">
            <i class="fa-solid fa-clock-rotate-left" style="margin-right: 15px;"></i>
            <span>Riwayat</span>
        </a>
    </nav>
</div>