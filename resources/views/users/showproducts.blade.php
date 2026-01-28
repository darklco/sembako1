@extends('users.layout.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #642714;
        --accent: #ec9105;
        --bg-cream: #fff0d2;
        --white: #ffffff;
        --text-muted: #af9b74;
        --border: #f3e5cc;
    }

    body { 
        background-color: var(--bg-cream) !important; 
        font-family: 'Inter', sans-serif;
        color: #1a1a1a;
    }

    .product-detail-container {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Back Button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--white);
        color: var(--primary);
        border: 2px solid var(--border);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        margin-bottom: 32px;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.05);
    }

    .btn-back:hover {
        background: var(--primary);
        color: var(--white);
        border-color: var(--primary);
        transform: translateX(-4px);
    }

    /* Product Detail Card */
    .product-detail-card {
        background: var(--white);
        border-radius: 16px;
        padding: 40px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 16px rgba(100, 39, 20, 0.08);
    }

    .product-detail-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: start;
    }

    /* Image Section */
    .product-image-section {
        position: sticky;
        top: 20px;
    }

    .product-image-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        border-radius: 12px;
        overflow: hidden;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.1);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f8f8 0%, #e9e9e9 100%);
        color: #aaa;
        font-size: 18px;
        font-weight: 500;
    }

    /* Info Section */
    .product-info-section {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .product-name {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
        line-height: 1.3;
    }

    .product-price-box {
        background: linear-gradient(135deg, var(--primary) 0%, #4a1d0f 100%);
        padding: 24px;
        border-radius: 12px;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
    }

    .price-label {
        font-size: 13px;
        color: var(--bg-cream);
        opacity: 0.9;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .product-price {
        font-size: 36px;
        font-weight: 700;
        color: var(--accent);
        margin: 0;
    }

    /* Info Items */
    .info-item {
        background: #fef8ed;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid var(--accent);
    }

    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0 0 8px 0;
    }

    /* Stock Badge */
    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--white);
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        color: var(--primary);
    }

    .stock-badge.in-stock {
        border-color: #10b981;
        background: #ecfdf5;
        color: #065f46;
    }

    .stock-badge.low-stock {
        border-color: #f59e0b;
        background: #fffbeb;
        color: #92400e;
    }

    .stock-badge.out-of-stock {
        border-color: #ef4444;
        background: #fef2f2;
        color: #991b1b;
    }

    .stock-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: currentColor;
    }

    /* Description Box */
    .description-box {
        background: var(--white);
        padding: 24px;
        border-radius: 10px;
        border: 1px solid var(--border);
    }

    .description-label {
        font-size: 15px;
        font-weight: 600;
        color: var(--primary);
        margin: 0 0 12px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .description-text {
        font-size: 15px;
        line-height: 1.8;
        color: #4b5563;
        margin: 0;
        white-space: pre-line;
    }

    /* Divider */
    .divider {
        height: 1px;
        background: linear-gradient(to right, transparent, var(--border), transparent);
        margin: 32px 0;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .product-detail-row {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .product-image-section {
            position: relative;
            top: 0;
        }

        .product-detail-card {
            padding: 24px;
        }

        .product-name {
            font-size: 26px;
        }

        .product-price {
            font-size: 30px;
        }
    }

    @media (max-width: 576px) {
        .product-detail-container {
            padding: 24px 16px;
        }

        .product-detail-card {
            padding: 20px;
        }

        .product-name {
            font-size: 22px;
        }

        .product-price {
            font-size: 26px;
        }

        .product-price-box {
            padding: 20px;
        }

        .info-item {
            padding: 16px;
        }

        .description-box {
            padding: 20px;
        }
    }
</style>

<div class="product-detail-container">
    <a href="{{ route('users.products') }}" class="btn-back">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Kembali
    </a>

    <div class="product-detail-card">
        <div class="product-detail-row">
            <!-- Image Section -->
            <div class="product-image-section">
                <div class="product-image-wrapper">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="product-image">
                    @else
                        <div class="no-image-placeholder">
                            No Image Available
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Section -->
            <div class="product-info-section">
                <h2 class="product-name">{{ $product->name }}</h2>

                <div class="product-price-box">
                    <p class="price-label">Harga Produk</p>
                    <h4 class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h4>
                </div>

                @if($product->description)
                <div class="divider"></div>

                <div class="description-box">
                    <p class="description-label">Deskripsi Produk</p>
                    <p class="description-text">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection