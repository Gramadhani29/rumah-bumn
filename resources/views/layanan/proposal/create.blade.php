@extends('layouts.public')

@section('title', 'Pengajuan Proposal Kegiatan - Rumah BUMN Telkom Pekalongan')
@section('description', 'Ajukan proposal kegiatan untuk diselenggarakan di Rumah BUMN Telkom Pekalongan')

@section('content')
    <!-- Page Header -->
    <section class="page-header-section">
        <div class="container">
            <div class="page-header-content">
                <nav class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Beranda
                    </a>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                    <a href="{{ route('booking.index') }}">Layanan</a>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                    <span>Pengajuan Proposal</span>
                </nav>
                
                <h1>Pengajuan Proposal Kegiatan</h1>
                <p>Isi form berikut untuk mengajukan proposal kegiatan di Rumah BUMN Telkom Pekalongan</p>
            </div>
        </div>
    </section>

    <!-- Proposal Form Section -->
    <section class="proposal-form-section section">
        <div class="container-fluid">
            <div class="form-container-full">
                <form action="{{ route('proposal.store') }}" method="POST" enctype="multipart/form-data" class="proposal-form-full">
                    @csrf
                    
                    <!-- Form Header -->
                    <div class="form-header">
                        <div class="form-header-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        </div>
                        <h2>Form Pengajuan Proposal</h2>
                        <p>Lengkapi semua informasi yang diperlukan dengan detail</p>
                    </div>

                    <div class="form-sections">
                        <!-- Section 1: Informasi Kegiatan -->
                        <div class="form-section">
                            <h3>📋 Informasi Kegiatan</h3>
                            
                            <div class="form-group">
                                <label for="nama_kegiatan">Nama Kegiatan <span class="required">*</span></label>
                                <input type="text" 
                                       id="nama_kegiatan" 
                                       name="nama_kegiatan" 
                                       value="{{ old('nama_kegiatan') }}" 
                                       required 
                                       placeholder="Contoh: Workshop Digital Marketing untuk UMKM">
                                @error('nama_kegiatan')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori">Kategori Kegiatan <span class="required">*</span></label>
                                <select id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="pelatihan" {{ old('kategori') == 'pelatihan' ? 'selected' : '' }}>
                                        🎓 Pelatihan (Workshop, Seminar, Training)
                                    </option>
                                    <option value="kerja_sama" {{ old('kategori') == 'kerja_sama' ? 'selected' : '' }}>
                                        🤝 Kerja Sama (Partnership, Kolaborasi)
                                    </option>
                                    <option value="event" {{ old('kategori') == 'event' ? 'selected' : '' }}>
                                        🎪 Event (Pameran, Launching, Gathering)
                                    </option>
                                </select>
                                @error('kategori')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deskripsi_kegiatan">Deskripsi Kegiatan <span class="required">*</span></label>
                                <textarea id="deskripsi_kegiatan" 
                                          name="deskripsi_kegiatan" 
                                          rows="5" 
                                          required 
                                          placeholder="Jelaskan tujuan, target peserta, agenda kegiatan, dan manfaat yang diharapkan...">{{ old('deskripsi_kegiatan') }}</textarea>
                                @error('deskripsi_kegiatan')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Section 2: Waktu dan Peserta -->
                        <div class="form-section">
                            <h3>📅 Waktu & Peserta</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tanggal_kegiatan">Tanggal Kegiatan <span class="required">*</span></label>
                                    <input type="date" 
                                           id="tanggal_kegiatan" 
                                           name="tanggal_kegiatan" 
                                           value="{{ old('tanggal_kegiatan') }}" 
                                           min="{{ $today }}" 
                                           max="{{ $maxDate }}" 
                                           required>
                                    @error('tanggal_kegiatan')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="estimasi_peserta">Estimasi Peserta <span class="required">*</span></label>
                                    <input type="number" 
                                           id="estimasi_peserta" 
                                           name="estimasi_peserta" 
                                           value="{{ old('estimasi_peserta') }}" 
                                           min="1" 
                                           max="1000" 
                                           required 
                                           placeholder="Jumlah peserta">
                                    @error('estimasi_peserta')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai <span class="required">*</span></label>
                                    <input type="time" 
                                           id="jam_mulai" 
                                           name="jam_mulai" 
                                           value="{{ old('jam_mulai') }}" 
                                           required>
                                    @error('jam_mulai')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai <span class="required">*</span></label>
                                    <input type="time" 
                                           id="jam_selesai" 
                                           name="jam_selesai" 
                                           value="{{ old('jam_selesai') }}" 
                                           required>
                                    @error('jam_selesai')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Kontak Person -->
                        <div class="form-section">
                            <h3>👤 Informasi Kontak</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_name">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" 
                                           id="contact_name" 
                                           name="contact_name" 
                                           value="{{ old('contact_name', auth()->user()->name ?? '') }}" 
                                           required 
                                           placeholder="Nama person in charge">
                                    @error('contact_name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="contact_phone">Nomor HP/WA <span class="required">*</span></label>
                                    <input type="tel" 
                                           id="contact_phone" 
                                           name="contact_phone" 
                                           value="{{ old('contact_phone') }}" 
                                           required 
                                           placeholder="0812xxxxxxxx">
                                    @error('contact_phone')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_email">Email</label>
                                    <input type="email" 
                                           id="contact_email" 
                                           name="contact_email" 
                                           value="{{ old('contact_email', auth()->user()->email ?? '') }}" 
                                           placeholder="email@domain.com">
                                    @error('contact_email')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="organisasi">Organisasi/Instansi</label>
                                    <input type="text" 
                                           id="organisasi" 
                                           name="organisasi" 
                                           value="{{ old('organisasi') }}" 
                                           placeholder="Nama organisasi/perusahaan (opsional)">
                                    @error('organisasi')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: File Proposal -->
                        <div class="form-section">
                            <h3>📎 File Proposal</h3>
                            
                            <div class="form-group">
                                <label for="proposal_file">Upload Proposal (Opsional)</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" 
                                           id="proposal_file" 
                                           name="proposal_file" 
                                           accept=".pdf"
                                           class="file-input">
                                    <div class="file-upload-display" id="fileDisplay">
                                        <div class="file-upload-placeholder">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                            </svg>
                                            <span>Klik untuk pilih file PDF atau drag & drop</span>
                                            <small>Format: PDF | Maksimal: 10MB</small>
                                        </div>
                                    </div>
                                </div>
                                @error('proposal_file')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="file-info">
                                    <small>💡 Upload file proposal lengkap dalam format PDF untuk mempercepat proses review</small>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Kebutuhan Khusus -->
                        <div class="form-section">
                            <h3>🔧 Kebutuhan Khusus</h3>
                            
                            <div class="form-group">
                                <label for="kebutuhan_khusus">Kebutuhan Khusus (Opsional)</label>
                                <textarea id="kebutuhan_khusus" 
                                          name="kebutuhan_khusus" 
                                          rows="4" 
                                          placeholder="Contoh: Sound system, proyektor, catering, dekorasi khusus, dll.">{{ old('kebutuhan_khusus') }}</textarea>
                                @error('kebutuhan_khusus')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" onclick="history.back()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 7v4H5.83l3.58-3.59L8 6l-6 6 6 6 1.41-1.41L5.83 13H21V7z"/>
                            </svg>
                            Kembali
                        </button>
                        
                        <button type="submit" class="btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            Kirim Proposal
                        </button>
                    </div>
                </form>
                
                <!-- Info Panel -->
                <div class="info-panel-bottom">
                <div class="info-card">
                    <h4>ℹ️ Informasi Penting</h4>
                    <ul>
                        <li>Proposal akan direviw dalam 2-3 hari kerja</li>
                        <li>Anda akan dihubungi via telepon/email untuk konfirmasi</li>
                        <li>Kegiatan harus diajukan minimal 7 hari sebelum pelaksanaan</li>
                        <li>Semua kegiatan harus sesuai dengan visi misi Rumah BUMN</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h4>📞 Butuh Bantuan?</h4>
                    <p>Hubungi tim kami jika ada pertanyaan:</p>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span>📱 WhatsApp: 0285-123456</span>
                        </div>
                        <div class="contact-item">
                            <span>📧 Email: info@rumahbumn.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
.proposal-form-section {
    padding: 2rem 0;
    background: #f8f9fa;
}

.form-container-full {
    width: 100%;
    margin: 0;
    padding: 0 1rem;
}

.proposal-form-full {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: none;
}

.info-panel-bottom {
    margin-top: 2rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #f1f3f4;
}

.form-header-icon {
    color: #667eea;
    margin-bottom: 1rem;
}

.form-header h2 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.75rem;
}

.form-header p {
    color: #6c757d;
    margin: 0;
}

.form-sections {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-section {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 4px solid #667eea;
}

.form-section h3 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-weight: 600;
}

.required {
    color: #e74c3c;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.875rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.error-message {
    color: #e74c3c;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px solid #f1f3f4;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a6fd8;
    transform: translateY(-2px);
}

.btn-secondary {
    background: white;
    color: #6c757d;
    border: 2px solid #e9ecef;
}

.btn-secondary:hover {
    background: #f8f9fa;
    border-color: #667eea;
    color: #667eea;
}

/* Info Panel */
.info-panel {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.info-card h4 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.info-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-card li {
    color: #6c757d;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.info-card li:before {
    content: "•";
    color: #667eea;
    font-weight: bold;
    position: absolute;
    left: 0;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.contact-item span {
    color: #6c757d;
    font-size: 0.9rem;
}

/* File Upload Styles */
.file-upload-wrapper {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.file-upload-display {
    border: 2px dashed #e9ecef;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: white;
    position: relative;
}

.file-upload-display:hover {
    border-color: #667eea;
    background: #f8f9fa;
}

.file-upload-display.dragover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.file-upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
}

.file-upload-placeholder svg {
    color: #667eea;
}

.file-upload-placeholder span {
    font-weight: 600;
}

.file-upload-placeholder small {
    font-size: 0.8rem;
    color: #adb5bd;
}

.file-selected {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #e8f5e8;
    border: 2px solid #28a745;
    border-radius: 8px;
}

.file-selected .file-icon {
    color: #28a745;
}

.file-selected .file-details {
    flex: 1;
}

.file-selected .file-name {
    font-weight: 600;
    color: #155724;
    margin-bottom: 0.25rem;
}

.file-selected .file-size {
    font-size: 0.8rem;
    color: #6c757d;
}

.file-selected .file-remove {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: background 0.3s ease;
}

.file-selected .file-remove:hover {
    background: rgba(220, 53, 69, 0.1);
}

.file-info {
    margin-top: 0.5rem;
}

.file-info small {
    color: #667eea;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .form-container-full {
        padding: 0 0.5rem;
    }
    
    .info-panel-bottom {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-primary,
    .btn-secondary {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validate time range
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');
    
    function validateTimeRange() {
        if (jamMulai.value && jamSelesai.value) {
            if (jamSelesai.value <= jamMulai.value) {
                jamSelesai.setCustomValidity('Jam selesai harus lebih dari jam mulai');
            } else {
                jamSelesai.setCustomValidity('');
            }
        }
    }
    
    jamMulai.addEventListener('change', validateTimeRange);
    jamSelesai.addEventListener('change', validateTimeRange);
    
    // Phone number formatting
    const phoneInput = document.getElementById('contact_phone');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('0')) {
            value = value;
        } else if (value.startsWith('62')) {
            value = '0' + value.substring(2);
        }
        e.target.value = value;
    });
    
    // File upload handling
    const fileInput = document.getElementById('proposal_file');
    const fileDisplay = document.getElementById('fileDisplay');
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    function showFileSelected(file) {
        fileDisplay.innerHTML = `
            <div class="file-selected">
                <div class="file-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                    </svg>
                </div>
                <div class="file-details">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${formatFileSize(file.size)}</div>
                </div>
                <button type="button" class="file-remove" onclick="removeFile()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        `;
    }
    
    function showFileError(message) {
        fileDisplay.innerHTML = `
            <div class="file-upload-placeholder">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="color: #dc3545;">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
                <span style="color: #dc3545;">${message}</span>
                <small>Format: PDF | Maksimal: 10MB</small>
            </div>
        `;
        setTimeout(() => {
            resetFileDisplay();
        }, 3000);
    }
    
    function resetFileDisplay() {
        fileDisplay.innerHTML = `
            <div class="file-upload-placeholder">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                </svg>
                <span>Klik untuk pilih file PDF atau drag & drop</span>
                <small>Format: PDF | Maksimal: 10MB</small>
            </div>
        `;
    }
    
    window.removeFile = function() {
        fileInput.value = '';
        resetFileDisplay();
    };
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file type
            if (file.type !== 'application/pdf') {
                showFileError('File harus berformat PDF');
                fileInput.value = '';
                return;
            }
            
            // Validate file size (10MB = 10485760 bytes)
            if (file.size > 10485760) {
                showFileError('Ukuran file maksimal 10MB');
                fileInput.value = '';
                return;
            }
            
            showFileSelected(file);
        }
    });
    
    // Drag and drop functionality
    fileDisplay.addEventListener('drag', handleDrag);
    fileDisplay.addEventListener('dragstart', handleDrag);
    fileDisplay.addEventListener('dragend', handleDrag);
    fileDisplay.addEventListener('dragover', handleDrag);
    fileDisplay.addEventListener('dragenter', handleDrag);
    fileDisplay.addEventListener('dragleave', handleDrag);
    fileDisplay.addEventListener('drop', handleDrop);
    
    function handleDrag(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function handleDrop(e) {
        e.preventDefault();
        e.stopPropagation();
        
        fileDisplay.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            
            // Validate file type
            if (file.type !== 'application/pdf') {
                showFileError('File harus berformat PDF');
                return;
            }
            
            // Validate file size (10MB = 10485760 bytes)
            if (file.size > 10485760) {
                showFileError('Ukuran file maksimal 10MB');
                return;
            }
            
            fileInput.files = files;
            showFileSelected(file);
        }
    }
    
    fileDisplay.addEventListener('dragover', function() {
        fileDisplay.classList.add('dragover');
    });
    
    fileDisplay.addEventListener('dragleave', function() {
        fileDisplay.classList.remove('dragover');
    });
    
    // Character counter for textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        const maxLength = textarea.getAttribute('maxlength');
        if (maxLength) {
            const counter = document.createElement('div');
            counter.style.textAlign = 'right';
            counter.style.fontSize = '0.8rem';
            counter.style.color = '#6c757d';
            counter.style.marginTop = '0.25rem';
            
            function updateCounter() {
                const remaining = maxLength - textarea.value.length;
                counter.textContent = `${remaining} karakter tersisa`;
                counter.style.color = remaining < 50 ? '#e74c3c' : '#6c757d';
            }
            
            textarea.addEventListener('input', updateCounter);
            textarea.parentNode.appendChild(counter);
            updateCounter();
        }
    });
});
</script>
@endpush