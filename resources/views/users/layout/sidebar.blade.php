<style>
/* ===============================
   SIDEBAR LAYOUT
================================ */

.sidebar {
    width: 260px;
    background-color: #ffffff;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    border-right: 1px solid rgba(100, 39, 20, 0.1);
    box-shadow: 4px 0 15px rgba(100, 39, 20, 0.05);
    transition: transform 0.3s ease;
}

/* BRAND */
.sidebar-brand {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    border-bottom: 1px solid rgba(236, 145, 5, 0.15);
}

.sidebar-brand img {
    height: 48px;
    object-fit: contain;
}

/* NAVIGATION */
.sidebar nav {
    padding: 20px 10px;
}

.sidebar nav a {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 18px;
    margin-bottom: 10px;
    text-decoration: none;
    color: #642714;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.25s ease;
}

.sidebar nav a i {
    width: 20px;
    text-align: center;
    font-size: 16px;
}

.sidebar nav a:hover {
    background-color: #f3e5cc;
}

.sidebar nav a.active {
    background-color: #642714;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
}

/* ===============================
   MOBILE MODE
================================ */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
    }
}
</style>

<!-- ===============================
     SIDEBAR HTML
================================ -->

<div class="sidebar">

    <div class="sidebar-brand">
        <a href="{{ route('users.products') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Sembakoku Logo">
        </a>
    </div>

    <nav>
        <a href="{{ route('users.products') }}"
           class="{{ (Request::is('users') || Request::is('users/products*')) ? 'active' : '' }}">
            <i class="fa-solid fa-store"></i>
            <span>Produk</span>
        </a>

        <a href="{{ route('users.index') }}"
           class="{{ Request::is('users/transaksi*') ? 'active' : '' }}">
            <i class="fa-solid fa-cash-register"></i>
            <span>Transaksi</span>
        </a>

        <a href="{{ route('users.riwayat') }}"
           class="{{ Request::is('users/riwayat*') ? 'active' : '' }}">
            <i class="fa-solid fa-history"></i>
            <span>Riwayat</span>
        </a>
    </nav>

</div>
