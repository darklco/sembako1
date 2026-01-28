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

    .products-container {
        padding: 40px 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 40px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 8px 0;
    }

    .page-subtitle {
        font-size: 16px;
        color: var(--text-muted);
        margin: 0;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .product-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.05);
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(100, 39, 20, 0.15);
        border-color: var(--accent);
    }

    .product-image-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f8f8 0%, #e9e9e9 100%);
        color: #aaa;
        font-size: 13px;
        font-weight: 500;
    }

    .product-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--primary);
        margin: 0 0 10px 0;
        line-height: 1.4;
        min-height: 44px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-description {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
        margin: 0 0 12px 0;
        flex: 1;
    }

    .product-price {
        font-size: 20px;
        font-weight: 700;
        color: var(--accent);
        margin: 0;
    }

    .price-label {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Badge/Tag styles (optional) */
    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--accent);
        color: white;
        padding: 5px 10px;
        border-radius: 16px;
        font-size: 11px;
        font-weight: 600;
        z-index: 1;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: var(--text-muted);
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 18px;
        font-weight: 500;
    }

    .search-wrapper {
    margin-top: 20px;
    max-width: 400px;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid var(--border);
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 2px rgba(236, 145, 5, 0.2);
    }


    /* Responsive */
    @media (max-width: 768px) {
        .products-container {
            padding: 24px 16px;
        }

        .page-title {
            font-size: 26px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 14px;
        }

        .product-body {
            padding: 14px;
        }

        .product-title {
            font-size: 14px;
            min-height: auto;
        }

        .product-price {
            font-size: 17px;
        }

        .product-description {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="products-container">
    <div class="page-header">
        <h2 class="page-title">Katalog Produk Sembakoku</h2>
        <p class="page-subtitle">Temukan produk kebutuhan sembako berkualitas</p>
    </div>

    <div class="search-wrapper">
    <input 
        type="text" 
        id="searchInput" 
        class="search-input"
        placeholder="Cari produk..."
    >
    </div>

    @if($products->count() > 0)
    <div class="products-grid">
        @foreach($products as $product)
        <a href="{{ route('users.showproducts', $product->id) }}" class="product-link">
            <div class="product-card">
                <div class="product-image-wrapper">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="product-image">
                    @else
                        <div class="no-image-placeholder">
                            No Image
                        </div>
                    @endif
                </div>

                <div class="product-body">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    
                    <div>
                        <div class="price-label">Harga</div>
                        <p class="product-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">📦</div>
        <p class="empty-state-text">Belum ada produk tersedia</p>
    </div>
    @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputCari = document.getElementById('searchInput');

    if (inputCari) {
        inputCari.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();

            document.querySelectorAll('.product-card').forEach(card => {
                const namaProduk = card
                    .querySelector('.product-title')
                    .innerText
                    .toLowerCase();

                card.parentElement.style.display = namaProduk.includes(term)
                    ? 'block'
                    : 'none';
            });
        });
    }
});
</script>

@endsection
