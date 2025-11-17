<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Rumah BUMN Telkom Pekalongan</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    @stack('styles')
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

    <!-- Main Content -->
    <main class="admin-content">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>