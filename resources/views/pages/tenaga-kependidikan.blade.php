@extends('layouts.app')

@section('title', 'Tenaga Kependidikan - JTK POLBAN')

@section('content')
<div class="font-['Poppins']">
    <!-- Hero Section -->
    <x-hero
        title="Tenaga Kependidikan"
        subtitle="Informasi terbaru seputar Tenaga Kependidikan"
        bgImage="https://via.placeholder.com/1920x400?text=Tenaga+Kependidikan">
        <span>Beranda</span> > <span>Tenaga Kependidikan</span>
    </x-hero>

    <section class="py-12">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#01018B] mb-8">Tenaga Kependidikan</h2>
            
            <!-- Hidden Raw Content from DB -->
            <div id="raw-content" class="hidden">
                {!! $pageContent ?? '' !!}
            </div>

            <!-- Dynamic Accordion Container -->
            <div id="accordion-container" class="space-y-4 font-['Poppins']">
                <!-- Loading State -->
                <div class="animate-pulse space-y-4">
                    <div class="h-14 bg-gray-200 rounded-lg w-full"></div>
                    <div class="h-14 bg-gray-200 rounded-lg w-full"></div>
                    <div class="h-14 bg-gray-200 rounded-lg w-full"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script to Fetch, Parse and Render Accordions -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const container = document.getElementById('accordion-container');

            try {
                // Fetch from API dynamically
                const res = await fetch('/api/pages/tenaga-kependidikan');
                if (!res.ok) throw new Error('Gagal memuat API Tenaga Kependidikan');
                const json = await res.json();
                const page = json.data || json;
                
                const htmlContent = page.content || page.excerpt || '';
                
                // Parse HTML
                const div = document.createElement('div');
                div.innerHTML = htmlContent;

                const ps = div.querySelectorAll('p');
                let categories = [];

                ps.forEach((p) => {
                    const strong = p.querySelector('strong');
                    if (strong) {
                        const categoryName = strong.textContent.trim();
                        // Find the corresponding list (ul or ol)
                        let nextEl = p.nextElementSibling;
                        let people = [];
                        
                        // Sometimes WordPress injects empty paragraphs between p and ol
                        while(nextEl && nextEl.tagName !== 'OL' && nextEl.tagName !== 'UL') {
                            nextEl = nextEl.nextElementSibling;
                        }

                        if (nextEl && (nextEl.tagName === 'OL' || nextEl.tagName === 'UL')) {
                            const lis = nextEl.querySelectorAll('li');
                            lis.forEach(li => {
                                people.push(li.textContent.trim());
                            });
                        }

                        if (people.length > 0) {
                            categories.push({ name: categoryName, people: people });
                        }
                    }
                });

                if (categories.length === 0) {
                    container.innerHTML = '<div class="text-center text-red-500 font-bold p-4 border border-red-500 bg-red-50 rounded">Tidak ada data tenaga kependidikan yang ditemukan di database. Pastikan data menggunakan huruf tebal (bold) untuk kategori dan list untuk daftar nama.</div>';
                    return;
                }

                container.innerHTML = '';
                const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

                categories.forEach((cat, index) => {
                    const prefix = alphabet[index] + ". ";
                    // Default to closed state for all categories
                    const isOpen = '';

                    const cardsHtml = cat.people.map(person => `
                        <div class="text-center p-4 border border-gray-200 rounded-sm shadow-sm flex flex-col items-center justify-center min-h-[120px] bg-white transition-all hover:shadow-md">
                            <div class="w-12 h-12 bg-[#EEEEEE] rounded-lg flex items-center justify-center mb-3">
                                <svg class="w-4 h-4 text-[#333333]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M3 21v-1a6 6 0 0 1 6-6h6a6 6 0 0 1 6 6v1z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-[#01018B] text-base">${person}</h3>
                        </div>
                    `).join('');

                    const accordionHtml = `
                        <details class="bg-white border border-gray-300 rounded-sm group" ${isOpen}>
                            <summary class="flex cursor-pointer items-center justify-between bg-[#F3F3F4] px-6 py-4 text-[#01018B] font-bold transition list-none group-open:border-b group-open:border-gray-200">
                                <span class="text-base">${prefix}${cat.name}</span>
                                <span class="transform group-open:rotate-180 transition-transform duration-200 text-[#01018B]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="px-6 py-6 bg-white">
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    ${cardsHtml}
                                </div>
                            </div>
                        </details>
                    `;
                    container.insertAdjacentHTML('beforeend', accordionHtml);
                });

                // Add CSS to hide default details marker (safari/chrome)
                const style = document.createElement('style');
                style.innerHTML = 'details > summary::-webkit-details-marker { display: none; } details > summary { list-style: none; }';
                document.head.appendChild(style);

            } catch (error) {
                console.error(error);
                container.innerHTML = '<div class="text-center text-red-500 font-bold p-4 border border-red-500 bg-red-50 rounded">Gagal memuat data dari API. Silakan periksa koneksi atau coba lagi nanti.</div>';
            }
        });
    </script>
    </div>
@endsection
