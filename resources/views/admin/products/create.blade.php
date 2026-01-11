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
        content: '📦';
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

    /* Responsive design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
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

        <div class="form-group">
            <label for="price">Price (Rp) <span class="required">*</span></label>
            <input type="number" id="price" name="price" placeholder="0" min="0" required>
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