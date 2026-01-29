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

    .products-container {
        padding: 48px 32px;
        max-width: 1500px;
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
        margin-bottom: 48px;
        position: relative;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 32px;
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
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(236, 145, 5, 0.25);
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
        color: var(--accent);
    }

    /* Search and Filter Section */
    .controls-section {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-bottom: 32px;
    }

    .search-wrapper {
        flex: 1;
        max-width: 600px;
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 18px;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .search-input {
        width: 100%;
        padding: 16px 20px 16px 56px;
        border-radius: 16px;
        border: 2px solid var(--border);
        font-size: 15px;
        font-weight: 500;
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: var(--white);
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.04);
    }

    .search-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(236, 145, 5, 0.12), 0 4px 16px rgba(100, 39, 20, 0.08);
        transform: translateY(-2px);
    }

    .search-input:focus + .search-icon {
        color: var(--accent);
    }

    .search-input::placeholder {
        color: #bbb;
    }

    .view-toggle {
        display: flex;
        gap: 8px;
        background: white;
        padding: 6px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.06);
        border: 1px solid var(--border);
    }

    .view-btn {
        padding: 10px 16px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-size: 16px;
    }

    .view-btn:hover {
        background: var(--bg-cream);
        color: var(--primary);
    }

    .view-btn.active {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(236, 145, 5, 0.3);
    }

    /* Results Info */
    .results-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding: 16px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(100, 39, 20, 0.04);
        border: 1px solid var(--border);
    }

    .results-count {
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .count-number {
        color: var(--accent);
        font-weight: 700;
        font-size: 16px;
    }

    .sort-select {
        padding: 8px 16px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: var(--primary);
        background: white;
        cursor: pointer;
        outline: none;
        transition: all 0.2s ease;
    }

    .sort-select:hover {
        border-color: var(--accent);
    }

    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 24px;
        animation: slideUp 0.8s ease-out 0.2s backwards;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .product-card {
        background: var(--white);
        border: 2px solid transparent;
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.06);
        position: relative;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(236, 145, 5, 0.05) 0%, rgba(100, 39, 20, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
        z-index: 1;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(100, 39, 20, 0.15);
        border-color: var(--accent);
    }

    .product-card:hover::before {
        opacity: 1;
    }

    .product-image-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: linear-gradient(135deg, #fafafa 0%, #f0f0f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover .product-image {
        transform: scale(1.1);
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f8f8 0%, #e9e9e9 100%);
        color: #bbb;
        gap: 12px;
    }

    .no-image-icon {
        font-size: 48px;
        opacity: 0.3;
    }

    .no-image-text {
        font-size: 13px;
        font-weight: 600;
    }

    /* Discount Badge */
    .discount-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 800;
        z-index: 2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .product-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        z-index: 2;
    }

    .product-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
        line-height: 1.4;
        min-height: 48px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .product-card:hover .product-title {
        color: var(--accent);
    }

    .product-footer {
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .price-section {
        flex: 1;
    }

    .price-label {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Original Price (crossed out) */
    .original-price {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
        text-decoration: line-through;
        margin-bottom: 4px;
    }

    /* Discounted Price */
    .product-price {
        font-size: 22px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    /* Price with discount styling */
    .product-price.has-discount {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .savings-label {
        font-size: 11px;
        color: var(--success);
        font-weight: 700;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .view-detail-btn {
        width: 36px;
        height: 36px;
        border: none;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(100, 39, 20, 0.2);
    }

    .view-detail-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(100, 39, 20, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 120px 20px;
        animation: fadeIn 0.8s ease-out;
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
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
    }

    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .header-stats {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 768px) {
        .products-container {
            padding: 32px 20px;
        }

        .header-content {
            flex-direction: column;
        }

        .page-title {
            font-size: 28px;
        }

        .title-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .page-subtitle {
            font-size: 14px;
        }

        .controls-section {
            flex-direction: column;
            align-items: stretch;
        }

        .search-wrapper {
            max-width: 100%;
        }

        .view-toggle {
            align-self: flex-end;
        }

        .results-info {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }

        .product-body {
            padding: 16px;
        }

        .product-title {
            font-size: 15px;
            min-height: auto;
        }

        .product-price {
            font-size: 19px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 24px;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .product-body {
            padding: 14px;
        }

        .product-title {
            font-size: 14px;
        }

        .product-price {
            font-size: 17px;
        }

        .search-input {
            padding: 14px 18px 14px 48px;
            font-size: 14px;
        }

        .stat-badge {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>

<div class="products-container">
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title">
                    <span class="title-icon">
                        <i class="fa-solid fa-store"></i>
                    </span>
                    Katalog Produk
                </h1>
                <p class="page-subtitle">
                    Jelajahi koleksi lengkap produk sembako berkualitas dengan harga terbaik
                </p>
                <div class="header-stats">
                    <span class="stat-badge">
                        <i class="fa-solid fa-box"></i>
                        <span id="totalProducts">{{ $products->count() }}</span> Produk
                    </span>
                    <span class="stat-badge">
                        <i class="fa-solid fa-tag"></i>
                        Harga Terjangkau
                    </span>
                </div>
            </div>
        </div>

        <div class="controls-section">
            <div class="search-wrapper">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="search-input"
                    placeholder="Cari produk berdasarkan nama..."
                >
            </div>

            <div class="view-toggle">
                <button class="view-btn active" data-view="grid">
                    <i class="fa-solid fa-grip"></i>
                </button>
                <button class="view-btn" data-view="list">
                    <i class="fa-solid fa-list"></i>
                </button>
            </div>
        </div>

        <div class="results-info">
            <div class="results-count">
                Menampilkan <span class="count-number" id="countNumber">{{ $products->count() }}</span> produk
            </div>
            <select class="sort-select" id="sortSelect">
                <option value="default">Urutkan: Default</option>
                <option value="name-asc">Nama: A-Z</option>
                <option value="name-desc">Nama: Z-A</option>
                <option value="price-asc">Harga: Terendah</option>
                <option value="price-desc">Harga: Tertinggi</option>
            </select>
        </div>
    </div>

    @if($products->count() > 0)
    <div class="products-grid" id="productsGrid">
        @foreach($products as $product)
        @php
            // Calculate discount
            $hasDiscount = isset($product->discount) && $product->discount > 0;
            $discountedPrice = $hasDiscount ? $product->price - ($product->price * $product->discount / 100) : $product->price;
            $savings = $hasDiscount ? $product->price - $discountedPrice : 0;
        @endphp
        <a href="{{ route('users.showproducts', $product->id) }}" class="product-link" data-product-name="{{ strtolower($product->name) }}" data-product-price="{{ $discountedPrice }}">
            <div class="product-card">
                <div class="product-image-wrapper">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="product-image"
                             loading="lazy">
                    @else
                        <div class="no-image-placeholder">
                            <i class="fa-solid fa-image no-image-icon"></i>
                            <span class="no-image-text">No Image</span>
                        </div>
                    @endif

                    @if($hasDiscount)
                        <div class="discount-badge">
                            <i class="fa-solid fa-fire"></i>
                            {{ $product->discount }}% OFF
                        </div>
                    @endif
                </div>

                <div class="product-body">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    
                    <div class="product-footer">
                        <div class="price-section">
                            <div class="price-label">Harga</div>
                            
                            @if($hasDiscount)
                                <div class="original-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <p class="product-price has-discount">
                                    Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                </p>
                                <div class="savings-label">
                                    <i class="fa-solid fa-piggy-bank"></i>
                                    Hemat Rp {{ number_format($savings, 0, ',', '.') }}
                                </div>
                            @else
                                <p class="product-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>
                        <button class="view-detail-btn" onclick="event.preventDefault(); window.location.href='{{ route('users.showproducts', $product->id) }}'">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fa-solid fa-box-open"></i>
        </div>
        <p class="empty-state-text">Belum ada produk tersedia</p>
        <p class="empty-state-subtext">Silakan cek kembali nanti untuk produk terbaru</p>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputCari = document.getElementById('searchInput');
    const productsGrid = document.getElementById('productsGrid');
    const productLinks = document.querySelectorAll('.product-link');
    const countNumber = document.getElementById('countNumber');
    const sortSelect = document.getElementById('sortSelect');
    const viewBtns = document.querySelectorAll('.view-btn');

    // Search functionality with debounce
    let searchTimeout;
    
    if (inputCari) {
        inputCari.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const term = e.target.value.toLowerCase().trim();
                let visibleCount = 0;

                productLinks.forEach(link => {
                    const namaProduk = link.getAttribute('data-product-name');
                    const isVisible = namaProduk.includes(term);
                    link.style.display = isVisible ? 'block' : 'none';
                    
                    if (isVisible) visibleCount++;
                });

                countNumber.textContent = visibleCount;
            }, 300);
        });

        // Clear search on ESC
        inputCari.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                inputCari.value = '';
                inputCari.dispatchEvent(new Event('input'));
                inputCari.blur();
            }
        });
    }

    // Sort functionality
    if (sortSelect) {
        sortSelect.addEventListener('change', (e) => {
            const sortType = e.target.value;
            const productsArray = Array.from(productLinks);
            
            productsArray.sort((a, b) => {
                const nameA = a.getAttribute('data-product-name');
                const nameB = b.getAttribute('data-product-name');
                const priceA = parseFloat(a.getAttribute('data-product-price'));
                const priceB = parseFloat(b.getAttribute('data-product-price'));
                
                switch(sortType) {
                    case 'name-asc':
                        return nameA.localeCompare(nameB);
                    case 'name-desc':
                        return nameB.localeCompare(nameA);
                    case 'price-asc':
                        return priceA - priceB;
                    case 'price-desc':
                        return priceB - priceA;
                    default:
                        return 0;
                }
            });
            
            // Re-append sorted elements
            productsArray.forEach(link => {
                productsGrid.appendChild(link);
            });
        });
    }

    // View toggle functionality
    viewBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            viewBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const view = btn.getAttribute('data-view');
            if (view === 'list') {
                productsGrid.style.gridTemplateColumns = '1fr';
                productLinks.forEach(link => {
                    link.querySelector('.product-card').style.flexDirection = 'row';
                    link.querySelector('.product-image-wrapper').style.aspectRatio = '1 / 1';
                    link.querySelector('.product-image-wrapper').style.maxWidth = '200px';
                });
            } else {
                productsGrid.style.gridTemplateColumns = '';
                productLinks.forEach(link => {
                    link.querySelector('.product-card').style.flexDirection = 'column';
                    link.querySelector('.product-image-wrapper').style.aspectRatio = '1 / 1';
                    link.querySelector('.product-image-wrapper').style.maxWidth = '';
                });
            }
        });
    });

    // Lazy loading animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 50);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    productLinks.forEach(link => {
        link.style.opacity = '0';
        link.style.transform = 'translateY(20px)';
        link.style.transition = 'all 0.5s ease-out';
        observer.observe(link);
    });
});
</script>

@endsection