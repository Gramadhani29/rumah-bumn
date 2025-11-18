<x-guest-layout>
    <!-- Register Form Title -->
    <h1 class="auth-form-title">Daftar Akun</h1>
    <p class="auth-form-subtitle">Buat akun baru untuk mengakses layanan Rumah BUMN</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="auth-form-group">
            <label for="name" class="auth-form-label">Nama Lengkap</label>
            <input id="name" 
                   class="auth-form-input @error('name') border-red-500 @enderror" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   placeholder="Masukkan nama lengkap Anda">
            @error('name')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="auth-form-group">
            <label for="email" class="auth-form-label">Email</label>
            <input id="email" 
                   class="auth-form-input @error('email') border-red-500 @enderror" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username" 
                   placeholder="Masukkan alamat email Anda">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role Selection -->
        <div class="auth-form-group">
            <label for="role" class="auth-form-label">Daftar Sebagai</label>
            <select id="role" 
                    class="auth-form-input @error('role') border-red-500 @enderror" 
                    name="role" 
                    required
                    onchange="toggleBusinessName()">
                <option value="">-- Pilih Jenis Akun --</option>
                <option value="umkm" {{ old('role') == 'umkm' ? 'selected' : '' }}>UMKM</option>
                <option value="eksternal" {{ old('role') == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
            </select>
            @error('role')
                <div class="auth-error">{{ $message }}</div>
            @enderror
            <p class="auth-form-hint">Pilih UMKM jika Anda ingin berjualan di marketplace. Pilih Eksternal untuk akses layanan umum.</p>
        </div>

        <!-- Business Name (shown only for UMKM) -->
        <div class="auth-form-group" id="businessNameField" style="display: {{ old('role') == 'umkm' ? 'block' : 'none' }};">
            <label for="business_name" class="auth-form-label">Nama Usaha</label>
            <input id="business_name" 
                   class="auth-form-input @error('business_name') border-red-500 @enderror" 
                   type="text" 
                   name="business_name" 
                   value="{{ old('business_name') }}" 
                   autocomplete="organization" 
                   placeholder="Masukkan nama usaha Anda">
            @error('business_name')
                <div class="auth-error">{{ $message }}</div>
            @enderror
            <p class="auth-form-hint">Nama usaha akan ditampilkan di marketplace.</p>
        </div>

        <!-- Password -->
        <div class="auth-form-group">
            <label for="password" class="auth-form-label">Password</label>
            <input id="password" 
                   class="auth-form-input @error('password') border-red-500 @enderror" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Masukkan password Anda">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="auth-form-group">
            <label for="password_confirmation" class="auth-form-label">Konfirmasi Password</label>
            <input id="password_confirmation" 
                   class="auth-form-input @error('password_confirmation') border-red-500 @enderror" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Masukkan ulang password Anda">
            @error('password_confirmation')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="auth-btn-primary">
            Daftar
        </button>

        <!-- Login Link -->
        <div class="auth-form-footer">
            <p class="auth-form-footer-text">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="auth-link-primary">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>

    <script>
        function toggleBusinessName() {
            const roleSelect = document.getElementById('role');
            const businessNameField = document.getElementById('businessNameField');
            const businessNameInput = document.getElementById('business_name');
            
            if (roleSelect.value === 'umkm') {
                businessNameField.style.display = 'block';
                businessNameInput.setAttribute('required', 'required');
            } else {
                businessNameField.style.display = 'none';
                businessNameInput.removeAttribute('required');
                businessNameInput.value = '';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleBusinessName();
        });
    </script>
</x-guest-layout>
