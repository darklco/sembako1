<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: #ffffff;
            padding: 0;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
            overflow-y: auto;
            border-right: 1px solid #e5e7eb;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 30px;
            width: calc(100% - 280px);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Profile Section at Top Center */
        .sidebar-profile {
            padding: 40px 30px 30px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #8b0000 0%, #ae1111 100%);
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 32px;
            color: #8b0000;
            margin: 0 auto 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profile-info {
            color: #ffffff;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .profile-email {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 400;
        }

        .profile-role {
            display: inline-block;
            margin-top: 12px;
            padding: 4px 14px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
            backdrop-filter: blur(10px);
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            color: #6b7280;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 0 24px 12px;
        }

        .nav-item {
            margin-bottom: 2px;
            padding: 0 16px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: #4b5563;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-size: 14.5px;
            font-weight: 500;
            position: relative;
        }

        .nav-link:hover {
            background: #f3f4f6;
            color: #667eea;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.25);
        }

        .nav-icon {
            font-size: 20px;
            width: 24px;
            text-align: center;
            opacity: 0.9;
        }

        .nav-badge {
            margin-left: auto;
            background: #667eea;
            color: white;
            font-size: 10px;
            padding: 3px 9px;
            border-radius: 12px;
            font-weight: 700;
        }

        .nav-link.active .nav-badge {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 24px;
            border-top: 1px solid #e5e7eb;
            background: #ffffff;
        }

        .logout-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            background: #ffffff;
            border: 1.5px solid #e5e7eb;
            color: #6b7280;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Mobile Toggle Button */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* Content Styling */
        .content-header {
            margin-bottom: 30px;
        }

        .content-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .content-subtitle {
            font-size: 15px;
            color: #6b7280;
        }

        .demo-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button (Mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Profile Section -->
            <div class="sidebar-profile">
                <div class="profile-avatar">AD</div>
                <div class="profile-info">
                    <div class="profile-name">Admin User</div>
                    <div class="profile-email">admin@gmail.com</div>
                    <div class="profile-role">Administrator</div>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="sidebar-nav">
                <!-- Management Section -->
                <div class="nav-section">
                    <div class="nav-section-title">Management</div>
                    <div class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link">
                            <span>Products</span>
                        </a>
                    </div>
                    <div class="nav-item">
                    <a href="{{ route('admin.transactions.index') }}" class="nav-link">
                  <span>History Transaksi</span> 
                 </a>
                </div>
                </div>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <a href="{{ route('admin.login') }}" class="nav-link">
                <button class="logout-button">
                    <span>Logout</span>
                </button>
            </div>
        </aside>

    <script>
        // Sidebar Toggle Functionality for Mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });

        // Close sidebar when clicking a link on mobile
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>