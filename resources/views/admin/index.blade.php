@extends('admin.layouts.app')

@section('title', 'Products - Admin Panel')

@section('styles')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        border-bottom: 2px solid #8b0000;
        padding-bottom: 15px;
    }

    h2 {
        color: #1a1a1a;
        font-size: 28px;
        margin: 0;
    }

    .btn-add {
        background: #8b0000;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        background: #a00000;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(139, 0, 0, 0.3);
    }

    .btn-add::before {
        content: '+';
        font-size: 18px;
        font-weight: bold;
    }

    .search-container {
        margin-bottom: 20px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .search-box {
        position: relative;
        width: 350px;
    }

    .search-input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.3s ease;
        outline: none;
        box-sizing: border-box;
    }

    .search-input:focus {
        border-color: #8b0000;
        box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 16px;
        pointer-events: none;
    }

    .clear-search {
        position: absolute;
        right: 35px;
        top: 50%;
        transform: translateY(-50%);
        background: #999;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 14px;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .clear-search:hover {
        background: #666;
    }

    .clear-search.show {
        display: flex;
    }

    .search-results {
        color: #666;
        font-size: 13px;
        margin-top: 10px;
        display: none;
    }

    .table-wrapper {
        width: 100%;
        min-height: 400px;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 20px;
        background-color: white;
        border-radius: 4px;
        overflow: hidden;
        table-layout: fixed;
    }

    th:nth-child(1) { width: 30%; }
    th:nth-child(2) { width: 20%; }
    th:nth-child(3) { width: 15%; }
    th:nth-child(4) { width: 15%; }
    th:nth-child(5) { width: 20%; }

    th {
        background: #2a2a2a;
        color: white;
        padding: 14px 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    td {
        padding: 14px 15px;
        border-bottom: 1px solid #e5e5e5;
        color: #333;
        font-size: 14px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tbody tr {
        transition: all 0.2s ease;
    }

    tbody tr:hover:not(.hidden) {
        background-color: #fafafa;
    }

    tbody tr.hidden {
        display: none !important;
    }

    td img {
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #e5e5e5;
        transition: transform 0.3s ease;
    }

    td img:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-edit {
        background: #555;
        color: white;
        padding: 7px 14px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-edit:hover {
        background: #333;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .btn-edit::before {
        content: '✎';
        font-size: 14px;
    }

    .btn-delete {
        background: #8b0000;
        color: white;
        padding: 7px 14px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-delete:hover {
        background: #a00000;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(139, 0, 0, 0.3);
    }

    .btn-delete::before {
        content: '🗑';
        font-size: 12px;
    }

    .delete-form {
        display: inline;
        margin: 0;
    }

    .price {
        color: #1a1a1a;
        font-weight: 600;
        font-size: 15px;
    }

    .stock {
        background: #f0f0f0;
        color: #333;
        padding: 4px 12px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    .no-image {
        color: #999;
        font-style: italic;
        font-size: 12px;
    }

    .product-name {
        color: #1a1a1a;
        font-weight: 600;
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: #999;
        font-size: 15px;
        display: none;
    }

    .no-results p {
        margin-bottom: 10px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .search-box {
            width: 100%;
        }

        table {
            font-size: 12px;
        }

        th, td {
            padding: 10px 8px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h2>Products Management</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-add">Add Product</a>
    </div>

    <div class="search-container">
        <div class="search-box">
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                placeholder="Search by product name, price, or stock..."
            >
            <button class="clear-search" id="clearSearch">×</button>
            <span class="search-icon"></span>
        </div>
    </div>

    <div class="search-results" id="searchResults"></div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productTable">
                @forelse ($products as $product)
                <tr data-name="{{ strtolower($product->name) }}" 
                    data-price="{{ $product->price }}" 
                    data-stock="{{ $product->stock }}">
                    <td><span class="product-name">{{ $product->name }}</span></td>
                    <td><span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span></td>
                    <td><span class="stock">{{ $product->stock }} pcs</span></td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" width="60" height="60" alt="{{ $product->name }}">
                        @else
                            <span class="no-image">No image</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
                        No products available. Click "Add Product" to create one.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="noResults" class="no-results">
        <p><strong>No products found matching your search.</strong></p>
        <p>Try adjusting your search terms.</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const searchResults = document.getElementById('searchResults');
    const productTable = document.getElementById('productTable');
    const noResults = document.getElementById('noResults');
    const tableWrapper = document.querySelector('.table-wrapper');
    const allRows = productTable.getElementsByTagName('tr');
    const totalProducts = allRows.length;

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        // Show/hide clear button
        if (searchTerm) {
            clearSearch.classList.add('show');
        } else {
            clearSearch.classList.remove('show');
        }

        let visibleCount = 0;

        // Loop through all table rows
        for (let i = 0; i < allRows.length; i++) {
            const row = allRows[i];
            const name = row.getAttribute('data-name') || '';
            const price = row.getAttribute('data-price') || '';
            const stock = row.getAttribute('data-stock') || '';

            // Check if search term matches name, price, or stock
            if (name.includes(searchTerm) || 
                price.includes(searchTerm) || 
                stock.includes(searchTerm)) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        }

        // Update search results text
        if (searchTerm) {
            searchResults.textContent = `Showing ${visibleCount} of ${totalProducts} products`;
            searchResults.style.display = 'block';
        } else {
            searchResults.style.display = 'none';
        }

        // Show/hide no results message
        if (visibleCount === 0 && searchTerm) {
            noResults.style.display = 'block';
            tableWrapper.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            tableWrapper.style.display = 'block';
        }
    }

    // Event listener for search input
    searchInput.addEventListener('input', performSearch);

    // Event listener for clear button
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        clearSearch.classList.remove('show');
        performSearch();
        searchInput.focus();
    });

    // Clear search on Escape key
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            searchInput.value = '';
            clearSearch.classList.remove('show');
            performSearch();
        }
    });
</script>
@endsection