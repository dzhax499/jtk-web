@extends('layouts.app')

@section('title', 'Reputasi - JTK POLBAN')

@section('content')
<div class="font-['Poppins']">
    <!-- Hero Section -->
    <x-hero
        title="Reputasi"
        subtitle="Bukti nyata dedikasi dan kualitas institusi melalui pencapaian serta pengakuan Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Reputasi">
        <span>Beranda</span> > <span>Reputasi</span>
    </x-hero>

    <section class="py-16 bg-gray-50/30 flex-grow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 font-['Poppins']">
            
            <!-- Section Header -->
            <div class="border-l-[5px] border-[#01018B] pl-6 mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#01018B] mb-3 leading-tight">Reputasi</h2>
                <p id="intro-text" class="text-[#01018B]/80 text-[18px] font-normal">
                    Memuat data...
                </p>
            </div>

            <!-- Timeline Container -->
            <div class="relative w-full">
                <!-- Center Vertical Line (Height calculated by JS) -->
                <div id="timeline-line" class="absolute left-1/2 transform -translate-x-1/2 w-[1px] bg-[#01018B]/20 transition-all duration-500 z-0"></div>

                <div id="timeline-container" class="space-y-12 relative z-10">
                    <!-- Loading State -->
                    <div class="flex justify-center items-center py-12">
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-blue-200 h-12 w-12"></div>
                            <div class="flex-1 space-y-4 py-1">
                                <div class="h-4 bg-blue-200 rounded w-3/4"></div>
                                <div class="space-y-2">
                                    <div class="h-4 bg-blue-200 rounded"></div>
                                    <div class="h-4 bg-blue-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Javascript to Parse and Render Timeline -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const container = document.getElementById('timeline-container');
            const introText = document.getElementById('intro-text');

            try {
                // Fetch from API dynamically
                const res = await fetch('/api/pages/reputasi');
                if (!res.ok) throw new Error('Gagal memuat API Reputasi');
                const json = await res.json();
                const page = json.data || json;
                
                const htmlContent = page.content || page.excerpt || '';
                
                // Parse HTML
                const div = document.createElement('div');
                div.innerHTML = htmlContent;
                
                const elements = div.querySelectorAll('li, p');
                let events = [];
                let introTextFound = false;

                elements.forEach(el => {
                    const elHtml = el.innerHTML;
                    const textContent = el.textContent.trim();
                    if (!textContent) return;
                    
                    if (!introTextFound && el.tagName === 'P') {
                        // Use the first paragraph as the intro text, even if it contains a year
                        introText.textContent = textContent;
                        introTextFound = true;
                        return; // Skip adding to timeline events
                    }

                    // Extract year (e.g., "Pada tahun 2006, ...")
                    const yearMatch = textContent.match(/tahun\s+(\d{4})/i);
                    
                    if (yearMatch) {
                        const year = parseInt(yearMatch[1]);
                        events.push({ year, html: elHtml });
                    }
                });

                if (!introTextFound) {
                    introText.textContent = 'Menampilkan riwayat reputasi dan pencapaian JTK.';
                }

                if (events.length === 0) {
                    container.innerHTML = '<div class="text-center text-red-500 font-bold p-4 border border-red-500 bg-red-50 rounded">Tidak ada data reputasi dengan format tahun yang ditemukan di database. Pastikan data mengandung kata "Tahun XXXX".</div>';
                    return;
                }

                // Sort ascending (oldest year first)
                events.sort((a, b) => a.year - b.year);

                // Render to timeline
                container.innerHTML = '';

                // Array of SVGs matching the mockup exactly
                const iconSvgs = [
                    // Award (Sertifikasi)
                    `<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>`,
                    // Education (Akreditasi)
                    `<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>`,
                    // Document (Kerja sama) - Outline style matching the rest
                    `<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>`,
                    // Globe (Global/Internasional)
                    `<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>`
                ];

                events.forEach((event, index) => {
                    const isRight = (index % 2 === 0);
                    const iconSvg = iconSvgs[index % iconSvgs.length];

                    const rowHtml = `
                        <div class="relative flex items-center justify-between w-full">
                            <div class="w-5/12 ${!isRight ? '' : 'invisible'}">
                                ${!isRight ? buildCard(event.year, event.html) : ''}
                            </div>
                            <div class="timeline-icon z-10 flex items-center justify-center w-12 h-12 bg-[#01018B] rounded-[14px] shadow-sm">
                                ${iconSvg}
                            </div>
                            <div class="w-5/12 ${isRight ? '' : 'invisible'}">
                                ${isRight ? buildCard(event.year, event.html) : ''}
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', rowHtml);
                });

                // Pixel-perfect vertical line positioning
                setTimeout(() => {
                    const icons = container.querySelectorAll('.timeline-icon');
                    if (icons.length > 1) {
                        const line = document.getElementById('timeline-line');
                        const containerRect = container.getBoundingClientRect();
                        const firstRect = icons[0].getBoundingClientRect();
                        const lastRect = icons[icons.length - 1].getBoundingClientRect();
                        
                        const topPos = (firstRect.top - containerRect.top) + (firstRect.height / 2);
                        const lineDist = (lastRect.top - firstRect.top);
                        
                        line.style.top = topPos + 'px';
                        line.style.height = lineDist + 'px';
                    }
                }, 100);

            } catch (error) {
                console.error(error);
                if (introText) {
                    introText.textContent = "Gagal memuat data dari API Reputasi.";
                    introText.className = "text-red-500 font-bold";
                }
                container.innerHTML = '<div class="text-center text-red-500 p-4 border border-red-500 bg-red-50 rounded">Gagal memuat data dari server. Silakan coba lagi.</div>';
            }
        });

        function buildCard(year, html) {
            return `
                <div class="bg-white border border-[#01018B]/20 p-6 shadow-sm hover:shadow-md transition-all text-[#01018B] font-['Poppins']">
                    <div class="inline-block px-4 py-1.5 bg-[#F3F3F4] text-[#01018B] text-xs font-semibold rounded mb-3 font-['Poppins']">
                        ${year > 0 ? year : ''}
                    </div>
                    <div class="text-base font-normal leading-relaxed [&>p]:text-base [&>p]:font-normal [&>p]:mb-0 font-['Poppins']">                        ${html}
                    </div>
                </div>
            `;
        }
    </script>
    </div>
@endsection
