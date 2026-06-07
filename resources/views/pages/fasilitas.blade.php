@extends('layouts.app')

@section('title', 'Fasilitas - JTK POLBAN')

@section('content')
<div class="font-['Poppins']">
    <!-- Hero Section -->
    <x-hero 
        title="Fasilitas"
        subtitle="Informasi terbaru seputar Fasilitas"
        bgImage="https://via.placeholder.com/1920x400?text=Fasilitas">
        <span>Beranda</span> > <span>Fasilitas</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Title -->
            <h2 id="fasilitas-title" class="text-xl md:text-3xl font-extrabold text-[#01018B] mb-4">Fasilitas</h2>

            <!-- Description -->
            <p id="fasilitas-description" class="text-[15px] text-[#00008B] mb-12 max-w-[800px] leading-relaxed">
                Fasilitas yang tersedia mencakup: Gedung, Ruang Kelas, Laboratorium Komputer, Ruang Serbaguna, Lapangan Olahraga, Taman, dan lainnya.
            </p>

            <!-- Loading Skeleton -->
            <div id="fasilitas-loading" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 9; $i++)
                    <div class="animate-pulse rounded-lg overflow-hidden h-64 bg-gray-200"></div>
                @endfor
            </div>

            <!-- Facilities Grid (hidden until data loads) -->
            <div id="fasilitas-grid" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Populated dynamically by JavaScript --}}
            </div>

            <!-- Error State -->
            <div id="fasilitas-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data Fasilitas</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/pages/fasilitas</code> tersedia.</p>
            </div>
        </div>
    </section>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('fasilitas-loading');
            const grid = document.getElementById('fasilitas-grid');
            const error = document.getElementById('fasilitas-error');
            const titleEl = document.getElementById('fasilitas-title');
            const descEl = document.getElementById('fasilitas-description');

            /**
             * Parse the WordPress gallery HTML from the API content
             * and extract image src + caption (alt text / figcaption).
             */
            function parseFacilities(htmlContent) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(htmlContent, 'text/html');
                const figures = doc.querySelectorAll('figure.wp-block-image');
                const facilities = [];

                figures.forEach(figure => {
                    const img = figure.querySelector('img');
                    const caption = figure.querySelector('figcaption');

                    if (img) {
                        facilities.push({
                            image: img.getAttribute('src') || '',
                            title: caption ? caption.textContent.trim() : (img.getAttribute('alt') || 'Fasilitas'),
                        });
                    }
                });

                return facilities;
            }

            /**
             * Render a single facility card matching the mockup:
             * - Full image background
             * - Dark overlay with centered white title text
             * - Hover effect (scale + darker overlay)
             */
            function renderCard(facility) {
                return `
                    <div class="relative overflow-hidden rounded-lg h-64 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <img src="${facility.image}" 
                             alt="${facility.title}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.src='https://via.placeholder.com/400x300?text=${encodeURIComponent(facility.title)}'">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors duration-300 flex items-end">
                            <span class="text-white font-extrabold text-[17px] px-4 pb-4 drop-shadow-lg">${facility.title}</span>
                        </div>
                    </div>
                `;
            }

            try {
                const response = await fetch('/api/pages/fasilitas');
                if (!response.ok) throw new Error('Halaman tidak ditemukan');

                const json = await response.json();
                const page = json.data || json;

                // Update title from API
                if (page.title) {
                    titleEl.textContent = page.title;
                }

                // Update description from excerpt
                if (page.excerpt) {
                    // Strip HTML tags from excerpt for clean text
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = page.excerpt;
                    const cleanExcerpt = tempDiv.textContent || tempDiv.innerText || '';
                    if (cleanExcerpt.trim()) {
                        descEl.textContent = cleanExcerpt.trim();
                    }
                }

                // Parse facilities from content HTML
                const facilities = parseFacilities(page.content || '');

                if (facilities.length > 0) {
                    grid.innerHTML = facilities.map(renderCard).join('');
                    loading.classList.add('hidden');
                    grid.classList.remove('hidden');
                } else {
                    // No images found in content, show the raw content as fallback
                    loading.classList.add('hidden');
                    grid.innerHTML = '<div class="col-span-3 prose max-w-none">' + (page.content || '<p>Data fasilitas belum tersedia.</p>') + '</div>';
                    grid.classList.remove('hidden');
                }
            } catch (e) {
                console.error('Error fetching fasilitas:', e);
                loading.classList.add('hidden');
                error.classList.remove('hidden');
            }
        });
    </script>
@endsection