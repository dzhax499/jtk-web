@extends('layouts.app')

@section('title', 'Berita - JTK POLBAN')

@section('content')
    <x-hero 
        title="Berita"
        subtitle="Informasi terbaru seputar kegiatan, prestasi, dan informasi Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="true">
        <span>
            <a href="/" class="underline">Beranda</a> > 
            <span>Berita</span>
        </span>
    </x-hero>

    <section class="py-16 bg-[#FAFAFA] font-['Poppins']">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            
            <!-- Category and Search Row -->
            <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-6 mb-10">
                <!-- Categories Pills -->
                <div id="category-filter" class="flex flex-wrap gap-2.5">
                    <button type="button" data-category="" class="category-btn px-5 py-2.5 bg-[#00008B] text-white rounded-full font-bold text-sm shadow-sm transition hover:bg-blue-900">
                        Semua Berita
                    </button>
                    <button type="button" data-category="prestasi" class="category-btn px-5 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-full font-bold text-sm hover:border-[#00008B] hover:text-[#00008B] transition">
                        Prestasi
                    </button>
                </div>

                <!-- Search Box -->
                <div class="relative w-full md:w-80 shrink-0">
                    <input 
                        id="news-search"
                        type="text" 
                        placeholder="Cari Berita..."
                        class="w-full px-5 py-2.5 pr-12 border border-gray-300 bg-white rounded-full focus:outline-none focus:border-[#00008B] text-sm text-gray-700 font-medium"
                    >
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two-Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                <!-- Left Column: News List (75%) -->
                <div class="lg:col-span-3 space-y-8">
                    
                    <!-- Loading Shimmer -->
                    <div id="news-loading" class="space-y-6">
                        @for($i = 0; $i < 3; $i++)
                            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm flex flex-col md:flex-row h-auto md:h-56 animate-pulse">
                                <div class="w-full md:w-[40%] bg-gray-200 h-48 md:h-full"></div>
                                <div class="w-full md:w-[60%] p-6 space-y-4 flex flex-col justify-center">
                                    <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                                    <div class="h-6 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- News List Container -->
                    <div id="news-grid" class="space-y-6 hidden">
                        <!-- Items via JS -->
                    </div>

                    <!-- Empty State -->
                    <div id="news-empty" class="hidden text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-xl font-bold text-navy-900 mb-2">Data berita belum ditemukan</p>
                        <p class="text-gray-500 font-medium">Coba ubah kata kunci pencarian atau kategori.</p>
                    </div>

                    <!-- Error State -->
                    <div id="news-error" class="hidden text-center py-16 bg-red-50 rounded-2xl border border-red-100 shadow-sm">
                        <p class="text-xl font-bold text-red-700 mb-2">Gagal mengambil data berita</p>
                        <p class="text-red-500 font-medium">Pastikan koneksi internet stabil atau hubungi admin.</p>
                    </div>

                    <!-- Pagination Container -->
                    <div id="news-pagination" class="flex justify-center items-center gap-2 pt-6">
                        <!-- Pagination via JS -->
                    </div>

                </div>

                <!-- Right Column: Sidebar (25%) -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Berita Terkini Box -->
                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                        <div class="bg-[#00008B] text-white px-5 py-4 font-bold text-sm tracking-wide flex items-center space-x-2.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2v3m2 3V10m0 0a2 2 0 01-2-2h3m-3 2h3m-3 3h3M9 8h2m-2 3h2m-2 3h2m-3-6h.01M6 11h.01M6 14h.01"></path>
                            </svg>
                            <span>Berita Terkini</span>
                        </div>
                        <div id="recent-news-list" class="p-5 space-y-4">
                            <!-- Loading Shimmer Sidebar -->
                            <div class="space-y-4">
                                @for($i = 0; $i < 4; $i++)
                                    <div class="flex items-center space-x-3.5 animate-pulse">
                                        <div class="w-20 h-14 bg-gray-200 rounded-lg shrink-0"></div>
                                        <div class="flex-1 space-y-2">
                                            <div class="h-3.5 bg-gray-200 rounded w-full"></div>
                                            <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const state = { category: '', search: '', page: 1 };
            const placeholder = 'https://placehold.co/600x400?text=JTK+POLBAN';

            const grid = document.getElementById('news-grid');
            const loading = document.getElementById('news-loading');
            const empty = document.getElementById('news-empty');
            const error = document.getElementById('news-error');
            const searchInput = document.getElementById('news-search');
            const paginationContainer = document.getElementById('news-pagination');

            const escapeHtml = (value) => String(value ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');

            const setStatus = (status) => {
                loading.classList.toggle('hidden', status !== 'loading');
                grid.classList.toggle('hidden', status !== 'success');
                empty.classList.toggle('hidden', status !== 'empty');
                error.classList.toggle('hidden', status !== 'error');
                paginationContainer.classList.toggle('hidden', status !== 'success');
            };

            const postCard = (post) => {
                const image = post.image_url || post.featured_media?.url || placeholder;
                const slug = post.slug || post.id;
                
                // Show category badge
                let categoryLabel = 'Berita';
                if (post.category) {
                    categoryLabel = post.category;
                } else if (post.type === 'prestasi') {
                    categoryLabel = 'Prestasi Mahasiswa';
                }

                return `
                    <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300 flex flex-col md:flex-row h-auto md:h-56">
                        <!-- Image Container on the Left -->
                        <div class="relative w-full md:w-[38%] shrink-0 h-48 md:h-full overflow-hidden">
                            <a href="/berita/${encodeURIComponent(slug)}" class="block h-full w-full">
                                <img src="${escapeHtml(image)}" alt="${escapeHtml(post.title)}" class="w-full h-full object-cover hover:scale-[1.03] transition duration-500" onerror="this.onerror=null;this.src='${placeholder}';">
                            </a>
                            <!-- Category Badge inside Image -->
                            <span class="absolute bottom-3 left-3 px-3 py-1 bg-[#00008B] text-white rounded text-[11px] font-bold tracking-wide shadow uppercase">
                                ${escapeHtml(categoryLabel)}
                            </span>
                        </div>
                        <!-- Content Block on the Right -->
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div>
                                <a href="/berita/${encodeURIComponent(slug)}" class="block group">
                                    <h3 class="text-[17px] font-bold text-gray-800 leading-snug group-hover:text-[#00008B] transition duration-200 line-clamp-2">${escapeHtml(post.title || 'Tanpa Judul')}</h3>
                                </a>
                                <!-- Meta Block -->
                                <div class="flex items-center space-x-4 text-xs text-gray-400 font-semibold mt-2.5">
                                    <span class="flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span>${escapeHtml(post.author?.name || 'Humas JTK')}</span>
                                    </span>
                                    <span class="flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>${escapeHtml(post.date_label || '-')}</span>
                                    </span>
                                    <span class="flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <span>${escapeHtml(post.views ?? 0)} Views</span>
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 font-medium line-clamp-2 mt-3 leading-relaxed">${escapeHtml(post.excerpt || '')}</p>
                            </div>
                            <div class="flex justify-end items-center mt-3">
                                <a href="/berita/${encodeURIComponent(slug)}" class="text-[#00008B] hover:text-blue-800 text-[13px] font-bold flex items-center space-x-1 transition">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                `;
            };

            const buildUrl = () => {
                const params = new URLSearchParams({ per_page: '6' });

                if (state.page) {
                    params.set('page', state.page);
                }

                if (state.category === 'prestasi') {
                    params.set('type', 'prestasi');
                }

                if (state.search.trim()) {
                    params.set('search', state.search.trim());
                }

                return `/api/posts?${params.toString()}`;
            };

            const renderPagination = (meta) => {
                if (!meta || meta.last_page <= 1) {
                    paginationContainer.innerHTML = '';
                    return;
                }

                let html = '';
                
                // Prev button
                const prevDisabled = meta.current_page === 1;
                html += `
                    <button ${prevDisabled ? 'disabled' : ''} data-page="${meta.current_page - 1}" class="px-3.5 py-2 border border-gray-300 rounded-lg text-sm font-semibold transition ${prevDisabled ? 'text-gray-400 bg-gray-50 cursor-not-allowed' : 'text-[#00008B] bg-white hover:bg-blue-50'}">
                        &lt;
                    </button>
                `;

                const addPageButton = (page) => {
                    const active = page === meta.current_page;
                    html += `
                        <button data-page="${page}" class="px-4 py-2 border rounded-lg text-sm font-bold transition ${active ? 'bg-[#00008B] text-white border-[#00008B]' : 'bg-white border-gray-300 text-[#00008B] hover:bg-blue-50'}">
                            ${page}
                        </button>
                    `;
                };

                const addDots = () => {
                    html += `
                        <span class="px-3 py-2 text-gray-400 font-bold">...</span>
                    `;
                };

                const maxVisible = 5;
                if (meta.last_page <= maxVisible + 2) {
                    for (let i = 1; i <= meta.last_page; i++) {
                        addPageButton(i);
                    }
                } else {
                    addPageButton(1);
                    
                    if (meta.current_page > 3) {
                        addDots();
                    }

                    const start = Math.max(2, meta.current_page - 1);
                    const end = Math.min(meta.last_page - 1, meta.current_page + 1);

                    for (let i = start; i <= end; i++) {
                        if (i > 1 && i < meta.last_page) {
                            addPageButton(i);
                        }
                    }

                    if (meta.current_page < meta.last_page - 2) {
                        addDots();
                    }

                    addPageButton(meta.last_page);
                }

                // Next button
                const nextDisabled = meta.current_page === meta.last_page;
                html += `
                    <button ${nextDisabled ? 'disabled' : ''} data-page="${meta.current_page + 1}" class="px-3.5 py-2 border border-gray-300 rounded-lg text-sm font-semibold transition ${nextDisabled ? 'text-gray-400 bg-gray-50 cursor-not-allowed' : 'text-[#00008B] bg-white hover:bg-blue-50'}">
                        &gt;
                    </button>
                `;

                paginationContainer.innerHTML = html;

                // Add event listeners to pagination buttons
                paginationContainer.querySelectorAll('button').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const page = parseInt(btn.dataset.page);
                        if (page && page !== meta.current_page) {
                            state.page = page;
                            loadPosts();
                            window.scrollTo({ top: 300, behavior: 'smooth' });
                        }
                    });
                });
            };

            const loadPosts = async () => {
                setStatus('loading');
                try {
                    const response = await fetch(buildUrl());
                    if (!response.ok) throw new Error('API gagal');

                    const json = await response.json();
                    const posts = json.data || [];

                    if (posts.length === 0) {
                        setStatus('empty');
                        return;
                    }

                    grid.innerHTML = posts.map(postCard).join('');
                    renderPagination(json.meta);
                    setStatus('success');
                } catch (e) {
                    setStatus('error');
                }
            };

            const loadRecentPosts = async () => {
                try {
                    const response = await fetch('/api/posts?per_page=5');
                    if (!response.ok) return;
                    const json = await response.json();
                    const recentPosts = json.data || [];
                    const sidebarList = document.getElementById('recent-news-list');
                    if (!sidebarList) return;
                    
                    sidebarList.innerHTML = recentPosts.map(post => {
                        const image = post.image_url || post.featured_media?.url || placeholder;
                        const slug = post.slug || post.id;
                        return `
                            <a href="/berita/${encodeURIComponent(slug)}" class="flex items-start space-x-3.5 group border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                                <img src="${escapeHtml(image)}" alt="${escapeHtml(post.title)}" class="w-20 h-14 object-cover rounded-lg shrink-0 group-hover:opacity-85 transition" onerror="this.onerror=null;this.src='${placeholder}';">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 text-[13px] line-clamp-2 leading-snug group-hover:text-[#00008B] transition">${escapeHtml(post.title)}</h4>
                                    <span class="text-xs text-gray-400 mt-1 block">📅 ${escapeHtml(post.date_label || '-')}</span>
                                </div>
                            </a>
                        `;
                    }).join('');
                } catch (e) {
                    console.error('Failed to load recent posts', e);
                }
            };

            // Setup category filter click handlers
            const setupCategoryFilters = () => {
                const buttons = document.querySelectorAll('.category-btn');
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const category = button.dataset.category || '';
                        state.category = category;
                        state.page = 1; // Reset to page 1

                        // Toggle active button style
                        buttons.forEach(btn => {
                            btn.className = 'category-btn px-5 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-full font-bold text-sm hover:border-[#00008B] hover:text-[#00008B] transition';
                        });
                        button.className = 'category-btn px-5 py-2.5 bg-[#00008B] text-white rounded-full font-bold text-sm shadow-sm transition hover:bg-blue-900';
                        
                        loadPosts();
                    });
                });
            };

            // Search input logic (with debounce)
            let searchTimeout;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    state.search = searchInput.value;
                    state.page = 1; // Reset to page 1
                    loadPosts();
                }, 350);
            });

            setupCategoryFilters();
            loadPosts();
            loadRecentPosts();
        });
    </script>
@endsection
