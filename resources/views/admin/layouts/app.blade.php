<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Panel - Dashboard')</title>
    
    <style>
        /* Reset & Base Styles */
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
        
        /* Wrapper menggunakan Flexbox untuk menyejajarkan Sidebar dan Content */
        .main-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Main Content Area - Bagian Utama yang Menghitung Sisa Lebar Layar */
        .main-content {
            flex: 1; /* Mengambil semua sisa ruang di kanan sidebar */
            margin-left: 220px; /* Harus sama dengan lebar sidebar */
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        /* Sidebar Toggle Button (Hanya Muncul di Mobile) */
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

        /* Overlay untuk Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0; /* Sidebar tersembunyi, content jadi full */
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        /* Area untuk CSS tambahan dari halaman lain */
        @yield('styles')
    </style>
</head>
<body>
    <div class="main-wrapper">
        <button class="sidebar-toggle" id="sidebarToggle">☰</button>

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

        // Pastikan element ID 'sidebar' ada di file sidebar.blade.php kamu
        if (sidebarToggle && sidebar && sidebarOverlay) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
        }
    </script>

    @yield('scripts')
</body>
</html>