@extends('admin.layouts.app')
<style>
    body {
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
        margin: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: rgb(255, 255, 255);
        padding: 35px;
        border-radius: 15px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    }

    .header {
        border-bottom: 3px solid #8b0000;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }

    h2 {
        color: #642714;
        font-size: 28px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    h2::before {
        /* content: '📦'; */
        font-size: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #642714;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #982626;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s ease;
        box-sizing: border-box;
        background-color: #ffffff;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        outline: none;
        border-color: #8b0000;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(229, 132, 35, 0.1);
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 2px dashed #982626;
        border-radius: 8px;
        font-size: 13px;
        background-color: #fffbf0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    input[type="file"]:hover {
        border-color: #8b0000;
        background-color: #fff8e7;
    }

    .file-label {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .file-label::before {
        content: '📷';
        font-size: 16px;
    }

    /* Price Grid Layout */
    .price-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    /* Discount Input Styling */
    .discount-wrapper {
        position: relative;
    }

    .discount-wrapper input {
        padding-right: 45px;
    }

    .percent-symbol {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #8b0000;
        font-weight: 700;
        font-size: 16px;
        pointer-events: none;
    }

    .discount-badge {
        display: inline-block;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-left: 8px;
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8b0000 0%, #982626 100%);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(229, 132, 35, 0.3);
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #8b0000 0%, #982626 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(229, 132, 35, 0.4);
    }

    .btn-submit::before {
        content: '✓';
        font-size: 18px;
        font-weight: bold;
    }

    .btn-cancel {
        background: linear-gradient(135deg, #af9b74 0%, #c0b090 100%);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: linear-gradient(135deg, #9a8766 0%, #ab9d7f 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(175, 155, 116, 0.3);
    }

    .btn-cancel::before {
        content: '←';
        font-size: 18px;
    }

    .required {
        color: #ed6325;
        margin-left: 3px;
    }

    .help-text {
        font-size: 12px;
        color: #999;
        margin-top: 5px;
        font-style: italic;
    }

    /* Preview Section */
    .price-preview {
        background: linear-gradient(135deg, #fffbf0 0%, #fff8e7 100%);
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
        border: 1px solid #f3e5cc;
    }

    .preview-label {
        font-size: 12px;
        color: #642714;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .preview-prices {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .preview-original {
        font-size: 14px;
        color: #999;
        text-decoration: line-through;
    }

    .preview-discounted {
        font-size: 20px;
        font-weight: 800;
        color: #ef4444;
    }

    .preview-savings {
        font-size: 12px;
        color: #059669;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .price-grid {
            grid-template-columns: 1fr;
        }

        .button-group {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <div class="header">
        <h2>Add Product</h2>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Name <span class="required">*</span></label>
            <input type="text" id="name" name="name" placeholder="Enter product name" required>
        </div>

        <div class="form-group">
            <label for="description">Description <span class="required">*</span></label>
            <textarea id="description" name="description" placeholder="Enter product description" required></textarea>
            <div class="help-text">Provide a detailed description of the product</div>
        </div>

        <div class="price-grid">
            <div class="form-group">
                <label for="price">Price (Rp) <span class="required">*</span></label>
                <input type="number" id="price" name="price" placeholder="0" min="0" required>
            </div>

            <div class="form-group">
                <label for="discount">
                    Discount
                    <span class="discount-badge">PROMO</span>
                </label>
                <div class="discount-wrapper">
                    <input type="number" id="discount" name="discount" placeholder="0" min="0" max="100" value="0">
                    <span class="percent-symbol">%</span>
                </div>
                <div class="help-text">Enter discount percentage (0-100%)</div>
            </div>
        </div>

        <!-- Price Preview -->
        <div class="price-preview" id="pricePreview" style="display: none;">
            <div class="preview-label">Price Preview</div>
            <div class="preview-prices">
                <div class="preview-original">
                    Original Price: Rp <span id="previewOriginal">0</span>
                </div>
                <div class="preview-discounted">
                    Discounted Price: Rp <span id="previewDiscounted">0</span>
                </div>
                <div class="preview-savings">
                    💰 You save: Rp <span id="previewSavings">0</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="stock">Stock <span class="required">*</span></label>
            <input type="number" id="stock" name="stock" placeholder="0" min="0" required>
            <div class="help-text">Number of items available</div>
        </div>

        <div class="form-group">
            <label for="image" class="file-label">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <div class="help-text">Supported formats: JPG, PNG, GIF (Max 2MB)</div>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">Save Product</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const pricePreview = document.getElementById('pricePreview');
    const previewOriginal = document.getElementById('previewOriginal');
    const previewDiscounted = document.getElementById('previewDiscounted');
    const previewSavings = document.getElementById('previewSavings');

    function updatePricePreview() {
        const price = parseFloat(priceInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;

        if (price > 0 && discount > 0) {
            const discountedPrice = price - (price * discount / 100);
            const savings = price - discountedPrice;

            pricePreview.style.display = 'block';
            previewOriginal.textContent = price.toLocaleString('id-ID');
            previewDiscounted.textContent = discountedPrice.toLocaleString('id-ID');
            previewSavings.textContent = savings.toLocaleString('id-ID');
        } else {
            pricePreview.style.display = 'none';
        }
    }

    // Add event listeners
    priceInput.addEventListener('input', updatePricePreview);
    discountInput.addEventListener('input', updatePricePreview);

    // Validate discount range
    discountInput.addEventListener('blur', function() {
        let value = parseFloat(this.value) || 0;
        if (value < 0) value = 0;
        if (value > 100) value = 100;
        this.value = value;
        updatePricePreview();
    });
});
</script>