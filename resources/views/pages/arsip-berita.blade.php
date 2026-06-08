@extends('layouts.app')

@section('title', 'Arsip - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Arsip Berita"
        subtitle="Jelajahi rekam jejak, dokumen resmi, dan memori perjalanan kelembagaan Jurusan Teknik Konputer dan Informatika"
        bgImage="https://via.placeholder.com/1920x400?text=Arsip">
        <span><a href="/" class="underline">Beranda</a> > <span>Arsip</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Main Content -->
                <div class="flex-1">
                    <!-- Search and Filter -->
                    <div class="mb-12">
                        <div class="flex gap-4 mb-4">
                            <input type="text" id="search-input" placeholder="Cari arsip..." class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-900">
                            <button id="search-button" class="px-6 py-3 bg-navy-900 text-white rounded-lg hover:bg-navy-800 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2" id="filter-tags">
                            <button class="px-3 py-1 bg-navy-900 text-white rounded-full text-xs filter-btn active" data-type="all">Semua</button>
                            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-xs filter-btn" data-type="berita">Berita Umum</button>
                            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-xs filter-btn" data-type="pengumuman">Pengumuman</button>
                            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-xs filter-btn" data-type="prestasi">Prestasi</button>
                        </div>
                    </div>

                    <!-- Archive List -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-navy-900 mb-8">Daftar Arsip Terbaru</h2>
                        
                        <div id="posts-loading" class="text-center py-10">
                            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-navy-900 mx-auto"></div>
                        </div>

                        <div id="posts-container" class="space-y-6 hidden">
                            <!-- Items via JS -->
                        </div>

                        <div id="posts-empty" class="hidden text-center py-10 text-gray-500 italic border rounded-lg">
                            Tidak ada arsip yang ditemukan.
                        </div>
                    </div>

                    <!-- Pagination (Simplified for now) -->
                    <div id="pagination" class="flex justify-center gap-2 hidden">
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">‹</button>
                        <button class="px-3 py-2 bg-navy-900 text-white rounded">1</button>
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">→</button>
                    </div>
                </div>

                <!-- Sidebar - Recent News -->
                <div class="lg:w-80 flex-shrink-0">
                    <div class="bg-blue-50 rounded-lg p-6 sticky top-24 border border-blue-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 bg-navy-900 text-white rounded flex items-center justify-center font-bold">
                                T
                            </div>
                            <h3 class="text-lg font-bold text-navy-900">Terfavorit</h3>
                        </div>

                        <div id="trending-container" class="space-y-4">
                            <!-- Trending via JS -->
                        </div>

                        <div class="mt-8 p-4 bg-sky-light/10 rounded-lg">
                            <h4 class="font-bold text-navy-900 mb-2">Butuh Info Lebih?</h4>
                            <p class="text-sm text-gray-600 mb-4">Hubungi humas JTK untuk pertanyaan seputar arsip berita.</p>
                            <a href="/hubungi-kami" class="text-sky-light font-bold text-sm hover:underline italic">Kontak Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('posts-container');
            const loading = document.getElementById('posts-loading');
            const empty = document.getElementById('posts-empty');
            const trendingContainer = document.getElementById('trending-container');
            let allPosts = [];

            function renderPosts(posts) {
                if (posts.length === 0) {
                    container.classList.add('hidden');
                    empty.classList.remove('hidden');
                    return;
                }
                
                empty.classList.add('hidden');
                container.classList.remove('hidden');
                container.innerHTML = posts.map(item => `
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition flex bg-white group">
                        <!-- Image -->
                        <div class="w-40 h-32 flex-shrink-0 overflow-hidden bg-gray-100">
                            <img src="${item.featured_image || 'https://via.placeholder.com/400x300?text=JTK+POLBAN'}" 
                                 alt="${item.title}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="inline-block px-3 py-1 bg-navy-100 text-navy-900 text-xs font-semibold rounded lowercase">${item.category?.name || 'artikel'}</span>
                                    ${item.type === 'prestasi' ? '<span class="inline-block px-3 py-1 bg-sky-light text-white text-xs font-semibold rounded">PRESTASI</span>' : ''}
                                </div>
                                <h3 class="text-lg font-bold text-navy-900 mb-2 group-hover:text-sky-light transition cursor-pointer">
                                    <a href="/berita/${item.slug}">${item.title}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-1">${item.excerpt || ''}</p>
                            </div>
                            
                            <!-- Meta -->
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                <span>🗓️ ${new Date(item.published_at).toLocaleDateString('id-ID')}</span>
                                <span>👁️ ${item.view_count || 0} Views</span>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            function renderTrending(posts) {
                const popular = [...posts].sort((a,b) => (b.view_count || 0) - (a.view_count || 0)).slice(0, 3);
                trendingContainer.innerHTML = popular.map(item => `
                    <div class="border-b border-gray-200 pb-4 last:border-b-0 group">
                        <h4 class="font-bold text-navy-900 text-sm group-hover:text-sky-light transition cursor-pointer">
                            <a href="/berita/${item.slug}">${item.title.substring(0, 60)}...</a>
                        </h4>
                        <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-wider font-semibold">${item.category?.name || 'news'}</p>
                    </div>
                `).join('');
            }

            fetch('/api/posts')
                .then(response => response.json())
                .then(response => {
                    allPosts = response.data;
                    loading.classList.add('hidden');
                    renderPosts(allPosts);
                    renderTrending(allPosts);
                    document.getElementById('pagination').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.innerHTML = '<p class="text-red-500">Gagal memuat arsip.</p>';
                });

            // Filter logic
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const type = this.getAttribute('data-type');
                    
                    // Style
                    document.querySelectorAll('.filter-btn').forEach(b => {
                        b.classList.remove('bg-navy-900', 'text-white', 'active');
                        b.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-navy-900', 'text-white', 'active');

                    const filtered = type === 'all' 
                        ? allPosts 
                        : allPosts.filter(p => p.type === type || p.category?.name?.toLowerCase() === type);
                    renderPosts(filtered);
                });
            });

            // Search logic
            document.getElementById('search-button').addEventListener('click', () => {
                const query = document.getElementById('search-input').value.toLowerCase();
                const filtered = allPosts.filter(p => 
                    p.title.toLowerCase().includes(query) || 
                    (p.excerpt && p.excerpt.toLowerCase().includes(query))
                );
                renderPosts(filtered);
            });
        });
    </script>
@endsection
