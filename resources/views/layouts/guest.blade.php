<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rumah BUMN Telkom Pekalongan') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body class="auth-body">
        <div class="auth-container">
            <!-- Auth Header -->
            <div class="auth-header">
                <a href="/" class="auth-logo">
                    <img src="{{ asset('images/Logo RBP.png') }}" alt="Rumah BUMN Pekalongan" class="auth-logo-img">
                    <div class="auth-logo-text">
                        <h2>RUMAH BUMN</h2>
                        <p>TELKOM PEKALONGAN</p>
                    </div>
                </a>
            </div>

            <!-- Auth Card -->
            <div class="auth-card">
                {{ $slot }}
            </div>
            
            <!-- Back to Home -->
            <div class="auth-footer">
                <a href="/" class="auth-back-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </body>
</html>
