@extends('layouts.app')

@section('title', 'Prestasi Mahasiswa - JTK POLBAN')

@section('content')
    <x-hero 
        title="Prestasi Mahasiswa"
        subtitle="Informasi tentang prestasi dan pencapaian mahasiswa Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="true">
        <span>
            <a href="/" class="underline hover:text-white transition">Beranda</a> > 
            <span class="text-gray-300">Prestasi Mahasiswa</span>
        </span>
    </x-hero>

    <section class="py-16 bg-[#FAFAFA] font-['Poppins']">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            
            <!-- Category and Search Row -->
            <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-6 mb-10">
                <!-- Categories Pills -->
                <div id="category-filter" class="flex flex-wrap gap-2.5">
                    <button type="button" data-search="" class="category-btn px-5 py-2.5 bg-[#00008B] text-white rounded-full font-bold text-sm shadow-sm transition hover:bg-blue-900">
                        Semua Prestasi
                    </button>
                    <button type="button" data-search="akademik" class="category-btn px-5 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-full font-bold text-sm hover:border-[#00008B] hover:text-[#00008B] transition">
                        Kompetisi Akademik
                    </button>
                    <button type="button" data-search="olahraga seni musik" class="category-btn px-5 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-full font-bold text-sm hover:border-[#00008B] hover:text-[#00008B] transition">
                        Kompetisi Non Akademik
                    </button>
                    <button type="button" data-search="penghargaan" class="category-btn px-5 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-full font-bold text-sm hover:border-[#00008B] hover:text-[#00008B] transition">
                        Penghargaan
                    </button>
                </div>

                <!-- Search Box -->
                <div class="relative w-full md:w-80 shrink-0">
                    <input 
                        id="achievement-search"
                        type="text" 
                        placeholder="Cari Prestasi..."
                        class="w-full px-5 py-2.5 pr-12 border border-gray-300 bg-white rounded-full focus:outline-none focus:border-[#00008B] text-sm text-gray-700 font-medium"
                    >
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Loading Shimmer -->
            <div id="achievement-loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for($i = 0; $i < 6; $i++)
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm animate-pulse">
                        <div class="h-48 bg-gray-200"></div>
                        <div class="p-6 space-y-4">
                            <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                            <div class="h-6 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Grid Content -->
            <div id="achievement-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 hidden">
                <!-- Items via JS -->
            </div>

            <!-- Empty State -->
            <div id="achievement-empty" class="hidden text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-xl font-bold text-navy-900 mb-2">Data prestasi belum ditemukan</p>
                <p class="text-gray-500 font-medium">Coba ubah kata kunci pencarian atau kategori.</p>
            </div>

            <!-- Error State -->
            <div id="achievement-error" class="hidden text-center py-16 bg-red-50 rounded-2xl border border-red-100 shadow-sm">
                <p class="text-xl font-bold text-red-700 mb-2">Gagal mengambil data prestasi</p>
                <p class="text-red-500 font-medium">Pastikan koneksi internet stabil atau hubungi admin.</p>
            </div>

            <!-- Pagination Container -->
            <div id="achievement-pagination" class="flex justify-center items-center gap-2 pt-10">
                <!-- Pagination via JS -->
            </div>

        </div>
    </section>
    
    <section class="bg-gradient-to-r from-[#00008B] to-blue-900 py-16 text-white font-['Poppins']">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/10">
                    <p id="achievement-total" class="text-5xl font-extrabold mb-2">-</p>
                    <p class="text-gray-200 font-semibold">Total Prestasi</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/10 flex flex-col justify-center">
                    <p class="text-4xl font-extrabold mb-2">REST API</p>
                    <p class="text-gray-200 font-semibold">Sumber Data Realtime</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/10 flex flex-col justify-center">
                    <p class="text-4xl font-extrabold mb-2">JTK POLBAN</p>
                    <p class="text-gray-200 font-semibold">Mahasiswa Unggul & Berprestasi</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const state = { subSearch: '', search: '', page: 1 };
            const placeholder = 'https://placehold.co/600x400?text=JTK+POLBAN';

            const grid = document.getElementById('achievement-grid');
            const loading = document.getElementById('achievement-loading');
            const empty = document.getElementById('achievement-empty');
            const error = document.getElementById('achievement-error');
            const total = document.getElementById('achievement-total');
            const searchInput = document.getElementById('achievement-search');
            const paginationContainer = document.getElementById('achievement-pagination');

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

            const achievementCard = (post) => {
                const image = post.image_url || post.featured_media?.url || placeholder;
                const slug = post.slug || post.id;

                return `
                    <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300 flex flex-col justify-between h-full">
                        <div>
                            <!-- Image Container -->
                            <div class="relative w-full h-48 overflow-hidden">
                                <a href="/berita/${encodeURIComponent(slug)}" class="block h-full w-full">
                                    <img src="${escapeHtml(image)}" alt="${escapeHtml(post.title)}" class="w-full h-full object-cover hover:scale-[1.03] transition duration-500" onerror="this.onerror=null;this.src='${placeholder}';">
                                </a>
                                <span class="absolute bottom-3 left-3 px-3 py-1 bg-[#00008B] text-white rounded text-[11px] font-bold tracking-wide shadow uppercase">
                                    Prestasi
                                </span>
                            </div>
                            <!-- Content Block -->
                            <div class="p-6">
                                <a href="/berita/${encodeURIComponent(slug)}" class="block group">
                                    <h3 class="text-base font-bold text-gray-800 leading-snug group-hover:text-[#00008B] transition duration-200 line-clamp-2">${escapeHtml(post.title || 'Tanpa Judul')}</h3>
                                </a>
                                <!-- Meta Block -->
                                <div class="flex items-center space-x-4 text-[11px] text-gray-400 font-semibold mt-2.5">
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>${escapeHtml(post.date_label || '-')}</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <span>${escapeHtml(post.views ?? 0)} Views</span>
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 font-medium line-clamp-2 mt-3 leading-relaxed">${escapeHtml(post.excerpt || '')}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2 flex justify-end">
                            <a href="/berita/${encodeURIComponent(slug)}" class="text-[#00008B] hover:text-blue-800 text-xs font-bold flex items-center space-x-1 transition">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </article>
                `;
            };

            const buildUrl = () => {
                const params = new URLSearchParams({ type: 'prestasi', per_page: '9' });

                if (state.page) {
                    params.set('page', state.page);
                }

                // Combine text filter from button and input search
                let searchTerms = [];
                if (state.subSearch) {
                    searchTerms.push(state.subSearch);
                }
                if (state.search.trim()) {
                    searchTerms.push(state.search.trim());
                }

                if (searchTerms.length > 0) {
                    params.set('search', searchTerms.join(' '));
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
                    total.textContent = json.meta?.total ?? posts.length;

                    if (posts.length === 0) {
                        setStatus('empty');
                        return;
                    }

                    grid.innerHTML = posts.map(achievementCard).join('');
                    renderPagination(json.meta);
                    setStatus('success');
                } catch (e) {
                    setStatus('error');
                }
            };

            const setupCategoryFilters = () => {
                const buttons = document.querySelectorAll('.category-btn');
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const searchVal = button.dataset.search || '';
                        state.subSearch = searchVal;
                        state.page = 1;

                        buttons.forEach(btn => {
                            btn.className = 'category-btn px-5 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-full font-bold text-sm hover:border-[#00008B] hover:text-[#00008B] transition';
                        });
                        button.className = 'category-btn px-5 py-2.5 bg-[#00008B] text-white rounded-full font-bold text-sm shadow-sm transition hover:bg-blue-900';
                        
                        loadPosts();
                    });
                });
            };

            let searchTimeout;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    state.search = searchInput.value;
                    state.page = 1;
                    loadPosts();
                }, 350);
            });

            setupCategoryFilters();
            loadPosts();
        });
    </script>
@endsection
