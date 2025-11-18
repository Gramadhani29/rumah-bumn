<!-- Public Navigation Header -->
<header class="header">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/Logo RBP.png') }}" alt="Logo RBP" style="height: 50px; margin-right: 10px; vertical-align: middle;">
        </div>
        
        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <nav>
            <ul class="navbar" id="navbar">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ url('/#about') }}">Tentang Kami</a></li>
                <li><a href="{{ route('berita') }}" class="{{ request()->routeIs('berita*') ? 'active' : '' }}">Berita</a></li>
                <li><a href="{{ route('toko.index') }}" class="{{ request()->routeIs('toko*') ? 'active' : '' }}">Toko</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle {{ request()->routeIs('booking*') || request()->routeIs('proposal*') ? 'active' : '' }}" onclick="toggleDropdown(event, 'layananDropdown')">
                        Layanan
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 5px;">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </a>
                    <ul class="dropdown-menu" id="layananDropdown">
                        <li><a href="{{ route('booking.index') }}">Booking Ruangan</a></li>
                        <li><a href="{{ route('proposal.create') }}">Pengajuan Proposal</a></li>
                    </ul>
                </li>
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" onclick="toggleDropdown(event, 'userDropdown')">
                        {{ Auth::user()->name }}
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 5px;">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </a>
                    <ul class="dropdown-menu" id="userDropdown">
                        @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @elseif(Auth::user()->isEksternal())
                            <li><a href="{{ route('eksternal.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('eksternal.orders') }}">Pesanan Saya</a></li>
                            <li><a href="{{ route('profile.edit') }}">Tentang Saya</a></li>
                        @elseif(Auth::user()->isUmkm())
                            <li><a href="{{ route('umkm.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('umkm.products') }}">Produk Saya</a></li>
                            <li><a href="{{ route('profile.edit') }}">Tentang Saya</a></li>
                        @else
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                        @endif
                        <li class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: inherit; text-decoration: none; cursor: pointer; width: 100%; text-align: left; padding: 8px 15px;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<style>
/* Dropdown Styles */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    min-width: 200px;
    z-index: 1000;
    padding: 8px 0;
    margin-top: 5px;
}

/* Specific positioning for layanan dropdown */
#layananDropdown {
    right: auto;
    left: 0;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-menu li {
    list-style: none;
    margin: 0;
}

.dropdown-menu li a {
    display: block;
    padding: 8px 15px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.2s;
}

.dropdown-menu li a:hover {
    background-color: #f8f9fa;
    color: #333;
}

.dropdown-divider {
    height: 1px;
    background-color: #e9ecef;
    margin: 8px 0;
}

.dropdown-menu button:hover {
    background-color: #f8f9fa !important;
}

/* Mobile responsive */
@media (max-width: 768px) {
    /* Mobile menu show/hide */
    .navbar {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        flex-direction: column;
        padding: 20px;
        z-index: 999;
    }
    
    .navbar.show {
        display: flex;
    }
    
    .navbar li {
        margin: 10px 0;
    }
    
    /* Dropdown in mobile */
    .dropdown-menu {
        position: static;
        display: block;
        background: transparent;
        border: none;
        box-shadow: none;
        padding: 0;
        margin: 0;
    }
    
    .dropdown-menu li a {
        padding: 10px 20px;
        border-bottom: 1px solid #eee;
    }
}
</style>

<script>
function toggleDropdown(event, dropdownId = 'userDropdown') {
    event.preventDefault();
    event.stopPropagation();
    
    // Close all other dropdowns first
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    allDropdowns.forEach(dropdown => {
        if (dropdown.id !== dropdownId) {
            dropdown.classList.remove('show');
        }
    });
    
    // Toggle the target dropdown
    const dropdown = document.getElementById(dropdownId);
    if (dropdown) {
        dropdown.classList.toggle('show');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    const allDropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    let clickedInsideDropdown = false;
    
    // Check if click was inside any dropdown or toggle
    allDropdowns.forEach(dropdown => {
        if (dropdown.contains(event.target)) {
            clickedInsideDropdown = true;
        }
    });
    
    allDropdownToggles.forEach(toggle => {
        if (toggle.contains(event.target)) {
            clickedInsideDropdown = true;
        }
    });
    
    // If click was outside all dropdowns, close them all
    if (!clickedInsideDropdown) {
        allDropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

// Handle "Tentang Kami" and "Tentang Saya" links
document.addEventListener('DOMContentLoaded', function() {
    const aboutLinks = document.querySelectorAll('a[href="/#about"]');
    aboutLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Check if we're already on the home page
            if (window.location.pathname === '/') {
                e.preventDefault();
                // Scroll to about section smoothly
                const aboutSection = document.getElementById('about');
                if (aboutSection) {
                    aboutSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
            // If not on home page, let the link redirect normally to /#about
        });
    });
});

// Existing mobile menu function
function toggleMenu() {
    const navbar = document.getElementById('navbar');
    navbar.classList.toggle('show');
}
</script>