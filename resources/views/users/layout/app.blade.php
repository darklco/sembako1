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
            /* Palet Warna Mature Sembako */
            --primary-mature: #642714;    /* Cokelat Tua */
            --accent-gold: #ec9105;       /* Emas/Orange */
            --bg-krem: #fff0d2;           /* Krem Background Utama */
            --sidebar-light: #fdfaf5;     /* Krem Sangat Muda untuk Sidebar */
            --text-light: #fdfaf5;        /* Putih Gading */
            --text-muted: #af9b74;        /* Abu-abu Cokelat */
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-krem);
            color: var(--primary-mature);
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR CUSTOM (LIGHT VERSION) --- */
        .sidebar {
            width: 260px;
            background: var(--sidebar-light);
            color: var(--primary-mature);
            padding: 30px 20px;
            box-shadow: 4px 0 15px rgba(100, 39, 20, 0.05);
            border-right: 1px solid rgba(100, 39, 20, 0.1);
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        /* Logo Brand Container */
        .sidebar-brand {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(100, 39, 20, 0.05);
        }

        .sidebar-brand img {
            max-width: 170px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-brand img:hover {
            transform: scale(1.05);
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

        /* Hover Effect */
        .sidebar nav a:hover {
            background: #f3e5cc;
            color: var(--primary-mature);
        }

        /* Active Menu: Cokelat Tua & Teks Putih */
        .sidebar nav a.active {
            background: var(--primary-mature);
            color: var(--text-light);
            box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
        }

        .sidebar nav a i {
            font-size: 18px;
            width: 25px;
            text-align: center;
        }

        /* --- CONTENT AREA --- */
        .content {
            flex: 1;
            padding: 30px;
            background: var(--bg-krem);
            overflow-y: auto;
        }

        /* Scrollbar cantik */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-krem); }
        ::-webkit-scrollbar-thumb { background: var(--text-muted); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-mature); }

        @media (max-width: 768px) {
            .sidebar { width: 70px; padding: 20px 10px; }
            .sidebar-brand img { max-width: 45px; }
            .sidebar nav a span { display: none; }
            .sidebar nav a { justify-content: center; padding: 15px; }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-brand">
            <a href="/users/index">
                <img src="{{ asset('images/logo.png') }}" alt="Sembakoku">
            </a>
        </div>
        <nav>
            <a href="/users" class="nav-link">
                <i class="fa-solid fa-cash-register"></i>
                <span>Transaksi</span>
            </a>
            <a href="/users/riwayat" class="nav-link">
                <i class="fa-solid fa-history"></i>
                <span>Riwayat</span>
            </a>
        </nav>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

<script>
    // Aktifkan menu otomatis sesuai URL
    document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar nav a');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentUrl) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>

</body>
</html>