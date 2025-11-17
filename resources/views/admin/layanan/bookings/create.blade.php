@extends('layouts.admin')

@section('title', 'Tambah Ruangan - Admin Rumah BUMN')

@section('content')
    <div class="admin-main">
        <div class="admin-container">
            <div class="admin-page-header">
                <div class="admin-page-title">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('admin.rooms.index') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                        </a>
                        <div>
                            <h1>TAMBAH RUANGAN</h1>
                            <p>Tambah ruangan baru untuk booking</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data" class="admin-form-card">
                @csrf
                
                <div class="admin-form-section">
                    <h3 class="admin-form-section-title">Informasi Dasar</h3>
                    
                    <div class="admin-form-group">
                        <label for="name">Nama Ruangan *</label>
                        <input type="text" name="name" id="name" class="admin-input" value="{{ old('name') }}" placeholder="Contoh: Ruang Meeting A" required>
                        @error('name')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="description">Deskripsi *</label>
                        <textarea name="description" id="description" class="admin-textarea" rows="4" placeholder="Deskripsi lengkap ruangan..." required>{{ old('description') }}</textarea>
                        @error('description')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="admin-form-section">
                    <h3 class="admin-form-section-title">Detail Ruangan</h3>
                    
                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label for="capacity">Kapasitas (Orang) *</label>
                            <input type="number" name="capacity" id="capacity" class="admin-input" value="{{ old('capacity') }}" placeholder="10" min="1" required>
                            @error('capacity')<span class="admin-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="admin-form-group">
                            <label for="location">Lokasi</label>
                            <input type="text" name="location" id="location" class="admin-input" value="{{ old('location') }}" placeholder="Contoh: Lantai 2, Gedung A">
                            @error('location')<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label for="available_from">Jam Buka *</label>
                            <input type="time" name="available_from" id="available_from" class="admin-input" value="{{ old('available_from', '08:00') }}" required>
                            @error('available_from')<span class="admin-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="admin-form-group">
                            <label for="available_until">Jam Tutup *</label>
                            <input type="time" name="available_until" id="available_until" class="admin-input" value="{{ old('available_until', '17:00') }}" required>
                            @error('available_until')<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="admin-form-group">
                        <label for="status">Status *</label>
                        <select name="status" id="status" class="admin-select" required>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                        @error('status')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="admin-form-group">
                        <label>Fasilitas</label>
                        <div class="admin-checkbox-group">
                            @php
                            $facilities = [
                                'wifi' => 'WiFi',
                                'proyektor' => 'Proyektor',
                                'ac' => 'AC',
                                'whiteboard' => 'Whiteboard',
                                'sound_system' => 'Sound System',
                                'tv' => 'TV/Monitor',
                                'flipchart' => 'Flipchart',
                                'microphone' => 'Microphone',
                                'printer' => 'Printer'
                            ];
                            @endphp
                            @foreach($facilities as $key => $label)
                                <label class="admin-checkbox">
                                    <input type="checkbox" name="facilities[]" value="{{ $key }}" {{ in_array($key, old('facilities', [])) ? 'checked' : '' }}>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="admin-form-section">
                    <h3 class="admin-form-section-title">Gambar Ruangan</h3>
                    
                    <div class="admin-form-group">
                        <label for="image">Upload Gambar</label>
                        <input type="file" name="image" id="image" class="admin-input-file" accept="image/*">
                        <small class="admin-form-help">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        @error('image')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        Simpan Ruangan
                    </button>
                    <a href="{{ route('admin.rooms.index') }}" class="admin-btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
