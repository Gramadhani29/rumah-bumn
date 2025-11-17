<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Dashboard Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">
    <!-- Admin Navbar -->
    <nav class="admin-navbar">
        <div class="admin-navbar-container">
            <div class="admin-navbar-left">
                <a href="{{ route('dashboard') }}" class="admin-navbar-brand">
                    <img src="{{ asset('images/Logo RBP.png') }}" alt="Logo Rumah BUMN" class="admin-navbar-logo">
                </a>
            </div>
            
            <div class="admin-navbar-right">
                <form method="POST" action="{{ route('logout') }}" class="admin-navbar-logout-form">
                    @csrf
                    <button type="submit" class="admin-navbar-logout-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-page-header">
                <div class="admin-page-title">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('admin.news.index') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                        </a>
                        <div>
                            <h1>EDIT BERITA</h1>
                            <p>Rumah BUMN Telkom Pekalongan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Form Content -->
    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-form-container">
                <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="admin-form">
                    @csrf
                    @method('PUT')

                    <!-- Form Header -->
                    <div class="admin-form-header">
                        <h2>Edit Berita</h2>
                        <p>Perbarui informasi berita</p>
                    </div>

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="admin-alert admin-alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="admin-form-grid">
                        <!-- Left Column -->
                        <div class="admin-form-column">
                            <!-- Title -->
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Judul Berita</label>
                                <input type="text" name="title" id="title" class="admin-input" 
                                       value="{{ old('title', $news->title) }}" required>
                                @error('title')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="admin-form-group">
                                <label for="excerpt" class="admin-label">Ringkasan</label>
                                <textarea name="excerpt" id="excerpt" rows="3" class="admin-textarea" 
                                          placeholder="Ringkasan singkat berita..." required>{{ old('excerpt', $news->excerpt) }}</textarea>
                                @error('excerpt')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="admin-form-group">
                                <label for="content" class="admin-label">Konten Berita</label>
                                <textarea name="content" id="content" rows="12" class="admin-textarea" 
                                          placeholder="Tulis konten berita lengkap di sini..." required>{{ old('content', $news->content) }}</textarea>
                                @error('content')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="admin-form-column">
                            <!-- Image Upload -->
                            <div class="admin-form-group">
                                <label for="image" class="admin-label">Gambar Berita</label>
                                <div class="admin-file-upload">
                                    <input type="file" name="image" id="image" class="admin-file-input" accept="image/*">
                                    
                                    @if($news->image)
                                        <div class="admin-file-preview" id="currentImage">
                                            <img src="{{ $news->image_url }}" alt="Current Image">
                                            <button type="button" class="admin-file-remove" onclick="showUploadArea()">Ganti</button>
                                        </div>
                                    @endif
                                    
                                    <div class="admin-file-upload-area" id="uploadArea" 
                                         style="{{ $news->image ? 'display: none;' : '' }}" 
                                         onclick="document.getElementById('image').click()">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                        </svg>
                                        <span>Klik untuk upload gambar</span>
                                        <small>JPG, PNG, GIF hingga 2MB</small>
                                    </div>
                                    
                                    <div class="admin-file-preview" id="imagePreview" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview">
                                        <button type="button" class="admin-file-remove" onclick="removeImage()">×</button>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="admin-form-group">
                                <label for="category" class="admin-label">Kategori</label>
                                <select name="category" id="category" class="admin-select" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $value => $label)
                                        <option value="{{ $value }}" 
                                                {{ old('category', $news->category) === $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="admin-form-group">
                                <label for="status" class="admin-label">Status</label>
                                <select name="status" id="status" class="admin-select" required>
                                    <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div class="admin-form-group">
                                <div class="admin-checkbox-group">
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                                           class="admin-checkbox" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                                    <label for="is_featured" class="admin-checkbox-label">
                                        Jadikan Berita Unggulan
                                        <small>Berita akan ditampilkan di halaman utama</small>
                                    </label>
                                </div>
                                @error('is_featured')
                                    <span class="admin-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="admin-form-actions">
                                <button type="submit" class="admin-btn-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                                    </svg>
                                    Update Berita
                                </button>
                                <a href="{{ route('admin.news.index') }}" class="admin-btn-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Image Preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('uploadArea').style.display = 'none';
                    document.getElementById('currentImage').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        function showUploadArea() {
            document.getElementById('currentImage').style.display = 'none';
            document.getElementById('uploadArea').style.display = 'block';
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('uploadArea').style.display = 'block';
        }

        // Auto-resize textarea
        document.getElementById('content').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
</body>
</html>