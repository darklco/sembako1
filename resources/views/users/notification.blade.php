@extends('users.layout.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --primary: #642714;
        --primary-dark: #4a1d0f;
        --accent: #ec9105;
        --accent-dark: #d17f04;
        --bg-cream: #fff0d2;
        --white: #ffffff;
        --text-dark: #1a1a1a;
        --text-muted: #af9b74;
        --border: #f3e5cc;
        --danger: #ef4444;
        --success: #059669;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body { 
        background: linear-gradient(135deg, #fff8e7 0%, var(--bg-cream) 100%) !important;
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
    }

    .notification-container {
        padding: 48px 32px;
        max-width: 1200px;
        margin: 0 auto;
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header Section */
    .page-header {
        margin-bottom: 40px;
        position: relative;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .header-left {
        flex: 1;
    }

    .page-title {
        font-size: 38px;
        font-weight: 800;
        color: var(--primary);
        margin: 0 0 12px 0;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .title-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .page-subtitle {
        font-size: 16px;
        color: var(--text-muted);
        margin: 0;
        font-weight: 500;
        line-height: 1.6;
    }

    .header-stats {
        display: flex;
        gap: 16px;
        margin-top: 8px;
    }

    .stat-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: var(--primary);
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.06);
        border: 1px solid var(--border);
    }

    .stat-badge i {
        color: var(--danger);
    }

    .stat-badge.active {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        color: white;
        border-color: var(--danger);
    }

    .stat-badge.active i {
        color: white;
    }

    /* Back Button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: white;
        color: var(--primary);
        border: 2px solid var(--border);
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.06);
    }

    .btn-back:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateX(-6px);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.15);
    }

    .btn-back i {
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .btn-back:hover i {
        transform: translateX(-4px);
    }

    /* Notifications Grid */
    .notifications-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    /* Notification Card Link */
    .notif-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .notif-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.06);
        border: 2px solid transparent;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        animation: slideIn 0.5s ease-out backwards;
        height: 100%;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .notif-card-link:nth-child(1) .notif-card { animation-delay: 0.1s; }
    .notif-card-link:nth-child(2) .notif-card { animation-delay: 0.2s; }
    .notif-card-link:nth-child(3) .notif-card { animation-delay: 0.3s; }
    .notif-card-link:nth-child(4) .notif-card { animation-delay: 0.4s; }
    .notif-card-link:nth-child(5) .notif-card { animation-delay: 0.5s; }
    .notif-card-link:nth-child(6) .notif-card { animation-delay: 0.6s; }

    .notif-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, var(--danger) 0%, #dc2626 100%);
    }

    .notif-card-link:hover .notif-card {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(239, 68, 68, 0.15);
        border-color: var(--danger);
    }

    .notif-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #fff5f5 0%, #fee2e2 100%);
        border-bottom: 1px solid rgba(239, 68, 68, 0.1);
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .notif-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .notif-title-section {
        flex: 1;
    }

    .notif-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 6px 0;
        line-height: 1.3;
    }

    .notif-time {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .notif-body {
        padding: 24px;
        flex: 1;
    }

    .discount-section {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .discount-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: shimmer 8s infinite linear;
    }

    @keyframes shimmer {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .discount-label {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .discount-value {
        font-size: 48px;
        font-weight: 800;
        color: white;
        line-height: 1;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }

    .discount-text {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        margin-top: 8px;
    }

    .price-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        background: linear-gradient(135deg, #fffbf0 0%, #fff8e7 100%);
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .price-info {
        flex: 1;
    }

    .price-label {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .original-price {
        font-size: 14px;
        color: var(--text-muted);
        text-decoration: line-through;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .final-price {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .savings-badge {
        background: linear-gradient(135deg, var(--success) 0%, #047857 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    /* Notification Footer */
    .notif-footer {
        padding: 16px 24px;
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .notif-card-link:hover .notif-footer {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }

    .view-detail-text {
        font-size: 13px;
        font-weight: 600;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .notif-card-link:hover .view-detail-text {
        color: white;
    }

    .arrow-icon {
        font-size: 16px;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .notif-card-link:hover .arrow-icon {
        color: white;
        transform: translateX(4px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 120px 20px;
        background: white;
        border-radius: 18px;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.06);
    }

    .empty-state-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #f8f8f8 0%, #e9e9e9 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #ccc;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .empty-state-text {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .empty-state-subtext {
        font-size: 15px;
        color: var(--text-muted);
        opacity: 0.7;
        margin-bottom: 24px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .notifications-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .notification-container {
            padding: 32px 20px;
        }

        .page-title {
            font-size: 28px;
        }

        .title-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .notifications-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .header-stats {
            flex-wrap: wrap;
        }

        .discount-value {
            font-size: 40px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 24px;
        }

        .notif-header {
            padding: 16px 20px;
        }

        .notif-body {
            padding: 20px;
        }

        .discount-value {
            font-size: 36px;
        }

        .final-price {
            font-size: 20px;
        }

        .price-section {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .savings-badge {
            align-self: stretch;
            justify-content: center;
        }
    }
</style>

<div class="notification-container">
    <div class="page-header">
        {{-- <a href="/" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Home</span>
        </a> --}}

        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title">
                    <span class="title-icon">
                        <i class="fa-solid fa-bell"></i>
                    </span>
                    Notifikasi Promo
                </h1>
                <p class="page-subtitle">
                    Jangan lewatkan penawaran spesial dan diskon menarik untuk produk pilihan
                </p>
                <div class="header-stats">
                    {{-- <span class="stat-badge {{ $notifications->isEmpty() ? '' : 'active' }}">
                        <i class="fa-solid fa-tag"></i>
                        <span>{{ $notifications->count() }}</span> Promo Aktif
                    </span>
                    <span class="stat-badge">
                        <i class="fa-solid fa-fire"></i>
                        Penawaran Terbatas
                    </span> --}}
                </div>
            </div>
        </div>
    </div>

    @if($notifications->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fa-solid fa-bell-slash"></i>
            </div>
            <p class="empty-state-text">Tidak ada promo saat ini</p>
            <p class="empty-state-subtext">Kembali lagi nanti untuk penawaran menarik</p>
            {{-- <a href="/" class="btn-back" style="margin-top: 24px; display: inline-flex;">
                <i class="fa-solid fa-home"></i>
                <span>Kembali ke Home</span>
            </a> --}}
        </div>
    @else
        <div class="notifications-grid">
            @foreach($notifications as $product)
                @php
                    $discountedPrice = $product->price - ($product->price * $product->discount / 100);
                    $savings = $product->price - $discountedPrice;
                @endphp
                <a href="{{ route('users.showproducts', $product->id) }}" class="notif-card-link">
                    <div class="notif-card">
                        <div class="notif-header">
                            <div class="notif-icon">
                                <i class="fa-solid fa-fire"></i>
                            </div>
                            <div class="notif-title-section">
                                <h3 class="notif-title">{{ $product->name }}</h3>
                                <div class="notif-time">
                                    <i class="fa-solid fa-clock"></i>
                                    {{ $product->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        <div class="notif-body">
                            <div class="discount-section">
                                <div class="discount-label">Diskon Spesial</div>
                                <div class="discount-value">{{ $product->discount }}%</div>
                                <div class="discount-text">OFF</div>
                            </div>

                            <div class="price-section">
                                <div class="price-info">
                                    <div class="price-label">Harga Normal</div>
                                    <div class="original-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                    <div class="final-price">
                                        Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="savings-badge">
                                    <i class="fa-solid fa-piggy-bank"></i>
                                    Hemat Rp {{ number_format($savings, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="notif-footer">
                            <span class="view-detail-text">
                                <i class="fa-solid fa-eye"></i>
                                Lihat Detail Produk
                            </span>
                            <i class="fa-solid fa-arrow-right arrow-icon"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

@endsection