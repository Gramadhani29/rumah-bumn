<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah BUMN Telkom Pekalongan')</title>
    <meta name="description" content="@yield('description', 'Rumah BUMN adalah inisiatif Kementerian BUMN yang menjadi wadah kolaborasi dan pemberdayaan UMKM di seluruh Indonesia.')">
    
    <!-- Preconnect for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Public Booking Specific Styles -->
    <style>
    /* Booking Page Specific Styles for Public Users */
    .booking-info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .info-card {
        background: linear-gradient(135deg, #0098ff 0%, #0066cc 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 10px 30px rgba(0, 152, 255, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card * {
        color: white !important;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 152, 255, 0.4);
    }

    .info-icon {
        background: rgba(255, 255, 255, 0.2);
        padding: 12px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-content h3 {
        margin: 0 0 5px 0;
        font-size: 18px;
        font-weight: 600;
        color: white !important;
    }

    .info-content p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
        color: white !important;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .room-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .room-image {
        position: relative;
        height: 200px;
        background: linear-gradient(45deg, #f0f2f5, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: #95a5a6;
        text-align: center;
    }

    .room-placeholder span {
        font-weight: 600;
        font-size: 16px;
    }

    .room-status {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .room-status.available {
        background: #d4edda;
        color: #155724;
    }

    .room-content {
        padding: 25px;
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .room-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1.3;
    }

    .room-description {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .room-details {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #6c757d;
    }

    .detail-item svg {
        color: #0098ff;
    }

    .room-facilities h4 {
        margin: 0 0 10px 0;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
    }

    .facilities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .facility-tag {
        background: #ecf0f1;
        color: #2c3e50;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }

    .facility-more {
        background: #0098ff;
        color: white;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }

    .room-actions {
        display: flex;
        gap: 10px;
    }

    .btn-book {
        flex: 1;
        background: linear-gradient(135deg, #0098ff 0%, #0066cc 100%);
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 152, 255, 0.4);
        text-decoration: none;
        color: white;
    }

    .btn-details {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #6c757d;
        padding: 12px 16px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-details:hover {
        background: #e9ecef;
        color: #495057;
    }

    .no-rooms {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .no-rooms-icon {
        margin-bottom: 20px;
    }

    .no-rooms h3 {
        margin: 0 0 10px 0;
        color: #495057;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background: white;
        border-radius: 15px;
        width: 90%;
        max-width: 700px;
        max-height: 85vh;
        overflow-y: auto;
        animation: slideUp 0.3s ease;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    @keyframes slideUp {
        from { 
            transform: translateY(30px);
            opacity: 0;
        }
        to { 
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #dee2e6;
    }

    .modal-header h3 {
        margin: 0;
        color: #2c3e50;
    }

    .modal-close {
        background: none;
        border: none;
        cursor: pointer;
        color: #6c757d;
        font-size: 24px;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .modal-close:hover {
        color: #495057;
    }

    .modal-body {
        padding: 25px;
    }

    .loading {
        text-align: center;
        padding: 40px;
        color: #6c757d;
    }

    /* Booking Form Styles */
    .booking-form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .booking-form-header {
        background: linear-gradient(135deg, #0098ff 0%, #0066cc 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .booking-form-header h2 {
        margin: 0 0 10px 0;
        font-size: 24px;
        font-weight: 700;
    }

    .booking-form-header p {
        margin: 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .booking-form-content {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #0098ff;
        box-shadow: 0 0 0 3px rgba(0, 152, 255, 0.1);
    }

    .form-control.error {
        border-color: #e74c3c;
    }

    .form-control.error:focus {
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
    }

    .error-message {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0098ff 0%, #0066cc 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        width: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 152, 255, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-secondary:hover {
        background: #e9ecef;
        color: #495057;
        text-decoration: none;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .booking-info-cards {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .rooms-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .room-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .room-details {
            flex-direction: column;
            gap: 10px;
        }
        
        .room-actions {
            flex-direction: column;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .form-actions {
            flex-direction: column;
        }

        .booking-form-content {
            padding: 20px;
        }

        .booking-form-header {
            padding: 20px;
        }
    }

    /* Success/Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .alert-info {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    /* Loading State */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .btn-loading {
        opacity: 0.7;
        cursor: not-allowed;
    }
    </style>
    
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

        // Form validation helpers
        function validateForm(formId) {
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('.form-control[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('error');
                    showError(input, 'Field ini wajib diisi');
                    isValid = false;
                } else {
                    input.classList.remove('error');
                    hideError(input);
                }
            });

            return isValid;
        }

        function showError(input, message) {
            hideError(input);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = message;
            input.parentNode.appendChild(errorDiv);
        }

        function hideError(input) {
            const existingError = input.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
        }

        // Button loading state
        function setButtonLoading(button, loading = true) {
            if (loading) {
                button.disabled = true;
                button.classList.add('btn-loading');
                const originalText = button.textContent;
                button.setAttribute('data-original-text', originalText);
                button.innerHTML = '<span class="loading-spinner"></span>Memproses...';
            } else {
                button.disabled = false;
                button.classList.remove('btn-loading');
                const originalText = button.getAttribute('data-original-text');
                if (originalText) {
                    button.textContent = originalText;
                }
            }
        }
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>