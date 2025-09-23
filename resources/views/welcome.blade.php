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
});
</script>
@endpush