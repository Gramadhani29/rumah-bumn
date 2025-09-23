@extends('layouts.public')

@section('title', 'Berita - Rumah BUMN Telkom Pekalongan')
@section('description', 'Informasi terkini seputar kegiatan dan program Rumah BUMN Telkom Pekalongan')

@section('content')

    <!-- Page Header -->
    <section class="page-header-section">
        <div class="container">
            <div class="page-header-content">
                <nav class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Beranda
                    </a>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                    <span>Berita</span>
                </nav>
                
                <h1>Berita Terkini</h1>
                <p>Informasi terbaru seputar program dan kegiatan Rumah BUMN Telkom Pekalongan</p>
            </div>
        </div>
    </section>

    <!-- News Filter -->
    <section class="news-filter-section">
        <div class="container">
            <div class="news-filter-header">
                <h2>Jelajahi Berita</h2>
                <p>Temukan berita berdasarkan kategori atau gunakan pencarian</p>
            </div>
            
            <div class="news-filter-controls">
                <div class="filter-tabs-container">
                    <div class="filter-tabs">
                        <button class="filter-tab active" data-category="all">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
                            </svg>
                            Semua
                        </button>
                        <button class="filter-tab" data-category="program-utama">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            Program Utama
                        </button>
                        <button class="filter-tab" data-category="pelatihan">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/>
                            </svg>
                            Pelatihan
                        </button>
                        <button class="filter-tab" data-category="prestasi">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            Prestasi
                        </button>
                        <button class="filter-tab" data-category="kemitraan">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A2.997 2.997 0 0 0 17.06 7H16.5c-.83 0-1.5.67-1.5 1.5v7c0 1.1.9 2 2 2h1v4h2zm-12.5 0v-7.5c0-1.1.9-2 2-2h1.54c.5 0 .97.21 1.3.57l1.96 2.13V22h2v-5l-2.3-2.5 1.94-2.07L12 9.5l-3-2.25v4.5C9 12 8.87 12 8.75 12l-.9-.2L7.5 10S8 10 8.25 10H7.5c-.83 0-1.5.67-1.5 1.5V22h2.5z"/>
                            </svg>
                            Kemitraan
                        </button>
                        <button class="filter-tab" data-category="event">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                            Event
                        </button>
                    </div>
                </div>
                
                <div class="filter-search-container">
                    <div class="filter-search">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                        </svg>
                        <input type="text" placeholder="Cari berita..." class="search-input">
                        <button class="search-clear" style="display: none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Listing -->
    <section class="news-listing">
        <div class="container">
            <div class="news-listing-header">
                <div class="news-count">
                    <span class="showing-text">Menampilkan <strong>{{ $news->count() }}</strong> dari <strong>{{ $news->total() }}</strong> berita</span>
                </div>
                <div class="news-sort">
                    <select class="sort-select">
                        <option value="latest">Terbaru</option>
                        <option value="popular">Terpopuler</option>
                        <option value="oldest">Terlama</option>
                    </select>
                </div>
            </div>
            
            <div class="news-listing-grid">
                @forelse($news as $item)
                    <!-- News Item -->
                    <article class="news-item" data-category="{{ $item->category }}" onclick="window.location.href='{{ route('berita.detail', $item->slug) }}'" style="cursor: pointer;">
                        <div class="news-item-wrapper">
                            <div class="news-item-image">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
                                <div class="news-item-overlay">
                                    <span class="news-item-category">{{ $item->category_label }}</span>
                                    <div class="news-item-actions">
                                        <button class="news-action-btn" title="Bookmark" onclick="event.stopPropagation()">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                        </button>
                                        <button class="news-action-btn" title="Share" onclick="event.stopPropagation()">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="18" cy="5" r="3"></circle>
                                                <circle cx="6" cy="12" r="3"></circle>
                                                <circle cx="18" cy="19" r="3"></circle>
                                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="news-item-content">
                                <div class="news-item-meta-top">
                                    <span class="news-item-date">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                        </svg>
                                        {{ $item->published_at->format('d M Y') }}
                                    </span>
                                    <span class="news-item-read-time">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        {{ ceil(str_word_count(strip_tags($item->content)) / 200) }} min baca
                                    </span>
                                </div>
                                
                                <h3 class="news-item-title">{{ $item->title }}</h3>
                                <p class="news-item-excerpt">{{ $item->excerpt }}</p>
                                
                                <div class="news-item-meta-bottom">
                                    <div class="news-item-author">
                                        <div class="author-avatar">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                        <span class="author-name">{{ $item->author->name }}</span>
                                    </div>
                                    
                                    <div class="news-item-stats">
                                        <span class="news-item-views">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                            {{ number_format($item->views) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('berita.detail', $item->slug) }}" class="news-item-link" onclick="event.stopPropagation()">
                                    <span>Baca Selengkapnya</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <!-- Empty State -->
                    <div class="news-empty-state">
                        <div class="empty-state-icon">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        </div>
                        <h3>Belum ada berita tersedia</h3>
                        <p>Belum ada berita yang dipublikasikan saat ini. Silakan kembali lagi nanti untuk melihat update terbaru.</p>
                        <a href="{{ url('/') }}" class="btn-back-home">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
                <div class="news-pagination">
                    {{ $news->links() }}
                </div>
            @endif
    </section>
@endsection

@push('scripts')
<script>
    // Enhanced Filter Functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const newsItems = document.querySelectorAll('.news-item');
    let activeFilters = ['all'];

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            tab.classList.add('active');
            
            const category = tab.getAttribute('data-category');
            activeFilters = [category];
            
            // Apply filters
            applyFilters();
            
            // Update URL without reloading page
            const url = new URL(window.location);
            if (category === 'all') {
                url.searchParams.delete('category');
            } else {
                url.searchParams.set('category', category);
            }
            window.history.pushState({}, '', url);
        });
    });

    function applyFilters() {
        let visibleCount = 0;
        
        newsItems.forEach(item => {
            const category = item.getAttribute('data-category');
            const shouldShow = activeFilters.includes('all') || activeFilters.includes(category);
            
            if (shouldShow) {
                item.style.display = 'block';
                item.style.opacity = '0';
                setTimeout(() => {
                    item.style.opacity = '1';
                }, visibleCount * 50);
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Update count display
        const countElement = document.querySelector('.showing-text');
        if (countElement) {
            const totalFiltered = visibleCount;
            const totalAll = newsItems.length;
            countElement.innerHTML = `Menampilkan <strong>${totalFiltered}</strong> dari <strong>${totalAll}</strong> berita`;
        }
    }

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchClear = document.querySelector('.search-clear');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        if (searchTerm.length > 0) {
            searchClear.style.display = 'block';
        } else {
            searchClear.style.display = 'none';
        }
        
        newsItems.forEach(item => {
            const title = item.querySelector('.news-item-title').textContent.toLowerCase();
            const content = item.querySelector('.news-item-excerpt').textContent.toLowerCase();
            const matchesSearch = title.includes(searchTerm) || content.includes(searchTerm);
            
            if (matchesSearch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    searchClear.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        
        // Reset all items to visible based on current filter
        applyFilters();
    });

    // Sort functionality
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            const newsGrid = document.querySelector('.news-listing-grid');
            const items = Array.from(newsGrid.children);
            
            items.sort((a, b) => {
                if (sortValue === 'latest') {
                    const dateA = new Date(a.dataset.date);
                    const dateB = new Date(b.dataset.date);
                    return dateB - dateA;
                } else if (sortValue === 'oldest') {
                    const dateA = new Date(a.dataset.date);
                    const dateB = new Date(b.dataset.date);
                    return dateA - dateB;
                } else if (sortValue === 'popular') {
                    // Assuming we have view count in dataset
                    const viewsA = parseInt(a.dataset.views || 0);
                    const viewsB = parseInt(b.dataset.views || 0);
                    return viewsB - viewsA;
                }
                return 0;
            });
            
            // Reorder items in DOM
            items.forEach(item => newsGrid.appendChild(item));
        });
    }

    // Load URL parameters on page load
    window.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const category = urlParams.get('category');
        
        if (category && category !== 'all') {
            const tab = document.querySelector(`[data-category="${category}"]`);
            if (tab) {
                filterTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                activeFilters = [category];
                applyFilters();
            }
        }
    });
</script>
@endpush
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

        // Enhanced Filter Functionality
        const filterTabs = document.querySelectorAll('.filter-tab');
        const newsItems = document.querySelectorAll('.news-item');
        let activeFilters = ['all'];

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                tab.classList.add('active');
                
                const category = tab.getAttribute('data-category');
                activeFilters = [category];
                
                // Apply filters
                applyFilters();
                
                // Update URL without refresh
                const url = new URL(window.location);
                if (category === 'all') {
                    url.searchParams.delete('category');
                } else {
                    url.searchParams.set('category', category);
                }
                window.history.pushState({}, '', url);
            });
        });

        // Enhanced Search Functionality
        const searchInput = document.querySelector('.search-input');
        const searchClear = document.querySelector('.search-clear');
        let searchTimer;
        
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.trim();
            
            // Show/hide clear button
            if (searchTerm) {
                searchClear.style.display = 'flex';
            } else {
                searchClear.style.display = 'none';
            }
            
            // Debounce search
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                applySearch(searchTerm);
            }, 300);
        });

        searchClear.addEventListener('click', () => {
            searchInput.value = '';
            searchClear.style.display = 'none';
            applySearch('');
        });

        function applyFilters() {
            const currentSearch = searchInput.value.toLowerCase().trim();
            
            newsItems.forEach(item => {
                const category = item.getAttribute('data-category');
                const title = item.querySelector('.news-item-title').textContent.toLowerCase();
                const excerpt = item.querySelector('.news-item-excerpt').textContent.toLowerCase();
                
                const matchesFilter = activeFilters.includes('all') || activeFilters.includes(category);
                const matchesSearch = !currentSearch || title.includes(currentSearch) || excerpt.includes(currentSearch);
                
                if (matchesFilter && matchesSearch) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.3s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateResultCount();
        }

        function applySearch(searchTerm) {
            newsItems.forEach(item => {
                const category = item.getAttribute('data-category');
                const title = item.querySelector('.news-item-title').textContent.toLowerCase();
                const excerpt = item.querySelector('.news-item-excerpt').textContent.toLowerCase();
                
                const matchesFilter = activeFilters.includes('all') || activeFilters.includes(category);
                const matchesSearch = !searchTerm || title.includes(searchTerm) || excerpt.includes(searchTerm);
                
                if (matchesFilter && matchesSearch) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.3s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateResultCount();
        }

        function updateResultCount() {
            const visibleItems = Array.from(newsItems).filter(item => item.style.display !== 'none');
            const countElement = document.querySelector('.showing-text');
            if (countElement) {
                const totalItems = newsItems.length;
                countElement.innerHTML = `Menampilkan <strong>${visibleItems.length}</strong> dari <strong>${totalItems}</strong> berita`;
            }
        }

        // Sort functionality
        const sortSelect = document.querySelector('.sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                const sortBy = e.target.value;
                sortNews(sortBy);
            });
        }

        function sortNews(sortBy) {
            const container = document.querySelector('.news-listing-grid');
            const items = Array.from(newsItems);
            
            items.sort((a, b) => {
                switch (sortBy) {
                    case 'popular':
                        const viewsA = parseInt(a.querySelector('.news-item-views').textContent.replace(/\D/g, ''));
                        const viewsB = parseInt(b.querySelector('.news-item-views').textContent.replace(/\D/g, ''));
                        return viewsB - viewsA;
                    
                    case 'oldest':
                        const dateA = new Date(a.querySelector('.news-item-date').textContent);
                        const dateB = new Date(b.querySelector('.news-item-date').textContent);
                        return dateA - dateB;
                    
                    case 'latest':
                    default:
                        const latestDateA = new Date(a.querySelector('.news-item-date').textContent);
                        const latestDateB = new Date(b.querySelector('.news-item-date').textContent);
                        return latestDateB - latestDateA;
                }
            });
            
            // Remove all items and re-append in sorted order
            items.forEach(item => container.appendChild(item));
        }

        // News action buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.news-action-btn')) {
                const btn = e.target.closest('.news-action-btn');
                const title = btn.title;
                
                if (title === 'Bookmark') {
                    btn.classList.toggle('active');
                    // Add bookmark functionality here
                } else if (title === 'Share') {
                    // Add share functionality here
                    if (navigator.share) {
                        const newsItem = btn.closest('.news-item');
                        const title = newsItem.querySelector('.news-item-title').textContent;
                        navigator.share({
                            title: title,
                            url: window.location.href
                        });
                    }
                }
            }
        });

        // Load URL parameters on page load
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const category = urlParams.get('category');
            
            if (category && category !== 'all') {
                const tab = document.querySelector(`[data-category="${category}"]`);
                if (tab) {
                    filterTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    activeFilters = [category];
                    applyFilters();
                }
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>