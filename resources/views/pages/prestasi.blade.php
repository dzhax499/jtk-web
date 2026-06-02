@extends('layouts.app')

@section('title', 'Prestasi - JTK POLBAN')

@section('content')
    <x-hero 
        title="Prestasi Mahasiswa"
        subtitle="Informasi tentang prestasi dan pencapaian mahasiswa Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Prestasi">
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 rounded-lg border border-sky-light/30 bg-sky-light/10 px-5 py-4 text-sm text-gray-700">
                Data pada halaman ini diambil menggunakan <strong>fetch REST API</strong> dari endpoint <code>/api/posts?type=prestasi</code>.
            </div>

            <div class="flex flex-wrap gap-4 mb-12">
                <button class="px-6 py-2 bg-navy-900 text-white rounded-full font-semibold hover:bg-navy-800 transition">
                    Semua Prestasi
                </button>
                <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                    Kompetisi Akademik
                </button>
                <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                    Kompetisi Non Akademik
                </button>
                <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                    Penghargaan
                </button>
            </div>

            <div id="achievement-loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for($i = 0; $i < 6; $i++)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden animate-pulse">
                        <div class="h-48 bg-gray-200"></div>
                        <div class="p-6 space-y-4">
                            <div class="h-5 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <div id="achievement-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 hidden"></div>

            <div id="achievement-empty" class="hidden text-center py-16 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xl font-semibold text-navy-900 mb-2">Data prestasi belum ditemukan</p>
                <p class="text-gray-600">Pastikan data post prestasi tersedia di tabel posts.</p>
            </div>

            <div id="achievement-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data prestasi</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/posts?type=prestasi</code> sudah berjalan.</p>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-navy-900 to-navy-800 py-16 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <p id="achievement-total" class="text-5xl font-bold mb-2">-</p>
                    <p class="text-gray-200">Data Prestasi dari API</p>
                </div>
                <div>
                    <p class="text-5xl font-bold mb-2">API</p>
                    <p class="text-gray-200">Sumber Data</p>
                </div>
                <div>
                    <p class="text-5xl font-bold mb-2">JSON</p>
                    <p class="text-gray-200">Format Data</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const placeholder = 'https://placehold.co/600x400?text=JTK+POLBAN';
            const grid = document.getElementById('achievement-grid');
            const loading = document.getElementById('achievement-loading');
            const empty = document.getElementById('achievement-empty');
            const error = document.getElementById('achievement-error');
            const total = document.getElementById('achievement-total');

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

            const achievementCard = (post) => {
                const image = post.image_url || post.featured_media?.url || placeholder;
                const slug = post.slug || post.id;

                return `
                    <article class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-card-hover transition-all duration-300">
                        <a href="/berita/${encodeURIComponent(slug)}" class="block">
                            <img src="${escapeHtml(image)}" alt="${escapeHtml(post.title)}" class="w-full h-48 object-cover" onerror="this.onerror=null;this.src='${placeholder}';">
                        </a>
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold mb-3">
                                ${escapeHtml(post.category || 'Prestasi Mahasiswa')}
                            </span>
                            <a href="/berita/${encodeURIComponent(slug)}" class="block">
                                <h3 class="text-lg font-bold text-navy-900 mb-3 hover:text-sky-light transition">${escapeHtml(post.title || 'Tanpa Judul')}</h3>
                            </a>
                            <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                                <span>📅 ${escapeHtml(post.date_label || '-')}</span>
                                <span>👁️ ${escapeHtml(post.views ?? 0)} Views</span>
                            </div>
                            <p class="text-sm text-gray-600">${escapeHtml(post.excerpt || '')}</p>
                        </div>
                    </article>
                `;
            };

            try {
                const response = await fetch('/api/posts?type=prestasi&per_page=12');
                if (!response.ok) throw new Error('API gagal');

                const json = await response.json();
                const posts = json.data || [];
                total.textContent = json.meta?.total ?? posts.length;

                if (posts.length === 0) {
                    setStatus('empty');
                    return;
                }

                grid.innerHTML = posts.map(achievementCard).join('');
                setStatus('success');
            } catch (e) {
                setStatus('error');
            }
        });
    </script>
@endsection
