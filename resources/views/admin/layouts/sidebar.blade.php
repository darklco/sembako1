<aside class="sidebar" id="sidebar">
    <!-- Profile Section -->
@php
    $admin = Auth::user();
@endphp

<a href="{{ route('admin.profile.edit') }}" class="sidebar-profile-link">
    <div class="sidebar-profile">

        {{-- AVATAR --}}
        <div class="avatar-wrapper">
            @if($admin->profile_photo)
                <img src="{{ asset('storage/' . $admin->profile_photo) }}"
                     class="profile-avatar-img"
                     alt="Admin Avatar">
            @else
                <div class="profile-avatar">
                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                </div>
            @endif
            <span class="online-dot"></span>
        </div>

        {{-- INFO --}}
        <div class="profile-info">
            <div class="profile-name">{{ $admin->name }}</div>
            <div class="profile-role">{{ $admin->email }}</div>
        </div>

    </div>
</a>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span>Products</span>
        </a>
        
        <a href="{{ route('admin.transactions.index') }}" class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <span>Transaksi</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="sidebar-footer">
        <a href="{{ route('admin.login') }}" class="logout-button">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            <span>Logout</span>
        </a>
    </div>
</aside>

<style>
    /* Sidebar */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 280px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    /* Profile Link Wrapper */
    .sidebar-profile-link {
        text-decoration: none;
        display: block;
        transition: background 0.2s ease;
    }

    .sidebar-profile-link:hover {
        background: #f5f5f5;
    }

    /* Profile Section */
    .sidebar-profile {
        padding: 32px 24px 28px;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
    }

    /* Avatar Wrapper */
    .avatar-wrapper {
        position: relative;
        width: 72px;
        height: 72px;
        margin: 0 auto 14px;
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 26px;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.25);
    }

    .profile-avatar-img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    /* Online Dot */
    .online-dot {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #22c55e;
        border: 3px solid #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    }

    /* Profile Info */
    .profile-name {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 3px;
        letter-spacing: 0.1px;
    }

    .profile-role {
        font-size: 12.5px;
        color: #737373;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
        margin: 0 auto;
    }

    /* Navigation */
    .sidebar-nav {
        flex: 1;
        padding: 24px 16px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        overflow-y: auto;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        color: #525252;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.2s ease;
        font-size: 15px;
        font-weight: 500;
    }

    .nav-link:hover {
        background: #f5f5f5;
        color: #1a1a1a;
    }

    .nav-link.active {
        background: #dc2626;
        color: #ffffff;
    }

    .nav-icon {
        width: 22px;
        height: 22px;
        flex-shrink: 0;
    }

    /* Footer */
    .sidebar-footer {
        padding: 16px;
        border-top: 1px solid #e5e7eb;
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
        color: #737373;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.2s ease;
        font-size: 15px;
        font-weight: 500;
    }

    .logout-button:hover {
        background: #fef2f2;
        border-color: #dc2626;
        color: #dc2626;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle && sidebar && sidebarOverlay) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });

        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    }
</script>