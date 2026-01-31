@extends('admin.layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Update Profil</h1>
        <p>Perbarui informasi dan foto profil Anda</p>
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
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- Left Column -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="name">Nama <span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Saat Ini</label>
                        <div class="info-box">
                            <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16v-6m0 0V5m0 6h6m-6 0H7"/>
                            </svg>
                            <div class="info-text">
                                <span class="info-label">Nama</span>
                                <span class="info-value">{{ $user->name }}</span>
                            </div>
                            <div class="info-text">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Photo Upload -->
                <div class="form-column">
                    <div class="form-group">
                        <label>Foto Profil</label>
                        <div class="image-upload-wrapper">
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(event)">

                            <!-- Upload Label (shown when no image) -->
                            <label for="profile_photo" class="image-upload-label" id="uploadLabel" style="@if($user->profile_photo) display: none; @endif">
                                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <span class="upload-text">Klik untuk upload foto</span>
                                <span class="upload-hint">PNG, JPG, GIF (Max 2MB)</span>
                            </label>

                            <!-- Preview (shown when image exists) -->
                            <div class="image-preview" id="imagePreview" style="@if(!$user->profile_photo) display: none; @endif">
                                <img id="preview" src="@if($user->profile_photo) {{ asset('storage/' . $user->profile_photo) }} @endif" alt="Preview Foto">
                                <button type="button" class="remove-image" onclick="removeImage()">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                                <label for="profile_photo" class="change-photo-btn">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Ganti Foto
                                </label>
                            </div>
                        </div>
                        <span class="help-text">Disarankan resolusi minimal 200x200px</span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
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
        gap: 12px;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 1; transform: translateY(0); }
        to   { opacity: 0; transform: translateY(-10px); }
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
    }

    .alert-success .alert-icon { color: #16a34a; }
    .alert-error .alert-icon  { color: #dc2626; }

    .alert-content {
        flex: 1;
    }

    .alert-content strong {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .alert-success .alert-content strong { color: #16a34a; }
    .alert-error .alert-content strong  { color: #dc2626; }

    .alert-content p,
    .alert-content ul {
        margin: 0;
        font-size: 14px;
        color: #525252;
    }

    .alert-content ul {
        list-style: none;
        padding-left: 0;
    }

    .alert-content li {
        padding-left: 20px;
        position: relative;
    }

    .alert-content li::before {
        content: "•";
        position: absolute;
        left: 8px;
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

    .required {
        color: #dc2626;
    }

    .help-text {
        font-size: 12px;
        color: #737373;
        font-style: italic;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s;
        box-sizing: border-box;
        background: #fff;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Info Box */
    .info-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .info-box svg.info-icon {
        display: none;
    }

    .info-text {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-text:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        font-size: 13px;
        color: #737373;
        font-weight: 500;
    }

    .info-value {
        font-size: 13px;
        color: #1a1a1a;
        font-weight: 600;
    }

    /* Image Upload */
    .image-upload-wrapper {
        position: relative;
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
        height: 300px;
        object-fit: cover;
        display: block;
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
        width: 18px;
        height: 18px;
    }

    .change-photo-btn {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 12px;
        background: rgba(26, 26, 26, 0.6);
        color: #ffffff;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
    }

    .change-photo-btn:hover {
        background: rgba(26, 26, 26, 0.78);
    }

    .change-photo-btn svg {
        width: 16px;
        height: 16px;
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
        font-family: inherit;
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
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('uploadLabel').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('profile_photo').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('uploadLabel').style.display = 'flex';
    }

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

    // Auto close success alert after 5 seconds
    setTimeout(() => { closeAlert(); }, 5000);
</script>
@endsection