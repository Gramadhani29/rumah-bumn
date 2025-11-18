<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rumah BUMN Telkom Pekalongan')</title>
    <meta name="description" content="@yield('description', 'Rumah BUMN adalah inisiatif Kementerian BUMN yang menjadi wadah kolaborasi dan pemberdayaan UMKM di seluruh Indonesia.')">
    
    <!-- Preconnect for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    @include('layouts.public-navigation')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Footer Top -->
            <div class="footer-top">
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="{{ asset('images/Logo RBP.png') }}" alt="Rumah BUMN Pekalongan" class="footer-logo-img">
                    </div>
                    <p class="footer-desc">Rumah BUMN adalah inisiatif Kementerian BUMN yang menjadi wadah kolaborasi dan pemberdayaan UMKM di seluruh Indonesia.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link instagram-link">
                            <img src="{{ asset('images/instagram.svg') }}" alt="Instagram" style="width:16px; height:16px;">
                        </a>
                        <a href="#" class="social-link tiktok-link">
                            <img src="{{ asset('images/tiktok.svg') }}" alt="TikTok" style="width:16px; height:16px;">
                        </a>
                        <a href="#" class="social-link whatsapp-link">
                            <img src="{{ asset('images/whatsapp.svg') }}" alt="WhatsApp" style="width:16px; height:16px;">
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Kontak</h4>
                    <div class="footer-contact">
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <span>Jl. Veteran No. 23, Pekalongan</span>
                        </div>
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            <span>(0285) 123456</span>
                        </div>
                        <div class="contact-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            <span>rumahbumn.pekalongan@telkom.co.id</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 Rumah BUMN Telkom Pekalongan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleMenu() {
            const navbar = document.getElementById('navbar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            navbar.classList.toggle('active');
            menuToggle.classList.toggle('active');
        }
        
        // Close menu when clicking on a link
        document.querySelectorAll('.navbar a').forEach(link => {
            link.addEventListener('click', () => {
                const navbar = document.getElementById('navbar');
                const menuToggle = document.querySelector('.menu-toggle');
                
                navbar.classList.remove('active');
                menuToggle.classList.remove('active');
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            const scrollPosition = window.scrollY;
            
            if (scrollPosition > 100) {
                header.classList.add('scrolled');
                header.classList.remove('transparent');
            } else if (scrollPosition > 50) {
                header.classList.add('transparent');
                header.classList.remove('scrolled');
            } else {
                header.classList.remove('scrolled', 'transparent');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>