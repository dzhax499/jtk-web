@extends('layouts.app')

@section('title', 'Akademik - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Akademik"
        subtitle="Pusat informasi komprehensif mengenai kurikulum, kalender perkuliahan, dan panduan kegiatan belajar mengajar Jurusan Teknik Komputer dan Informatika"
        bgImage="true">
        <span>
            <a href="/" class="underline hover:text-white transition">Beranda</a> > 
            <span class="text-gray-300">Akademik</span>
        </span>
    </x-hero>

    <!-- Main Content Section -->
    <section class="py-16 bg-[#FAFAFA] font-['Poppins']">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 xl:px-16 space-y-12">
            
            <!-- Loading Shimmer -->
            <div id="page-loading" class="animate-pulse space-y-8">
                <!-- Info Box Shimmer -->
                <div class="bg-gray-100 border border-gray-200 rounded-2xl p-6 lg:p-8 flex items-start space-x-5">
                    <div class="w-12 h-12 bg-gray-200 rounded-full shrink-0"></div>
                    <div class="flex-1 space-y-3">
                        <div class="h-5 bg-gray-200 rounded w-1/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </div>
                </div>
                <!-- Cards Shimmer -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @for($i = 0; $i < 2; $i++)
                        <div class="bg-white rounded-2xl border border-gray-200 p-8 flex flex-col items-center text-center space-y-4">
                            <div class="w-20 h-20 bg-gray-100 rounded-2xl animate-pulse"></div>
                            <div class="h-6 bg-gray-200 rounded w-1/3"></div>
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                            <div class="h-10 bg-gray-200 rounded-full w-1/2 pt-2"></div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Actual Content (initially hidden) -->
            <div id="academic-content" class="hidden space-y-12">
                <!-- Info Box -->
                <div class="bg-[#E6EEFF] border border-[#B3CCFF] rounded-2xl p-6 lg:p-8 flex items-start space-x-5 shadow-sm">
                    <div class="text-[#00008B] shrink-0 mt-0.5">
                        <svg class="w-12 h-12 text-[#00008B]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#00008B] mb-2 font-['Poppins']">Informasi Akademik</h3>
                        <div id="info-description" class="text-sm text-gray-600 font-medium leading-relaxed font-['Poppins']">
                            Halaman ini menyediakan akses menuju kalender akademik dan peraturan akademik resmi Politeknik Negeri Bandung (POLBAN). Informasi terbaru dan dokumen resmi dapat dilihat langsung pada website POLBAN.
                        </div>
                    </div>
                </div>

                <!-- Grid of Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kalender Akademik Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-8 flex flex-col items-center text-center shadow-sm hover:shadow-md transition duration-300">
                        <div class="bg-[#E6EEFF] rounded-2xl p-4.5 mb-6 text-[#00008B] shrink-0">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM7 11h2v2H7zm4 0h2v2h-2zm4 0h2v2h-2zm-8 4h2v2H7zm4 0h2v2h-2zm4 0h2v2h-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl lg:text-2xl font-bold text-[#00008b] mb-4 font-['Poppins']">Kalender Akademik</h3>
                        <div id="kalender-description" class="text-sm text-gray-500 font-medium mb-8 leading-relaxed font-['Poppins'] flex-grow">
                            Jadwal kegiatan akademik setiap semester seperti perkuliahan, ujian, libur akademik, dan kegiatan penting lainnya yang ditetapkan oleh Politeknik Negeri Bandung
                        </div>
                        <a href="https://www.polban.ac.id/tentang-polban/kalender-akademik/" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2.5 border border-[#00008b] text-[#00008b] font-bold text-sm rounded-full hover:bg-[#00008b] hover:text-white transition duration-300">
                            Lihat Kalender Akademik →
                        </a>
                    </div>

                    <!-- Peraturan Akademik Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-8 flex flex-col items-center text-center shadow-sm hover:shadow-md transition duration-300">
                        <div class="bg-[#E6EEFF] rounded-2xl p-4.5 mb-6 text-[#00008B] shrink-0">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl lg:text-2xl font-bold text-[#00008b] mb-4 font-['Poppins']">Peraturan Akademik</h3>
                        <div id="peraturan-description" class="text-sm text-gray-500 font-medium mb-8 leading-relaxed font-['Poppins'] flex-grow">
                            Kumpulan peraturan, pedoman, dan kebijakan akademik yang mengatur penyelenggaraan pendidikan di Politeknik Negeri Bandung.
                        </div>
                        <a href="https://www.polban.ac.id/peraturan-akademik/" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2.5 border border-[#00008b] text-[#00008b] font-bold text-sm rounded-full hover:bg-[#00008b] hover:text-white transition duration-300">
                            Lihat Peraturan Akademik →
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('page-loading');
            const content = document.getElementById('academic-content');

            const escapeHtml = (value) => String(value ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');

            const safeHtml = (html) => String(html || '')
                .replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '')
                .replace(/on\w+="[^"]*"/gi, '')
                .replace(/on\w+='[^']*'/gi, '');

            try {
                const response = await fetch('/api/pages/akademik');
                if (!response.ok) throw new Error('API gagal');

                const json = await response.json();
                const page = json.data || json;

                if (page.content) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(page.content, 'text/html');

                    // Extract info description (all content between h2 and the first h3)
                    let infoHtml = '';
                    let currentNode = doc.querySelector('h2')?.nextElementSibling;
                    while (currentNode && currentNode.tagName !== 'H3' && currentNode.tagName !== 'H2') {
                        infoHtml += currentNode.outerHTML;
                        currentNode = currentNode.nextElementSibling;
                    }
                    
                    // Extract Kalender Akademik description
                    let kalenderHtml = '';
                    const kalenderHeader = Array.from(doc.querySelectorAll('h3')).find(el => el.textContent.includes('Kalender'));
                    if (kalenderHeader) {
                        let node = kalenderHeader.nextElementSibling;
                        while (node && node.tagName !== 'H3' && node.tagName !== 'H2') {
                            kalenderHtml += node.outerHTML;
                            node = node.nextElementSibling;
                        }
                    }

                    // Extract Peraturan Akademik description
                    let peraturanHtml = '';
                    const peraturanHeader = Array.from(doc.querySelectorAll('h3')).find(el => el.textContent.includes('Peraturan'));
                    if (peraturanHeader) {
                        let node = peraturanHeader.nextElementSibling;
                        while (node && node.tagName !== 'H3' && node.tagName !== 'H2') {
                            peraturanHtml += node.outerHTML;
                            node = node.nextElementSibling;
                        }
                    }

                    if (infoHtml.trim()) {
                        document.getElementById('info-description').innerHTML = safeHtml(infoHtml);
                    }
                    if (kalenderHtml.trim()) {
                        document.getElementById('kalender-description').innerHTML = safeHtml(kalenderHtml);
                    }
                    if (peraturanHtml.trim()) {
                        document.getElementById('peraturan-description').innerHTML = safeHtml(peraturanHtml);
                    }
                }
            } catch (e) {
                console.error('Gagal memuat konten dinamis halaman akademik:', e);
            } finally {
                loading.classList.add('hidden');
                content.classList.remove('hidden');
            }
        });
    </script>
@endsection
