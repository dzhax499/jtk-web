@extends('layouts.app')

@section('title', 'Produk - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Produk"
        subtitle="Informasi terbaru seputar Kompetensi Produk"
        bgImage="https://via.placeholder.com/1920x400?text=Produk">
        <span>Beranda</span> > <span>Produk</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Title -->
            <h2 id="produk-title" class="text-3xl md:text-4xl font-bold text-[#00008B] mb-10">Produk</h2>

            <!-- Loading Skeleton -->
            <div id="produk-loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 0; $i < 6; $i++)
                    <div class="animate-pulse rounded-lg border-2 border-gray-200 p-8">
                        <div class="w-12 h-12 bg-gray-200 rounded mb-4"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4 mb-3"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                    </div>
                @endfor
            </div>

            <!-- Product Cards Grid (hidden until data loads) -->
            <div id="produk-grid" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Populated dynamically by JavaScript --}}
            </div>

            <!-- Error State -->
            <div id="produk-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data Produk</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/pages/produk</code> tersedia.</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('produk-loading');
            const grid = document.getElementById('produk-grid');
            const error = document.getElementById('produk-error');
            const titleEl = document.getElementById('produk-title');

            /**
             * SVG icons to assign to each product card.
             * Each icon matches the mockup style.
             */
            const icons = [
                // Icon 1: Master Plan / Blueprint
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                </svg>`,
                // Icon 2: Application / Monitor
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z" />
                </svg>`,
                // Icon 3: Globe / Network
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                </svg>`,
                // Icon 4: Building / Organization
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>`,
                // Icon 5: Handshake / CRM
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>`,
            ];


            function parseProducts(htmlContent) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(htmlContent, 'text/html');
                const listItems = doc.querySelectorAll('li');
                const products = [];

                listItems.forEach((li, index) => {
                    const text = li.textContent.trim();
                    if (text) {
                        products.push({
                            title: text,
                            icon: icons[index % icons.length],
                        });
                    }
                });

                return products;
            }

            function renderCard(product) {
                return `
                    <div class="border-2 border-navy-900 rounded-xl p-7 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col gap-3 bg-white group">
                        <div class="w-14 h-14 rounded-lg bg-navy-50 flex items-center justify-center group-hover:bg-navy-100 transition-colors duration-300">
                            ${product.icon}
                        </div>
                        <h3 class="font-bold text-[#00008B] text-sm leading-relaxed mt-2">${product.title}</h3>
                    </div>
                `;
            }

            try {
                const response = await fetch('/api/pages/produk');
                if (!response.ok) throw new Error('Halaman tidak ditemukan');

                const json = await response.json();
                const page = json.data || json;

                // Update title from API
                if (page.title) {
                    titleEl.textContent = page.title;
                }

                // Parse products from content HTML
                const products = parseProducts(page.content || '');

                if (products.length > 0) {
                    grid.innerHTML = products.map(renderCard).join('');
                    loading.classList.add('hidden');
                    grid.classList.remove('hidden');
                } else {
                    // No list items found, show raw content as fallback
                    loading.classList.add('hidden');
                    grid.innerHTML = '<div class="col-span-3 prose max-w-none">' + (page.content || '<p>Data produk belum tersedia.</p>') + '</div>';
                    grid.classList.remove('hidden');
                }
            } catch (e) {
                console.error('Error fetching produk:', e);
                loading.classList.add('hidden');
                error.classList.remove('hidden');
            }
        });
    </script>
@endsection
