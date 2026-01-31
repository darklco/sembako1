<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Panel - Dashboard')</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1a1a1a;
            overflow-x: hidden;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            position: relative; /* Tambahkan ini */
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px; /* Tambahkan padding */
            min-height: 100vh;
            background-color: #f8fafc;
            transition: margin-left 0.3s ease;
            position: relative; /* Tambahkan ini */
            z-index: 1; /* Pastikan di atas overlay */
        }

        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: #8b0000;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            pointer-events: none; /* PENTING: Nonaktifkan click di desktop */
        }

        .sidebar-overlay.active {
            pointer-events: auto; /* Aktifkan hanya saat mobile menu terbuka */
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 24px;
            }

            .sidebar-toggle {
                display: block;
            }
        }

        @yield('styles')
    </style>
</head>
<body>
    <div class="main-wrapper">
        <button class="sidebar-toggle" id="sidebarToggle" type="button">☰</button>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        @include('admin.layouts.sidebar')

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle && sidebar && sidebarOverlay) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault(); // Tambahkan ini
                e.stopPropagation(); // Tambahkan ini
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            });

            sidebarOverlay.addEventListener('click', function(e) {
                e.preventDefault(); // Tambahkan ini
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
        }

        // Debug: Cek apakah ada event listener yang tidak diinginkan
        document.addEventListener('click', function(e) {
            console.log('Clicked element:', e.target);
        }, true);
    </script>

    @yield('scripts')
</body>
</html>