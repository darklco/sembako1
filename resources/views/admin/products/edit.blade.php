@extends('admin.layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Edit Product</h1>
        <p>Perbarui informasi produk</p>
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

    <!-- Alert Error -->
    @if($errors->any())
    <div class="alert alert-error" id="errorAlert">
        <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="alert-content">
            <strong>Error!</strong>
            <p>Terdapat kesalahan pada inputan Anda:</p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button class="alert-close" onclick="closeErrorAlert()">×</button>
    </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <!-- Left Column -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="name">Nama Produk <span class="required">*</span></label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="@error('name') input-error @enderror"
                               placeholder="Masukkan nama produk" 
                               value="{{ old('name', $product->name) }}" 
                               required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi <span class="required">*</span></label>
                        <textarea id="description" 
                                  name="description" 
                                  class="@error('description') input-error @enderror"
                                  placeholder="Masukkan deskripsi produk" 
                                  rows="5" 
                                  required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Checkbox Barang Titipan -->
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   id="is_consignment" 
                                   name="is_consignment" 
                                   value="1"
                                   {{ old('is_consignment', $product->is_consignment ?? 0) ? 'checked' : '' }}>
                            <span>Barang Titipan</span>
                        </label>
                        <span class="help-text">
                            Centang jika produk ini merupakan barang titipan
                        </span>
                    </div>

                    <!-- Form Normal (Price & Discount) -->
                    <div id="normalPriceForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="price">Harga (Rp) <span class="required">*</span></label>
                                <input type="number" 
                                       id="price" 
                                       name="price" 
                                       class="@error('price') input-error @enderror"
                                       placeholder="0" 
                                       min="0" 
                                       step="1"
                                       value="{{ old('price', $product->price) }}">
                                @error('price')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stock">Stok <span class="required">*</span></label>
                                <input type="number" 
                                       id="stock" 
                                       name="stock" 
                                       class="@error('stock') input-error @enderror"
                                       placeholder="0" 
                                       min="0" 
                                       step="1"
                                       value="{{ old('stock', $product->stock) }}" 
                                       required>
                                @error('stock')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="discount">Diskon (%)</label>
                            <input type="number" 
                                   id="discount" 
                                   name="discount" 
                                   class="@error('discount') input-error @enderror"
                                   placeholder="0" 
                                   min="0" 
                                   max="100" 
                                   step="0.01"
                                   value="{{ old('discount', $product->discount ?? 0) }}">
                            <span class="help-text">Masukkan nilai diskon dalam persen (0-100)</span>
                            @error('discount')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price Preview -->
                        <div class="price-preview" id="pricePreview" style="display: none;">
                            <div class="price-preview-item">
                                <span class="preview-label">Harga Normal:</span>
                                <span class="preview-value" id="normalPrice">Rp 0</span>
                            </div>
                            <div class="price-preview-item">
                                <span class="preview-label">Diskon:</span>
                                <span class="preview-value discount-value" id="discountAmount">- Rp 0</span>
                            </div>
                            <div class="price-preview-item final">
                                <span class="preview-label">Harga Setelah Diskon:</span>
                                <span class="preview-value final-price" id="finalPrice">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Consignment (Original Price & Profit) -->
                    <div id="consignmentForm" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="original_price">Harga Modal (Rp) <span class="required">*</span></label>
                                <input type="number" 
                                       id="original_price" 
                                       name="original_price" 
                                       class="@error('original_price') input-error @enderror"
                                       placeholder="0" 
                                       min="0" 
                                       step="1"
                                       value="{{ old('original_price', $product->original_price ?? '') }}">
                                <span class="help-text">Harga modal dari pemilik barang</span>
                                @error('original_price')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="profit">Keuntungan (Rp) <span class="required">*</span></label>
                                <input type="number" 
                                       id="profit" 
                                       name="profit" 
                                       class="@error('profit') input-error @enderror"
                                       placeholder="0" 
                                       min="0" 
                                       step="1"
                                       value="{{ old('profit', $product->profit ?? '') }}">
                                <span class="help-text">Keuntungan yang diinginkan</span>
                                @error('profit')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stock_consignment">Stok <span class="required">*</span></label>
                            <input type="number" 
                                   id="stock_consignment" 
                                   name="stock_consignment"
                                   class="@error('stock') input-error @enderror"
                                   placeholder="0" 
                                   min="0" 
                                   step="1"
                                   value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Consignment Price Preview -->
                        <div class="price-preview">
                            <div class="price-preview-item">
                                <span class="preview-label">Harga Modal:</span>
                                <span class="preview-value" id="consignmentOriginal">Rp 0</span>
                            </div>
                            <div class="price-preview-item">
                                <span class="preview-label">Keuntungan:</span>
                                <span class="preview-value" id="consignmentProfit">+ Rp 0</span>
                            </div>
                            <div class="price-preview-item final">
                                <span class="preview-label">Harga Jual:</span>
                                <span class="preview-value final-price" id="consignmentPrice">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Image Upload -->
                <div class="form-column">
                    <div class="form-group">
                        <label>Gambar Produk</label>
                        <div class="image-upload-wrapper @error('image') upload-error @enderror">
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif" 
                                   onchange="previewImage(event)">
                            
                            @if($product->image)
                            <!-- Current Image -->
                            <div class="image-preview" id="currentImage">
                                <img id="currentPreview" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                <div class="image-badge">Gambar Saat Ini</div>
                                <button type="button" class="change-image" onclick="triggerFileInput()">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Ganti Gambar
                                </button>
                            </div>
                            @else
                            <!-- Upload Label if no image -->
                            <label for="image" class="image-upload-label" id="uploadLabel">
                                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <span class="upload-text">Klik untuk upload gambar</span>
                                <span class="upload-hint">PNG, JPG, GIF (Max 2MB)</span>
                            </label>
                            @endif
                            
                            <!-- New Image Preview -->
                            <div class="image-preview" id="newImagePreview" style="display: none;">
                                <img id="preview" src="" alt="Preview">
                                <div class="image-badge new-badge">Gambar Baru</div>
                                <button type="button" class="remove-image" onclick="removeImage()">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <span class="help-text">Kosongkan jika tidak ingin mengubah gambar</span>
                        @error('image')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px;
    }

    .page-header {
        margin-bottom: 32px;
    }

    .page-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 8px 0;
    }

    .page-header p {
        font-size: 15px;
        color: #737373;
        margin: 0;
    }

    /* Alert Styles */
    .alert {
        display: flex;
        align-items: flex-start;
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

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fca5a5;
    }

    .alert-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        margin-right: 12px;
    }

    .alert-success .alert-icon {
        color: #16a34a;
    }

    .alert-error .alert-icon {
        color: #dc2626;
    }

    .alert-content {
        flex: 1;
    }

    .alert-content strong {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .alert-success .alert-content strong {
        color: #16a34a;
    }

    .alert-error .alert-content strong {
        color: #dc2626;
    }

    .alert-content p,
    .alert-content ul {
        margin: 0;
        font-size: 14px;
        color: #525252;
    }

    .alert-content ul {
        list-style: none;
        padding-left: 0;
        margin-top: 8px;
    }

    .alert-content li {
        padding-left: 20px;
        position: relative;
        margin-bottom: 4px;
    }

    .alert-content li::before {
        content: "•";
        position: absolute;
        left: 8px;
        color: #dc2626;
        font-weight: bold;
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
        margin-left: 12px;
    }

    .alert-close:hover {
        color: #1a1a1a;
    }

    /* Form Container */
    .form-container {
        background: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 32px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 32px;
        margin-bottom: 32px;
    }

    .form-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-weight: 500 !important;
    }

    .checkbox-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .required {
        color: #dc2626;
    }

    .help-text {
        font-size: 12px;
        color: #737373;
        font-style: italic;
    }

    /* Error Message Styles */
    .error-message {
        font-size: 12px;
        color: #dc2626;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
        animation: shake 0.3s ease;
    }

    .error-message::before {
        content: "⚠";
        font-size: 14px;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Input Error State */
    .input-error {
        border-color: #dc2626 !important;
        background-color: #fef2f2 !important;
    }

    .input-error:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2) !important;
    }

    textarea {
        resize: vertical;
    }

    /* Price Preview */
    .price-preview {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 16px;
    }

    .price-preview-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }

    .price-preview-item.final {
        border-top: 2px solid #dc2626;
        margin-top: 8px;
        padding-top: 12px;
    }

    .preview-label {
        font-size: 13px;
        color: #525252;
        font-weight: 500;
    }

    .preview-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .discount-value {
        color: #dc2626;
    }

    .final-price {
        color: #16a34a;
        font-size: 18px;
    }

    /* Image Upload */
    .image-upload-wrapper {
        position: relative;
    }

    .upload-error .image-upload-label,
    .upload-error .image-preview {
        border-color: #dc2626;
        background-color: #fef2f2;
    }

    input[type="file"] {
        display: none;
    }

    .image-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 48px 24px;
        border: 2px dashed #e5e5e5;
        border-radius: 8px;
        background: #fafafa;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .image-upload-label:hover {
        border-color: #dc2626;
        background: #fef2f2;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        color: #737373;
        margin-bottom: 12px;
    }

    .upload-text {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
        display: block;
        margin-bottom: 4px;
    }

    .upload-hint {
        font-size: 12px;
        color: #737373;
    }

    .image-preview {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e5e5e5;
    }

    .image-preview img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
    }

    .image-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .new-badge {
        background: rgba(220, 38, 38, 0.9);
    }

    .change-image {
        position: absolute;
        bottom: 12px;
        right: 12px;
        padding: 10px 16px;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        color: #1a1a1a;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .change-image:hover {
        background: #ffffff;
        border-color: #dc2626;
        color: #dc2626;
    }

    .change-image svg {
        width: 18px;
        height: 18px;
    }

    .remove-image {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(220, 38, 38, 0.9);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .remove-image:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    .remove-image svg {
        width: 20px;
        height: 20px;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid #e5e5e5;
    }

    .btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-icon {
        width: 18px;
        height: 18px;
    }

    .btn-primary {
        background: #dc2626;
        color: white;
    }

    .btn-primary:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    .btn-secondary {
        background: white;
        color: #737373;
        border: 1px solid #e5e5e5;
    }

    .btn-secondary:hover {
        border-color: #d4d4d4;
        color: #1a1a1a;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    // Get elements
    const isConsignment = document.getElementById('is_consignment');
    const normalPriceForm = document.getElementById('normalPriceForm');
    const consignmentForm = document.getElementById('consignmentForm');
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const stockInput = document.getElementById('stock');
    const stockConsignmentInput = document.getElementById('stock_consignment');
    const originalPriceInput = document.getElementById('original_price');
    const profitInput = document.getElementById('profit');
    const pricePreview = document.getElementById('pricePreview');
    const productForm = document.getElementById('productForm');

    // Initialize: Set price as required by default (for normal products)
    priceInput.setAttribute('required', 'required');
    stockInput.setAttribute('required', 'required');

    // Initialize form based on current product state
    function initializeForm() {
        if (isConsignment.checked) {
            normalPriceForm.style.display = 'none';
            consignmentForm.style.display = 'block';
            
            priceInput.removeAttribute('required');
            stockInput.removeAttribute('required');
            
            originalPriceInput.setAttribute('required', 'required');
            profitInput.setAttribute('required', 'required');
            stockConsignmentInput.setAttribute('required', 'required');
            
            calculateConsignmentPrice();
        } else {
            normalPriceForm.style.display = 'block';
            consignmentForm.style.display = 'none';
            
            priceInput.setAttribute('required', 'required');
            stockInput.setAttribute('required', 'required');
            
            originalPriceInput.removeAttribute('required');
            profitInput.removeAttribute('required');
            stockConsignmentInput.removeAttribute('required');
            
            calculateNormalPrice();
        }
    }

    // Toggle between normal and consignment forms
    isConsignment.addEventListener('change', function() {
        if (this.checked) {
            // Mode Barang Titipan
            normalPriceForm.style.display = 'none';
            consignmentForm.style.display = 'block';
            
            // Clear & remove required dari normal price fields
            priceInput.value = '';
            discountInput.value = '0';
            priceInput.removeAttribute('required');
            stockInput.removeAttribute('required');
            
            // Set required untuk consignment fields
            originalPriceInput.setAttribute('required', 'required');
            profitInput.setAttribute('required', 'required');
            stockConsignmentInput.setAttribute('required', 'required');
            
        } else {
            // Mode Normal
            normalPriceForm.style.display = 'block';
            consignmentForm.style.display = 'none';
            
            // Clear consignment fields
            originalPriceInput.value = '';
            profitInput.value = '';
            stockConsignmentInput.value = '';
            
            // Set required untuk normal fields
            priceInput.setAttribute('required', 'required');
            stockInput.setAttribute('required', 'required');
            
            // Remove required dari consignment fields
            originalPriceInput.removeAttribute('required');
            profitInput.removeAttribute('required');
            stockConsignmentInput.removeAttribute('required');
        }
    });

    // Before form submit - sync data dan hindari duplikasi
    productForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default submit
        
        if (isConsignment.checked) {
            // MODE BARANG TITIPAN
            
            // 1. Sync stock dari consignment ke main stock input
            stockInput.value = stockConsignmentInput.value;
            
            // 2. Hitung dan set price dari original_price + profit
            const original = parseInt(originalPriceInput.value) || 0;
            const profit = parseInt(profitInput.value) || 0;
            priceInput.value = original + profit;
            
            // 3. Set discount ke 0 untuk barang titipan
            discountInput.value = 0;
            
            // 4. Remove name attribute dari stock_consignment agar tidak terkirim
            stockConsignmentInput.removeAttribute('name');
            
        } else {
            // MODE NORMAL
            
            // Clear consignment fields untuk menghindari data ganda
            originalPriceInput.value = '';
            profitInput.value = '';
            
            // Pastikan stock_consignment tidak punya name attribute
            stockConsignmentInput.removeAttribute('name');
        }
        
        // Submit form setelah semua data diproses
        this.submit();
    });

    // Calculate consignment price
    function calculateConsignmentPrice() {
        const original = parseInt(originalPriceInput.value) || 0;
        const profit = parseInt(profitInput.value) || 0;
        const total = original + profit;

        // Update preview
        document.getElementById('consignmentOriginal').innerText = 
            'Rp ' + original.toLocaleString('id-ID');
        document.getElementById('consignmentProfit').innerText = 
            '+ Rp ' + profit.toLocaleString('id-ID');
        document.getElementById('consignmentPrice').innerText = 
            'Rp ' + total.toLocaleString('id-ID');
    }

    // Calculate normal price with discount
    function calculateNormalPrice() {
        const price = parseInt(priceInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        
        if (price > 0 && discount > 0) {
            const discountAmount = (price * discount) / 100;
            const finalPrice = price - discountAmount;
            
            document.getElementById('normalPrice').innerText = 
                'Rp ' + price.toLocaleString('id-ID');
            document.getElementById('discountAmount').innerText = 
                '- Rp ' + discountAmount.toLocaleString('id-ID');
            document.getElementById('finalPrice').innerText = 
                'Rp ' + finalPrice.toLocaleString('id-ID');
            
            pricePreview.style.display = 'block';
        } else {
            pricePreview.style.display = 'none';
        }
    }

    // Event listeners for consignment calculation
    if (originalPriceInput) {
        originalPriceInput.addEventListener('input', calculateConsignmentPrice);
    }
    if (profitInput) {
        profitInput.addEventListener('input', calculateConsignmentPrice);
    }

    // Event listeners for normal price calculation
    if (priceInput) {
        priceInput.addEventListener('input', calculateNormalPrice);
    }
    if (discountInput) {
        discountInput.addEventListener('input', calculateNormalPrice);
    }

    // Image handling functions
    function triggerFileInput() {
        document.getElementById('image').click();
    }

    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('newImagePreview').style.display = 'block';
            
            // Hide current image if exists
            const currentImage = document.getElementById('currentImage');
            if (currentImage) {
                currentImage.style.display = 'none';
            }
            
            // Hide upload label if exists
            const uploadLabel = document.getElementById('uploadLabel');
            if (uploadLabel) {
                uploadLabel.style.display = 'none';
            }
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('newImagePreview').style.display = 'none';
        
        // Show current image again if exists
        const currentImage = document.getElementById('currentImage');
        if (currentImage) {
            currentImage.style.display = 'block';
        } else {
            // Show upload label if no current image
            const uploadLabel = document.getElementById('uploadLabel');
            if (uploadLabel) {
                uploadLabel.style.display = 'flex';
            }
        }
    }

    // Alert close functions
    function closeAlert() {
        const alert = document.getElementById('successAlert');
        if (alert) {
            alert.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }
    }

    function closeErrorAlert() {
        const alert = document.getElementById('errorAlert');
        if (alert) {
            alert.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }
    }

    // Initialize form on page load
    window.addEventListener('load', function() {
        initializeForm();
    });

    // Auto close success alert after 5 seconds
    setTimeout(() => {
        closeAlert();
    }, 5000);
</script>

@endsection