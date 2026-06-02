@extends('layouts.app')

@section('title', 'Berita - JTK POLBAN')

@section('content')
    <x-hero 
        title="Berita"
        subtitle="Informasi terbaru seputar kegiatan, prestasi, dan pengumuman Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Berita">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> &gt; <span>Berita</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 rounded-lg border border-sky-light/30 bg-sky-light/10 px-5 py-4 text-sm text-gray-700">
                Data pada halaman ini diambil menggunakan <strong>fetch REST API</strong> dari endpoint <code>/api/posts</code>.
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div id="category-filter" class="flex flex-wrap gap-3">
                    <button type="button" data-category="" class="category-btn px-6 py-2 bg-navy-900 text-white rounded-full font-semibold hover:bg-navy-800 transition">
                        Semua Berita
                    </button>
                </div>

                <div class="relative w-full md:w-auto">
                    <input 
                        id="news-search"
                        type="text" 
                        placeholder="Cari Berita..."
                        class="w-full md:w-80 px-4 py-2 pl-10 border border-gray-300 rounded-full focus:outline-none focus:border-sky-light"
                    >
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div id="news-loading" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden animate-pulse">
                        <div class="h-56 bg-gray-200"></div>
                        <div class="p-6 space-y-4">
                            <div class="h-5 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-full"></div>
                            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <div id="news-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 hidden"></div>

            <div id="news-empty" class="hidden text-center py-16 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xl font-semibold text-navy-900 mb-2">Data berita belum ditemukan</p>
                <p class="text-gray-600">Coba ubah kata kunci pencarian atau kategori.</p>
            </div>

            <div id="news-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data berita</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/posts</code> sudah berjalan.</p>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-card text-center">
                    <span class="text-4xl mb-4 block">📰</span>
                    <p id="total-news" class="text-3xl font-bold text-navy-900 mb-2">-</p>
                    <p class="text-gray-600">Total Berita</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-card text-center">
                    <span class="text-4xl mb-4 block">🔗</span>
                    <p class="text-3xl font-bold text-navy-900 mb-2">API</p>
                    <p class="text-gray-600">Sumber Data</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-card text-center">
                    <span class="text-4xl mb-4 block">📅</span>
                    <p class="text-3xl font-bold text-navy-900 mb-2">2026</p>
                    <p class="text-gray-600">Tahun Akses</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const state = { category: '', search: '' };
            const placeholder = 'https://placehold.co/600x400?text=JTK+POLBAN';

            const grid = document.getElementById('news-grid');
            const loading = document.getElementById('news-loading');
            const empty = document.getElementById('news-empty');
            const error = document.getElementById('news-error');
            const categoryFilter = document.getElementById('category-filter');
            const searchInput = document.getElementById('news-search');
            const totalNews = document.getElementById('total-news');

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
            };

            const postCard = (post) => {
                const image = post.image_url || post.featured_media?.url || placeholder;
                const slug = post.slug || post.id;

                return `
                    <article class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-card-hover transition-all duration-300">
                        <a href="/berita/${encodeURIComponent(slug)}" class="block">
                            <img src="${escapeHtml(image)}" alt="${escapeHtml(post.title)}" class="w-full h-56 object-cover" onerror="this.onerror=null;this.src='${placeholder}';">
                        </a>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                    ${escapeHtml(post.category || 'Berita')}
                                </span>
                            </div>
                            <a href="/berita/${encodeURIComponent(slug)}" class="block">
                                <h3 class="text-xl font-bold text-navy-900 mb-3 hover:text-sky-light transition">${escapeHtml(post.title || 'Tanpa Judul')}</h3>
                            </a>
                            <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                                <span>📅 ${escapeHtml(post.date_label || '-')}</span>
                                <span>👁️ ${escapeHtml(post.views ?? 0)} Views</span>
                            </div>
                            <p class="text-gray-600">${escapeHtml(post.excerpt || '')}</p>
                        </div>
                    </article>
                `;
            };

            const loadCategories = async () => {
                try {
                    const response = await fetch('/api/categories');
                    const json = await response.json();
                    const categories = (json.data || [])
                        .map(item => item.name)
                        .filter(Boolean);

                    const defaultCategories = ['Berita', 'Headline', 'Prestasi Mahasiswa'];
                    [...new Set([...defaultCategories, ...categories])].forEach(category => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.dataset.category = category;
                        button.className = 'category-btn px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition';
                        button.textContent = category;
                        button.addEventListener('click', () => {
                            state.category = category;
                            document.querySelectorAll('.category-btn').forEach(btn => {
                                btn.className = 'category-btn px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition';
                            });
                            button.className = 'category-btn px-6 py-2 bg-navy-900 text-white rounded-full font-semibold hover:bg-navy-800 transition';
                            loadPosts();
                        });
                        categoryFilter.appendChild(button);
                    });

                    categoryFilter.querySelector('[data-category=""]').addEventListener('click', (event) => {
                        state.category = '';
                        document.querySelectorAll('.category-btn').forEach(btn => {
                            btn.className = 'category-btn px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition';
                        });
                        event.currentTarget.className = 'category-btn px-6 py-2 bg-navy-900 text-white rounded-full font-semibold hover:bg-navy-800 transition';
                        loadPosts();
                    });
                } catch (e) {
                    // Kategori tidak wajib. Halaman tetap bisa jalan dari /api/posts.
                }
            };

            const buildUrl = () => {
                const params = new URLSearchParams({ per_page: '12' });

                if (state.search.trim() !== '') {
                    params.set('search', state.search.trim());
                }

                if (state.category) {
                    params.set('category', state.category);
                }

                return `/api/posts?${params.toString()}`;
            };

            const loadPosts = async () => {
                setStatus('loading');
                try {
                    const response = await fetch(buildUrl());
                    if (!response.ok) throw new Error('API gagal');

                    const json = await response.json();
                    const posts = json.data || [];
                    totalNews.textContent = json.meta?.total ?? posts.length;

                    if (posts.length === 0) {
                        setStatus('empty');
                        return;
                    }

                    grid.innerHTML = posts.map(postCard).join('');
                    setStatus('success');
                } catch (e) {
                    setStatus('error');
                }
            };

            let searchTimeout;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    state.search = searchInput.value;
                    loadPosts();
                }, 350);
            });

            loadCategories();
            loadPosts();
        });
    </script>
@endsection
