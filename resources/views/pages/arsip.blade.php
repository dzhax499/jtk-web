@extends('layouts.app')

@section('title', 'Arsip - JTK POLBAN')

@section('content')
    <x-hero 
        title="Arsip"
        subtitle="Jelajahi rekam jejak, dokumen resmi, dan memori perjalanan kelembagaan Jurusan Teknik Komputer dan Informatika"
        bgImage="true">
        <span>
            <a href="/" class="underline">Beranda</a> > 
            <span">Arsip</span>
        </span>
    </x-hero>

    <section class="py-16 bg-[#FAFAFA] font-['Poppins']">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16 space-y-12">
            
            <!-- Filter Arsip Box -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 lg:p-8 shadow-sm">
                <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-[#00008B] font-['Poppins']">
                        Filter Arsip
                    </h3>
                    <div class="text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Dropdown Tahun -->
                    <div>
                        <label for="filter-year" class="block text-xs font-bold text-gray-400 mb-2">Tahun</label>
                        <select id="filter-year" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-[#00008B] text-sm text-gray-700 bg-white font-semibold">
                            <option value="0">Semua Tahun</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                        </select>
                    </div>

                    <!-- Dropdown Bulan -->
                    <div>
                        <label for="filter-month" class="block text-xs font-bold text-gray-400 mb-2">Bulan</label>
                        <select id="filter-month" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-[#00008B] text-sm text-gray-700 bg-white font-semibold">
                            <option value="0">Semua Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <!-- Dropdown Kategori -->
                    <div>
                        <label for="filter-category" class="block text-xs font-bold text-gray-400 mb-2">Kategori</label>
                        <select id="filter-category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-[#00008B] text-sm text-gray-700 bg-white font-semibold">
                            <option value="">Semua Kategori</option>
                            <option value="berita">Berita</option>
                            <option value="prestasi">Prestasi Mahasiswa</option>
                        </select>
                    </div>

                    <!-- Input Kata Kunci -->
                    <div>
                        <label for="filter-search" class="block text-xs font-bold text-gray-400 mb-2">Kata Kunci</label>
                        <div class="relative">
                            <input 
                                id="filter-search"
                                type="text" 
                                placeholder="Cari arsip..."
                                class="w-full px-4 py-2.5 pr-10 border border-gray-300 bg-white rounded-xl focus:outline-none focus:border-[#00008B] text-sm text-gray-700 font-semibold"
                            >
                            <div class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Arsip Box -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 lg:p-8 shadow-sm space-y-6">
                <h3 class="text-xl font-bold text-gray-800 border-b border-gray-100 pb-4">Daftar Arsip Terbaru</h3>
                
                <!-- Loading Shimmer -->
                <div id="archive-loading" class="space-y-6">
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

                <!-- Archive Items Container -->
                <div id="archive-grid" class="space-y-6 hidden">
                    <!-- Items via JS -->
                </div>

                <!-- Empty State -->
                <div id="archive-empty" class="hidden text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xl font-bold text-navy-900 mb-2">Data arsip tidak ditemukan</p>
                    <p class="text-gray-500 font-medium">Coba ubah parameter filter atau kata kunci pencarian Anda.</p>
                </div>

                <!-- Error State -->
                <div id="archive-error" class="hidden text-center py-16 bg-red-50 rounded-2xl border border-red-100 shadow-sm">
                    <p class="text-xl font-bold text-red-700 mb-2">Gagal mengambil data arsip</p>
                    <p class="text-red-500 font-medium">Koneksi terputus atau terjadi kesalahan sistem.</p>
                </div>

                <!-- Pagination Container -->
                <div id="archive-pagination" class="flex justify-center items-center gap-2 pt-6">
                    <!-- Pagination via JS -->
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const state = { year: 0, month: 0, category: '', search: '', page: 1 };
            const placeholder = 'https://placehold.co/600x400?text=JTK+POLBAN';

            const grid = document.getElementById('archive-grid');
            const loading = document.getElementById('archive-loading');
            const empty = document.getElementById('archive-empty');
            const error = document.getElementById('archive-error');
            const paginationContainer = document.getElementById('archive-pagination');

            const filterYear = document.getElementById('filter-year');
            const filterMonth = document.getElementById('filter-month');
            const filterCategory = document.getElementById('filter-category');
            const filterSearch = document.getElementById('filter-search');

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
                
                let categoryLabel = 'Berita';
                if (post.category) {
                    categoryLabel = post.category;
                } else if (post.type === 'prestasi') {
                    categoryLabel = 'Prestasi Mahasiswa';
                }

                return `
                    <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300 flex flex-col md:flex-row h-auto md:h-56">
                        <!-- Image Container on the Left -->
                        <div class="relative w-full md:w-[40%] shrink-0 h-48 md:h-full overflow-hidden">
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
                const params = new URLSearchParams({ per_page: '8' });

                if (state.page) {
                    params.set('page', state.page);
                }
                if (state.year > 0) {
                    params.set('year', state.year);
                }
                if (state.month > 0) {
                    params.set('month', state.month);
                }
                if (state.category === 'prestasi') {
                    params.set('type', 'prestasi');
                } else if (state.category === 'berita') {
                    params.set('type', 'berita');
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

            // Setup filter listeners
            filterYear.addEventListener('change', () => {
                state.year = parseInt(filterYear.value);
                state.page = 1;
                loadPosts();
            });

            filterMonth.addEventListener('change', () => {
                state.month = parseInt(filterMonth.value);
                state.page = 1;
                loadPosts();
            });

            filterCategory.addEventListener('change', () => {
                state.category = filterCategory.value;
                state.page = 1;
                loadPosts();
            });

            let searchTimeout;
            filterSearch.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    state.search = filterSearch.value;
                    state.page = 1;
                    loadPosts();
                }, 350);
            });

            loadPosts();
        });
    </script>
@endsection
