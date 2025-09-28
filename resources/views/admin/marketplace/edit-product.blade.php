@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="edit-product">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="title-icon">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                    </svg>
                    Edit Produk
                </h1>
                <p class="page-subtitle">Edit informasi produk {{ $product->name }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.marketplace.products') }}" class="btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.marketplace.products.update', $product->id) }}" enctype="multipart/form-data" class="product-form">
        @csrf
        @method('PUT')
        
        <div class="form-sections">
            <!-- Basic Information -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Informasi Dasar</h2>
                    <p class="section-subtitle">Informasi utama tentang produk</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label for="umkm_id">UMKM *</label>
                        <select id="umkm_id" name="umkm_id" required class="form-select">
                            <option value="">Pilih UMKM</option>
                            @foreach($umkms as $umkm)
                                <option value="{{ $umkm->id }}" {{ (old('umkm_id', $product->umkm_id) == $umkm->id) ? 'selected' : '' }}>
                                    {{ $umkm->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('umkm_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group span-2">
                        <label for="name">Nama Produk *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="form-input">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori *</label>
                        <select id="category" name="category" required class="form-select">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ (old('category', $product->category) == $category) ? 'selected' : '' }}>
                                    {{ ucfirst($category) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Harga (Rp) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0" class="form-input">
                        @error('price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok *</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="form-input">
                        @error('stock')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="weight">Berat (gram) *</label>
                        <input type="number" id="weight" name="weight" value="{{ old('weight', $product->weight) }}" required min="0" step="0.01" class="form-input">
                        @error('weight')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group span-2">
                        <label for="description">Deskripsi *</label>
                        <textarea id="description" name="description" required rows="4" class="form-textarea">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Current Images -->
            @if($product->images && count($product->images) > 0)
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Gambar Saat Ini</h2>
                    <p class="section-subtitle">Gambar produk yang sudah ada</p>
                </div>
                
                <div class="current-images">
                    @foreach($product->images as $image)
                        <div class="current-image-item">
                            <img src="{{ asset('images/products/' . $image) }}" alt="Product Image">
                            <div class="image-overlay">
                                @if($loop->first)
                                    <span class="main-badge">Utama</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="image-note">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                    Jika Anda mengupload gambar baru, gambar lama akan diganti
                </div>
            </div>
            @endif

            <!-- New Images -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Gambar Produk Baru</h2>
                    <p class="section-subtitle">Upload gambar baru (opsional, maksimal 5 gambar)</p>
                </div>
                
                <div class="form-group">
                    <label for="images">Gambar Produk</label>
                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="form-file">
                    <div class="file-help">Format: JPG, PNG, GIF. Maksimal 2MB per gambar.</div>
                    @error('images.*')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div id="image-preview" class="image-preview"></div>
            </div>

            <!-- Specifications -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Spesifikasi Produk</h2>
                    <p class="section-subtitle">Edit spesifikasi detail produk</p>
                </div>
                
                <div id="specifications-container">
                    @if($product->specifications && count($product->specifications) > 0)
                        @foreach($product->specifications as $key => $value)
                            <div class="spec-row">
                                <div class="form-group">
                                    <input type="text" name="spec_keys[]" value="{{ $key }}" placeholder="Nama spesifikasi" class="form-input">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="spec_values[]" value="{{ $value }}" placeholder="Nilai spesifikasi" class="form-input">
                                </div>
                                <button type="button" class="btn-remove-spec" onclick="removeSpecification(this)" style="{{ $loop->first && $loop->count == 1 ? 'display: none;' : '' }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="spec-row">
                            <div class="form-group">
                                <input type="text" name="spec_keys[]" placeholder="Nama spesifikasi (contoh: Bahan)" class="form-input">
                            </div>
                            <div class="form-group">
                                <input type="text" name="spec_values[]" placeholder="Nilai spesifikasi (contoh: Katun)" class="form-input">
                            </div>
                            <button type="button" class="btn-remove-spec" onclick="removeSpecification(this)" style="display: none;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                
                <button type="button" class="btn-add-spec" onclick="addSpecification()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    Tambah Spesifikasi
                </button>
            </div>

            <!-- Discount Settings -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">Pengaturan Diskon</h2>
                    <p class="section-subtitle">Atur diskon untuk produk (opsional)</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="discount_percentage">Persentase Diskon (%)</label>
                        <input type="number" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage) }}" min="0" max="100" step="0.01" class="form-input">
                        @error('discount_percentage')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="discount_starts_at">Mulai Diskon</label>
                        <input type="datetime-local" id="discount_starts_at" name="discount_starts_at" value="{{ old('discount_starts_at', $product->discount_starts_at ? $product->discount_starts_at->format('Y-m-d\TH:i') : '') }}" class="form-input">
                        @error('discount_starts_at')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="discount_ends_at">Berakhir Diskon</label>
                        <input type="datetime-local" id="discount_ends_at" name="discount_ends_at" value="{{ old('discount_ends_at', $product->discount_ends_at ? $product->discount_ends_at->format('Y-m-d\TH:i') : '') }}" class="form-input">
                        @error('discount_ends_at')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                Update Produk
            </button>
            <a href="{{ route('admin.marketplace.products') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

<style>
.edit-product {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.page-header {
    margin-bottom: 2rem;
}

.header-content {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.page-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 0.5rem;
}

.title-icon {
    color: #0098ff;
}

.page-subtitle {
    color: #64748b;
    font-size: 1rem;
}

.btn-secondary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: #f8fafc;
    color: #374151;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #e2e8f0;
}

.product-form {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.form-sections {
    padding: 2rem;
}

.form-section {
    margin-bottom: 3rem;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e2e8f0;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 0.25rem;
}

.section-subtitle {
    color: #64748b;
    font-size: 0.875rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group.span-2 {
    grid-column: span 2;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.form-input,
.form-select,
.form-textarea {
    padding: 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: border-color 0.3s ease;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #0098ff;
}

.form-file {
    padding: 0.75rem;
    border: 2px dashed #e2e8f0;
    border-radius: 8px;
    background: #f8fafc;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-file:hover {
    border-color: #0098ff;
    background: #f0f9ff;
}

.file-help {
    font-size: 0.75rem;
    color: #64748b;
}

.error-message {
    color: #dc2626;
    font-size: 0.75rem;
}

/* Current Images */
.current-images {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.current-image-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #e2e8f0;
    aspect-ratio: 1;
}

.current-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.5rem;
}

.main-badge {
    background: #0098ff;
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.image-note {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    background: #fffbeb;
    border: 1px solid #fbbf24;
    border-radius: 8px;
    color: #92400e;
    font-size: 0.875rem;
}

.image-note svg {
    color: #f59e0b;
}

/* New Image Preview */
.image-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #e2e8f0;
}

.preview-item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.spec-row {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 1rem;
    align-items: end;
    margin-bottom: 1rem;
}

.btn-add-spec {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: #f8fafc;
    color: #374151;
    border: 2px dashed #e2e8f0;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-add-spec:hover {
    background: #e2e8f0;
    border-color: #0098ff;
    color: #0098ff;
}

.btn-remove-spec {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    background: #fee2e2;
    color: #991b1b;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-remove-spec:hover {
    background: #fecaca;
}

.form-actions {
    padding: 2rem;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #0098ff;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #0066cc;
}

@media (max-width: 768px) {
    .edit-product {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-group.span-2 {
        grid-column: span 1;
    }
    
    .spec-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .current-images {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    }
}
</style>

<script>
// Image preview
document.getElementById('images').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('image-preview');
    previewContainer.innerHTML = '';
    
    Array.from(e.target.files).forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';
                previewItem.innerHTML = `<img src="${e.target.result}" alt="Preview ${index + 1}">`;
                previewContainer.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Add specification
function addSpecification() {
    const container = document.getElementById('specifications-container');
    const specRow = document.createElement('div');
    specRow.className = 'spec-row';
    specRow.innerHTML = `
        <div class="form-group">
            <input type="text" name="spec_keys[]" placeholder="Nama spesifikasi" class="form-input">
        </div>
        <div class="form-group">
            <input type="text" name="spec_values[]" placeholder="Nilai spesifikasi" class="form-input">
        </div>
        <button type="button" class="btn-remove-spec" onclick="removeSpecification(this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </button>
    `;
    container.appendChild(specRow);
    
    // Show remove buttons
    const removeButtons = container.querySelectorAll('.btn-remove-spec');
    removeButtons.forEach(btn => btn.style.display = 'block');
}

// Remove specification
function removeSpecification(button) {
    const container = document.getElementById('specifications-container');
    button.parentElement.remove();
    
    // Hide remove button if only one spec row left
    const specRows = container.querySelectorAll('.spec-row');
    if (specRows.length === 1) {
        specRows[0].querySelector('.btn-remove-spec').style.display = 'none';
    }
}
</script>
@endsection