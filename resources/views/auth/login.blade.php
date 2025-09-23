<x-guest-layout>
    <!-- Login Form Title -->
    <h1 class="auth-form-title">Masuk</h1>
    <p class="auth-form-subtitle">Selamat datang kembali! Silakan masuk ke akun Anda.</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="auth-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="auth-form-group">
            <label for="email" class="auth-form-label">Email</label>
            <input id="email" 
                   class="auth-form-input @error('email') border-red-500 @enderror" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="Masukkan alamat email Anda">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="auth-form-group">
            <label for="password" class="auth-form-label">Password</label>
            <input id="password" 
                   class="auth-form-input @error('password') border-red-500 @enderror" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password" 
                   placeholder="Masukkan password Anda">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="auth-checkbox-group">
            <input id="remember_me" 
                   type="checkbox" 
                   class="auth-checkbox" 
                   name="remember">
            <label for="remember_me" class="auth-checkbox-label">
                Ingat saya
            </label>
        </div>

        <!-- Form Actions -->
        <div class="auth-form-actions">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="auth-btn-primary">
            Masuk
        </button>
    </form>
</x-guest-layout>
