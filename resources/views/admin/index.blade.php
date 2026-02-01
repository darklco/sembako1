@extends('admin.layouts.app')

@section('title', 'Products - Admin Panel')

@section('styles')
<style>
    .products-container {
        padding: 0px;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .header-left h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 8px 0;
    }

    .header-left p {
        font-size: 15px;
        color: #737373;
        margin: 0;
    }

    .btn-add {
        background: #dc2626;
        color: white !important;
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-add:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }

    /* Alert Styles */
    .alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #86efac;
    }

    .alert-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    .alert-success .alert-icon {
        color: #16a34a;
    }

    .alert-content {
        flex: 1;
    }

    .alert-content strong {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
        color: #16a34a;
    }

    .alert-content p {
        margin: 0;
        font-size: 14px;
        color: #525252;
    }

    .alert-close {
        background: none;
        border: none;
        font-size: 24px;
        color: #737373;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .alert-close:hover {
        color: #1a1a1a;
    }

    .content-card {
        background: #ffffff;
        border: 1px solid #e8e8e8;
        border-radius: 8px;
        overflow: hidden;
    }

    .card-header {
        padding: 24px;
        border-bottom: 1px solid #e8e8e8;
    }

    .search-input {
        width: 100%;
        max-width: 400px;
        padding: 12px 16px;
        border: 1px solid #e8e8e8;
        border-radius: 6px;
        font-size: 14px;
        color: #1a1a1a;
        outline: none;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .search-input::placeholder {
        color: #a3a3a3;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #fafafa;
    }

    th {
        padding: 16px 24px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #525252;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e8e8e8;
    }

    tbody tr {
        transition: background-color 0.15s ease;
    }

    tbody tr:hover {
        background: #fafafa;
    }

    td {
        padding: 16px 24px;
        border-bottom: 1px solid #f5f5f5;
        font-size: 14px;
        color: #1a1a1a;
    }

    .product-name {
        font-weight: 600;
        color: #1a1a1a;
    }

    .price-wrapper {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .product-price {
        font-weight: 600;
        color: #1a1a1a;
        font-size: 15px;
    }

    .original-price {
        font-size: 13px;
        color: #a3a3a3;
        text-decoration: line-through;
    }

    .discount-badge {
        display: inline-block;
        background: #dc2626;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .no-discount {
        display: inline-block;
        color: #a3a3a3;
        font-size: 13px;
    }

    .stock-badge {
        display: inline-block;
        background: #f5f5f5;
        color: #525252;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
    }

    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #e8e8e8;
    }

    .no-image {
        display: inline-block;
        width: 50px;
        height: 50px;
        background: #f5f5f5;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        color: #a3a3a3;
        border: 1px solid #e8e8e8;
    }

    .action-buttons {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .btn-edit {
        color: #525252;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.2s ease;
    }

    .btn-edit:hover {
        color: #1a1a1a;
    }

    .btn-delete {
        color: #dc2626;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
        font-weight: 500;
        font-size: 14px;
        font-family: inherit;
        transition: color 0.2s ease;
    }

    .btn-delete:hover {
        color: #b91c1c;
    }

    .empty-state,
    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: #737373;
    }

    .empty-state p,
    .no-results p {
        margin: 0;
        font-size: 15px;
    }

    .no-results {
        display: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .products-container {
            padding: 24px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .header-left h1 {
            font-size: 24px;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .search-input {
            max-width: 100%;
        }

        th, td {
            padding: 12px 16px;
            font-size: 13px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 8px;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
<div class="products-container">
    <div class="page-header">
        <div class="header-left">
            <h1>Products Management</h1>
            <p>Kelola semua produk Anda</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-add">
            + Tambah Produk Baru
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="alert alert-success" id="successAlert">
        <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="alert-content">
            <strong>Berhasil!</strong>
            <p>{{ session('success') }}</p>
        </div>
        <button class="alert-close" onclick="closeAlert()">×</button>
    </div>
    @endif

    <div class="content-card">
        <div class="card-header">
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                onkeyup="filterTabel()" 
                placeholder="Cari produk berdasarkan nama...">
        </div>

        <div class="table-wrapper">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @forelse ($products as $product)
                    @php
                        $discountedPrice = $product->price;
                        if ($product->discount && $product->discount > 0) {
                            $discountedPrice = $product->price - ($product->price * $product->discount / 100);
                        }
                    @endphp
                    <tr class="baris-produk">
                        <td>
                            <span class="product-name nama-target">{{ $product->name }}</span>
                        </td>
                        <td>
                            <div class="price-wrapper">
                                <span class="product-price">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                @if($product->discount && $product->discount > 0)
                                    <span class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($product->discount && $product->discount > 0)
                                <span class="discount-badge">{{ $product->discount }}%</span>
                            @else
                                <span class="no-discount">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="stock-badge">{{ $product->stock }} pcs</span>
                        </td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" class="product-image" alt="{{ $product->name }}">
                            @else
                                <div class="no-image">No Image</div>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" style="margin: 0;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <p>Belum ada produk. Mulai tambahkan produk pertama Anda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="noResults" class="no-results">
            <p>Produk tidak ditemukan</p>
        </div>
    </div>
</div>

<script>
    function filterTabel() {
        var input = document.getElementById("searchInput");
        var filter = input.value.toLowerCase().trim();
        var rows = document.getElementsByClassName("baris-produk");
        var foundCount = 0;

        for (var i = 0; i < rows.length; i++) {
            var namaKolom = rows[i].getElementsByClassName("nama-target")[0];
            if (namaKolom) {
                var txtValue = namaKolom.textContent || namaKolom.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        var noResults = document.getElementById("noResults");
        var mainTable = document.getElementById("mainTable");
        
        if (foundCount === 0 && filter !== "") {
            noResults.style.display = "block";
            mainTable.style.display = "none";
        } else {
            noResults.style.display = "none";
            mainTable.style.display = "table";
        }
    }

    function closeAlert() {
        const alert = document.getElementById('successAlert');
        if (alert) {
            alert.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }
    }

    // Auto close success alert after 5 seconds
    setTimeout(() => {
        closeAlert();
    }, 5000);
</script>
@endsection