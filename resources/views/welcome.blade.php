@extends('layouts.public')

@section('title', 'Rumah BUMN Telkom Pekalongan')
@section('description', 'Rumah BUMN adalah inisiatif Kementerian BUMN yang menjadi wadah kolaborasi dan pemberdayaan UMKM di seluruh Indonesia.')

@section('content')

    <!-- Hero Section with Background Image -->
    <section class="hero-section">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice">
            <defs>
                <clipPath id="trapeziumClip">
                    <path d="M1440 657H929.674L889 588H551L510.326 657H0V0H1440V657Z"/>
                </clipPath>
            </defs>
            <image href="{{ asset('images/kantordepan.jpg') }}" x="0" y="0" width="1440" height="700" clip-path="url(#trapeziumClip)" preserveAspectRatio="xMidYMid slice"/>
            <!-- Dark Overlay with same clip-path -->
            <rect x="0" y="0" width="1440" height="700" fill="rgba(0,0,0,0.30)" clip-path="url(#trapeziumClip)"/>
        </svg>
        
        <!-- Hero Text Overlay -->
        <div class="hero-text-overlay">
            <div class="hero-content">
                <h1>RUMAH BUMN TELKOM PEKALONGAN</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam bibendum in nunc at dictum. Duis elit odio, rhoncus at facilisis eget, rhoncus at nisl.</p>
            </div>
        </div>
        
        <!-- Floating Button -->
        <div class="floating-button-container">
            <a href="#gabung" class="btn-gabung">
                <span>BERGABUNG</span>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="about-content">
                <!-- Text Content -->
                <div class="about-text">
                    <h2>TENTANG KAMI</h2>
                    <p>Rumah BUMN adalah inisiatif Kementerian BUMN yang menjadi wadah kolaborasi dan pemberdayaan UMKM di seluruh Indonesia. Melalui pelatihan, pendampingan, dan digitalisasi, kami membantu UMKM meningkatkan kapasitas, memperkuat branding, hingga menjangkau pasar nasional dan global dengan konsep Go Modern, Go Digital, Go Online, Go Global. Sebagai rumah bersama, Rumah BUMN hadir sebagai pusat informasi, konsultasi, dan showcase produk unggulan daerah, sekaligus mendorong UMKM untuk terus tumbuh, berinovasi, dan berkontribusi bagi perekonomian bangsa.</p>
                    
                    <!-- Contact Info -->
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon phone-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <span>081234567890</span>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon email-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <span>loremipsum@lorem.com</span>
                        </div>
                    </div>
                </div>
                
                <!-- Image Content -->
                <div class="about-image">
                    <img src="{{ asset('images/kantordepan.jpg') }}" alt="Tentang Kami" class="about-img">
                </div>
            </div>
        </div>
    </section>

    <!-- 5 Pilar Section -->
    <section id="pilar" class="pilar-section section">
        <div class="container">
            <div class="section-header">
                <h2>5 PILAR RUMAH BUMN</h2>
                <p>Lima pilar utama yang menjadi fondasi kuat dalam menjalankan misi pemberdayaan UMKM di Indonesia</p>
            </div>

            <div class="pilar-grid">
                <div class="pilar-item" data-pilar="1" onclick="openPilarModal(1)">
                    <div class="pilar-image">
                        <img src="{{ asset('images/5 pilar/fungsi1.jpg') }}" alt="Pilar 1 - Rumah BUMN">
                    </div>
                    <div class="pilar-number">01</div>
                    <div class="pilar-overlay">
                        <p>Klik untuk info lebih lanjut</p>
                    </div>
                </div>
                
                <div class="pilar-item" data-pilar="2" onclick="openPilarModal(2)">
                    <div class="pilar-image">
                        <img src="{{ asset('images/5 pilar/fungsi2.jpg') }}" alt="Pilar 2 - Rumah BUMN">
                    </div>
                    <div class="pilar-number">02</div>
                    <div class="pilar-overlay">
                        <p>Klik untuk info lebih lanjut</p>
                    </div>
                </div>
                
                <div class="pilar-item" data-pilar="3" onclick="openPilarModal(3)">
                    <div class="pilar-image">
                        <img src="{{ asset('images/5 pilar/fungsi3.jpg') }}" alt="Pilar 3 - Rumah BUMN">
                    </div>
                    <div class="pilar-number">03</div>
                    <div class="pilar-overlay">
                        <p>Klik untuk info lebih lanjut</p>
                    </div>
                </div>
                
                <div class="pilar-item" data-pilar="4" onclick="openPilarModal(4)">
                    <div class="pilar-image">
                        <img src="{{ asset('images/5 pilar/fungsi4.jpg') }}" alt="Pilar 4 - Rumah BUMN">
                    </div>
                    <div class="pilar-number">04</div>
                    <div class="pilar-overlay">
                        <p>Klik untuk info lebih lanjut</p>
                    </div>
                </div>
                
                <div class="pilar-item" data-pilar="5" onclick="openPilarModal(5)">
                    <div class="pilar-image">
                        <img src="{{ asset('images/5 pilar/fungsi5.jpg') }}" alt="Pilar 5 - Rumah BUMN">
                    </div>
                    <div class="pilar-number">05</div>
                    <div class="pilar-overlay">
                        <p>Klik untuk info lebih lanjut</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Pilar -->
    <div id="pilarModal" class="pilar-modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closePilarModal()">&times;</span>
            <div class="modal-header">
                <div class="modal-number" id="modalNumber"></div>
                <h2 id="modalTitle"></h2>
            </div>
            <div class="modal-body">
                <div class="modal-image">
                    <img id="modalImage" src="" alt="">
                </div>
                <div class="modal-description">
                    <p id="modalDescription"></p>
                    <ul id="modalFeatures"></ul>
                </div>
            </div>
        </div>
    </div>
        </div>
    </section>

    <!-- UMKM Binaan Section -->
    <section id="umkm-binaan" class="umkm-binaan-section section">
        <div class="container">
            <div class="section-header">
                <h2>UMKM BINAAN</h2>
                <p>Jumlah UMKM yang telah dibina dan dikembangkan oleh Rumah BUMN Telkom Pekalongan dalam berbagai kategori usaha</p>
            </div>

            <div class="umkm-stats-grid">
                <div class="umkm-stat-card">
                    <div class="stat-icon fashion-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L13.09 8.26L22 9L17 14L18.18 22.74L12 19.27L5.82 22.74L7 14L2 9L10.91 8.26L12 2Z"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-target="45">0</div>
                        <h3>UMKM Fashion</h3>
                        <p>Usaha dibidang fashion, pakaian, aksesoris, dan produk tekstil yang telah dibina</p>
                    </div>
                </div>

                <div class="umkm-stat-card">
                    <div class="stat-icon food-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.1 13.34L1.94 7.18C1.54 6.78 1.54 6.14 1.94 5.74S3.04 5.34 3.44 5.74L9.54 11.84L8.1 13.34ZM14.88 11.53C14.5 11.16 13.86 11.16 13.49 11.53L11.53 13.49C11.16 13.86 11.16 14.5 11.53 14.88L12.64 16L7.88 20.76C7.48 21.16 7.48 21.8 7.88 22.2S8.98 22.6 9.38 22.2L14.14 17.44L15.25 18.55C15.62 18.92 16.26 18.92 16.63 18.55L18.59 16.59C18.96 16.22 18.96 15.58 18.59 15.21L14.88 11.53ZM22 10C22 12.21 20.21 14 18 14C15.79 14 14 12.21 14 10C14 9.45 14.09 8.92 14.26 8.42L15.61 9.77C15.75 10.17 16.03 10.5 16.41 10.68C16.79 10.86 17.23 10.86 17.61 10.68C17.99 10.5 18.27 10.17 18.41 9.77L22 6.18C22 7.45 22 8.72 22 10Z"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-target="67">0</div>
                        <h3>UMKM Makanan</h3>
                        <p>Usaha dibidang kuliner, makanan, dan minuman yang telah dikembangkan bersama</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="berita" class="news-section section">
        <div class="container">
            <div class="section-header">
                <h2>BERITA</h2>
                <p>Informasi terkini seputar kegiatan dan program Rumah BUMN Telkom Pekalongan</p>
            </div>

            @if($featuredNews || $regularNews->isNotEmpty())
                @if($featuredNews)
                    <!-- Featured News Hero Card -->
                    <div class="featured-news-hero">
                        <article class="featured-card" onclick="window.location.href='{{ route('berita.detail', $featuredNews->slug) }}'" style="cursor: pointer;">
                            <div class="featured-image">
                                <img src="{{ $featuredNews->image_url }}" alt="{{ $featuredNews->title }}">
                                <div class="featured-overlay">
                                    <div class="featured-category">{{ $featuredNews->category_label }}</div>
                                    <div class="featured-date">{{ $featuredNews->published_at->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="featured-content">
                                <span class="featured-label">Berita Utama</span>
                                <h3>{{ $featuredNews->title }}</h3>
                                <p>{{ $featuredNews->excerpt }}</p>
                                <a href="{{ route('berita.detail', $featuredNews->slug) }}" class="featured-read-more" onclick="event.stopPropagation()">
                                    <span>Baca Selengkapnya</span>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    </div>
                @endif

                @if($regularNews->isNotEmpty())
                    <!-- Regular News Grid 4 Kolom -->
                    <div class="regular-news-section">
                        <div class="news-grid-uniform">
                            @foreach($regularNews as $news)
                                <article class="news-card-uniform" onclick="window.location.href='{{ route('berita.detail', $news->slug) }}'" style="cursor: pointer;">
                                    <div class="news-image">
                                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                                        <div class="news-category">{{ $news->category_label }}</div>
                                        <div class="news-date">{{ $news->published_at->format('d M Y') }}</div>
                                    </div>
                                    <div class="news-content">
                                        <h3>{{ $news->title }}</h3>
                                        <p>{{ $news->excerpt }}</p>
                                        <a href="{{ route('berita.detail', $news->slug) }}" class="news-read-more" onclick="event.stopPropagation()">Baca Selengkapnya</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State - No News Available -->
                <div class="news-empty-state">
                    <div class="empty-state-content">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        <h3>Belum ada berita tersedia</h3>
                        <p>Admin belum menambahkan berita. Silakan kembali lagi nanti untuk melihat berita terbaru.</p>
                    </div>
                </div>
            @endif

            <!-- View All News Button -->
            @if($featuredNews || $regularNews->isNotEmpty())
                <div class="news-view-all">
                    <a href="{{ route('berita') }}" class="btn-view-all">
                        <span>Lihat Semua Berita</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Handle auto-scroll to #about section when coming from other pages
document.addEventListener('DOMContentLoaded', function() {
    // Check if URL has #about hash
    if (window.location.hash === '#about') {
        setTimeout(function() {
            const aboutSection = document.getElementById('about');
            if (aboutSection) {
                aboutSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }, 100); // Small delay to ensure page is fully loaded
    }
    
    // Counter Animation
    function animateCounter(element, target, duration = 2000) {
        let startValue = 0;
        let startTime = null;
        
        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentValue = Math.floor(easeOutQuart * target);
            
            element.textContent = currentValue.toLocaleString();
            
            if (progress < 1) {
                requestAnimationFrame(animation);
            } else {
                element.textContent = target.toLocaleString();
            }
        }
        
        requestAnimationFrame(animation);
    }
    
    // Intersection Observer for counter animation
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, target);
                counterObserver.unobserve(entry.target); // Only animate once
            }
        });
    }, observerOptions);
    
    // Observe all counter elements
    document.querySelectorAll('.stat-number, .summary-number').forEach(counter => {
        counterObserver.observe(counter);
    });
    
    // Data untuk setiap pilar
    window.pilarData = {
        1: {
            title: 'Pengembangan UMKM',
            image: '{{ asset("images/5 pilar/fungsi1.jpg") }}',
            description: 'Program pembinaan dan pengembangan UMKM melalui pendampingan bisnis, pelatihan kewirausahaan, dan akses permodalan untuk meningkatkan daya saing dan produktivitas pelaku usaha mikro, kecil, dan menengah.',
            features: [
                'Pelatihan dan workshop bisnis rutin',
                'Pendampingan business plan dan strategi pemasaran',
                'Akses pembiayaan dan permodalan',
                'Sertifikasi produk dan legalitas usaha',
                'Networking dengan mitra bisnis dan investor'
            ]
        },
        2: {
            title: 'Basecamp Milenial',
            image: '{{ asset("images/5 pilar/fungsi2.jpg") }}',
            description: 'Ruang kolaborasi dan inkubasi bagi generasi milenial dan Gen Z untuk mengembangkan ide bisnis, startup digital, dan inovasi teknologi dengan fasilitas lengkap dan mentor berpengalaman.',
            features: [
                'Workspace modern dengan teknologi terkini',
                'Program inkubasi startup dan digital business',
                'Mentoring dari praktisi industri',
                'Akses internet berkecepatan tinggi',
                'Event dan networking session rutin'
            ]
        },
        3: {
            title: 'Coworking Space',
            image: '{{ asset("images/5 pilar/fungsi3.jpg") }}',
            description: 'Penyediaan ruang kerja bersama yang modern dan nyaman dengan fasilitas lengkap untuk freelancer, startup, dan pelaku usaha yang membutuhkan tempat kerja fleksibel dan profesional.',
            features: [
                'Meeting room dan private office',
                'High-speed WiFi dan fasilitas IT',
                'Area lounge dan pantry',
                'Event space untuk seminar dan workshop',
            ]
        },
        4: {
            title: 'Informasi Tanggap Bencana',
            image: '{{ asset("images/5 pilar/fungsi4.jpg") }}',
            description: 'Pusat informasi dan koordinasi untuk kesiapsiagaan bencana, memberikan edukasi mitigasi risiko, sistem peringatan dini, dan koordinasi bantuan bagi UMKM yang terdampak bencana.',
            features: [
                'Sistem informasi dan peringatan dini bencana',
                'Pelatihan kesiapsiagaan dan mitigasi bencana',
                'Koordinasi dengan BPBD dan instansi terkait',
                'Program bantuan dan pemulihan UMKM terdampak',
            ]
        },
        5: {
            title: 'Penyaluran PK/BL & KUR',
            image: '{{ asset("images/5 pilar/fungsi5.jpg") }}',
            description: 'Program penyaluran Program Kemitraan (PK), Bina Lingkungan (BL), dan Kredit Usaha Rakyat (KUR) untuk memberikan akses permodalan yang mudah dan terjangkau bagi UMKM.',
            features: [
                'Kredit Usaha Rakyat (KUR) dengan bunga rendah',
                'Program Kemitraan BUMN untuk UMKM',
                'Bina Lingkungan untuk pengembangan masyarakat',
                'Pendampingan proposal dan administrasi',
                'Monitoring dan evaluasi penggunaan dana'
            ]
        }
    };
});

// Fungsi untuk membuka modal pilar
function openPilarModal(pilarNumber) {
    const modal = document.getElementById('pilarModal');
    const data = window.pilarData[pilarNumber];
    
    if (data) {
        document.getElementById('modalNumber').textContent = '0' + pilarNumber;
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalImage').src = data.image;
        document.getElementById('modalDescription').textContent = data.description;
        
        // Populate features list
        const featuresList = document.getElementById('modalFeatures');
        featuresList.innerHTML = '';
        data.features.forEach(feature => {
            const li = document.createElement('li');
            li.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                ${feature}
            `;
            featuresList.appendChild(li);
        });
        
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

// Fungsi untuk menutup modal pilar
function closePilarModal() {
    const modal = document.getElementById('pilarModal');
    modal.classList.add('closing');
    
    setTimeout(() => {
        modal.style.display = 'none';
        modal.classList.remove('closing');
        document.body.style.overflow = 'auto';
    }, 300); // Match animation duration
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('pilarModal');
    if (event.target === modal) {
        closePilarModal();
    }
}

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closePilarModal();
    }
});
</script>
@endpush