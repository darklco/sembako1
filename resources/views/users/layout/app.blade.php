<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sembakoku | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    :root {
        --primary-mature: #642714;
        --accent-gold: #ec9105;
        --bg-krem: #fff0d2;
        --sidebar-light: #fdfaf5;
        --text-light: #fdfaf5;
        --text-muted: #af9b74;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-krem);
        color: var(--primary-mature);
    }

    /* ===== WRAPPER ===== */
    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
        width: 260px;
        background: var(--sidebar-light);
        padding: 30px 20px;
        box-shadow: 4px 0 15px rgba(100, 39, 20, 0.05);
        border-right: 1px solid rgba(100, 39, 20, 0.1);
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }

    .sidebar-brand {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(100, 39, 20, 0.05);
    }

    .sidebar-brand img {
        max-width: 170px;
        height: auto;
    }

    .sidebar nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        margin-bottom: 10px;
        color: var(--primary-mature);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .sidebar nav a:hover {
        background: #f3e5cc;
    }

    .sidebar nav a.active {
        background: var(--primary-mature);
        color: var(--text-light);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
    }

    /* ===== NOTIF BADGE ===== */
    .notif-badge {
        margin-left: auto;
        background: #ef4444;
        color: white;
        font-size: 11px;
        font-weight: 700;
        min-width: 20px;
        height: 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 6px;
    }

    /* ===== CONTENT ===== */
    .content {
        margin-left: 260px;
        padding: 30px;
        width: calc(100% - 260px);
        min-height: 100vh;
        background: var(--bg-krem);
    }

    /* ===== MOBILE NAVBAR ===== */
    .mobile-navbar {
        display: none;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .content {
            margin-left: 0;
            width: 100%;
            padding: 20px;
        }

        .mobile-navbar {
            display: flex;
            align-items: center;
            height: 56px;
            padding: 0 16px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .hamburger {
            font-size: 22px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--primary-mature);
        }
    }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('users.products') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Sembakoku">
            </a>
        </div>

        <nav>
            @php
                $unreadCount = \App\Models\Notification::where('is_read', false)->count();
            @endphp

            <a href="{{ route('users.products') }}"
               class="{{ (Request::is('users') || Request::is('users/products*')) ? 'active' : '' }}">
                <i class="fa-solid fa-store"></i>
                <span>Produk</span>
            </a>

            <a href="{{ route('users.transaksi') }}"
               class="{{ Request::is('users/transaksi*') ? 'active' : '' }}">
                <i class="fa-solid fa-cash-register"></i>
                <span>Transaksi</span>
            </a>

            <a href="{{ route('users.riwayat') }}"
               class="{{ Request::is('users/riwayat*') ? 'active' : '' }}">
                <i class="fa-solid fa-history"></i>
                <span>Riwayat</span>
            </a>

            <a href="{{ route('users.notification') }}"
               class="{{ Request::is('users/notifications*') ? 'active' : '' }}">
                <i class="fa-solid fa-bell"></i>
                <span>Notifikasi</span>
                @if($unreadCount > 0)
                    <span class="notif-badge">{{ $unreadCount }}</span>
                @endif
            </a>
        </nav>
    </div> <!-- CLOSING SIDEBAR — ini yang hilang -->

    <!-- MOBILE NAVBAR -->
    <div class="mobile-navbar">
        <button class="hamburger" id="toggleSidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</div>

<script>
document.getElementById('toggleSidebar')?.addEventListener('click', function () {
    document.querySelector('.sidebar').classList.toggle('active');
});
</script>

</body>
</html>