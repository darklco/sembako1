<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
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
        width: 220px;
        background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
        padding: 20px 0;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .main-content {
        margin-left: 220px;
        flex: 1;
        padding: 20px;
        width: calc(100% - 220px);
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #2d2d2d;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #8b0000;
        border-radius: 3px;
    }

    .sidebar-header {
        padding: 0 20px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 20px;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .sidebar-logo:hover {
        transform: translateX(5px);
    }

    .logo-icon {
        width: 40px;
        height: 40px;
        background: #8b0000;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    .logo-text {
        display: flex;
        flex-direction: column;
    }

    .logo-title {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .logo-subtitle {
        font-size: 11px;
        color: #999;
        letter-spacing: 1px;
    }

    .sidebar-nav {
        padding: 0 10px;
    }

    .nav-section {
        margin-bottom: 25px;
    }

    .nav-section-title {
        color: #999;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0 15px 10px;
    }

    .nav-item {
        margin-bottom: 5px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        color: #ccc;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
        position: relative;
    }

    .nav-link:hover {
        background: rgba(139, 0, 0, 0.2);
        color: white;
        transform: translateX(5px);
    }

    .nav-link.active {
        background: #8b0000;
        color: white;
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 60%;
        background: white;
        border-radius: 0 2px 2px 0;
    }

    .nav-icon {
        font-size: 18px;
        width: 20px;
        text-align: center;
    }

    .nav-badge {
        margin-left: auto;
        background: #8b0000;
        color: white;
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: 600;
    }

    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background: #1a1a1a;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        padding: 10px;
        border-radius: 8px;
    }

    .user-profile:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #8b0000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-size: 14px;
        font-weight: 600;
        display: block;
    }

    .user-role {
        font-size: 11px;
        color: #999;
    }

    .logout-icon {
        color: #999;
        font-size: 18px;
    }

    /* Mobile Toggle Button */
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1001;
        background: #8b0000;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
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

<!-- Sidebar Toggle Button (Mobile) -->
<button class="sidebar-toggle" id="sidebarToggle">☰</button>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        {{-- <a href="{{ route('admin.dashboard') }}" class="sidebar-logo"> --}}
            <div class="logo-icon">A</div>
            <div class="logo-text">
                <span class="logo-title">Admin Panel</span>
                <span class="logo-subtitle">DASHBOARD</span>
            </div>
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <!-- Main Section -->
        {{-- <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    <span>Dashboard</span>
                </a>
            </div>
        </div> --}}

        <!-- Management Section -->
        <div class="nav-section">
            <div class="nav-section-title">Management</div>
            <div class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <span class="nav-icon">📦</span>
                    <span>Dashboard</span>
                    {{-- <span class="nav-badge">{{ $products->count() ?? 0 }}</span> --}}
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create*') ? 'active' : '' }}">
                    <span class="nav-icon">🏷️</span>
                    <span>Products</span>
                </a>
            </div>
            {{-- <div class="nav-item"> 
                {{-- <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span class="nav-icon">🛒</span>
                    <span>Orders</span>
                </a>
            </div> --}}
            {{-- <div class="nav-item">
                <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span>
                    <span>Customers</span>
                </a>
            </div>
        </div> --}}

        <!-- Reports Section -->
        {{-- <div class="nav-section">
            <div class="nav-section-title">Reports</div>
            <div class="nav-item">
                <a href="{{ route('admin.reports.sales') }}" class="nav-link {{ request()->routeIs('admin.reports.sales') ? 'active' : '' }}">
                    <span class="nav-icon">📈</span>
                    <span>Sales Report</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.reports.inventory') }}" class="nav-link {{ request()->routeIs('admin.reports.inventory') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span>
                    <span>Inventory</span>
                </a>
            </div>
        </div> --}}

        <!-- Settings Section -->
        {{-- <div class="nav-section">
            <div class="nav-section-title">Settings</div>
            <div class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <span class="nav-icon">⚙️</span>
                    <span>Settings</span>
                </a>
            </div>
        </div>
    </nav> --}}

    <!-- Sidebar Footer -->
    {{-- <div class="sidebar-footer">
        <a href="{{ route('admin.profile') }}" class="user-profile">
            <div class="user-avatar">AD</div>
            <div class="user-info">
                <span class="user-name">Admin User</span>
                <span class="user-role">Administrator</span>
            </div>
            <span class="logout-icon">→</span>
        </a>
    </div> --}}
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