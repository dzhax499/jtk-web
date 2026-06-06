@extends('layouts.app')

@section('title', 'Akreditasi - JTK POLBAN')

@section('content')
<div class="font-['Poppins']">
    <x-hero 
        title="Akreditasi"
        subtitle="Informasi akreditasi program studi Jurusan Teknik Komputer dan Informatika"
        bgImage="https://via.placeholder.com/1920x400?text=Akreditasi">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> &gt; <span>Akreditasi</span></span>
    </x-hero>

    <section class="py-16 bg-gray-50/50 flex-grow flex flex-col justify-center">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div id="page-loading" class="animate-pulse space-y-4 mb-10">
                <div class="h-7 bg-gray-200 rounded w-1/2"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
            </div>

            <!-- Fallback Container if Parsing Fails -->
            <div id="page-content" class="hidden bg-white border border-gray-100 rounded-xl shadow-sm p-8 mb-16">
                <h2 id="page-title" class="text-2xl font-bold text-navy-900 mb-4 border-b pb-2"></h2>
                <div id="page-body" class="prose max-w-none text-gray-700"></div>
            </div>

            <!-- Beautiful Cards Section (Dinamis Diisi dari JS) -->
            <div id="cards-section" class="hidden font-['Poppins']">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#01018B] tracking-wide mb-3 uppercase">AKREDITASI PROGRAM STUDI</h2>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-stretch gap-8">
                    <!-- Card D3 -->
                    <div class="bg-white rounded-xl border border-[#01018B]/20 p-10 flex flex-col items-center text-center w-full max-w-md shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-base font-bold text-[#01018B] mb-6">D3 Teknik Informatika</h3>
                        
                        <div class="mb-4">
                            <p class="text-xs font-bold tracking-[0.2em] text-[#01018B]/70 uppercase mb-2">Status Akreditasi</p>
                            <div id="d3-status" class="text-[64px] font-black text-[#01018B] tracking-wider mb-8 uppercase leading-none">...</div>
                        </div>
                        
                        <p id="d3-dates" class="text-base text-[#01018B] mb-2 leading-relaxed">Memuat data...</p>
                        <p id="d3-sk" class="text-xs text-[#01018B]/70 mt-4 mb-10"></p>
                        
                        <div class="mt-auto w-full">
                            <a href="https://www.polban.ac.id/wp-content/uploads/2024/01/24.-Sertifikat-Akreditasi-D3-Teknik-Informatika_073-2023-2028.pdf" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-3 bg-[#01018B] text-white text-base font-semibold rounded hover:bg-[#000055] transition-colors w-full sm:w-auto">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Lihat Sertifikat
                            </a>
                        </div>
                    </div>

                    <!-- Card STr -->
                    <div class="bg-white rounded-xl border border-[#01018B]/20 p-10 flex flex-col items-center text-center w-full max-w-md shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-base font-bold text-[#01018B] mb-6">Sarjana Terapan Teknik Informatika</h3>
                        
                        <div class="mb-4">
                            <p class="text-xs font-bold tracking-[0.2em] text-[#01018B]/70 uppercase mb-2">Status Akreditasi</p>
                            <div id="str-status" class="text-[64px] font-black text-[#01018B] tracking-wider mb-8 uppercase leading-none">...</div>
                        </div>
                        
                        <p id="str-dates" class="text-base text-[#01018B] mb-2 leading-relaxed">Memuat data...</p>
                        <p id="str-sk" class="text-xs text-[#01018B]/70 mt-4 mb-10"></p>
                        
                        <div class="mt-auto w-full">
                            <a href="https://www.polban.ac.id/wp-content/uploads/2025/08/file_sertifikat_25051520395200500455301_1755423415.pdf" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-3 bg-[#01018B] text-white text-base font-semibold rounded hover:bg-[#000055] transition-colors w-full sm:w-auto">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Lihat Sertifikat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('page-loading');
            const pageContentDiv = document.getElementById('page-content');
            const cardsSection = document.getElementById('cards-section');

            const safeHtml = (html) => String(html || '')
                .replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '')
                .replace(/on\w+="[^"]*"/gi, '')
                .replace(/on\w+='[^']*'/gi, '');

            try {
                const response = await fetch('/api/pages/akreditasi');
                if (!response.ok) throw new Error('Page not found');

                const json = await response.json();
                const page = json.data || json;

                const rawHtml = safeHtml(page.content || page.excerpt || '');
                if (rawHtml.trim() === '') {
                    loading.classList.add('hidden');
                    return; 
                }

                // Ekstrak data dari HTML API untuk dimasukkan ke Card Statis
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = rawHtml;

                const extractInfo = (programKeyword) => {
                    const headings = Array.from(tempDiv.querySelectorAll('h3, h4, h2'));
                    const heading = headings.find(h => h.textContent.toLowerCase().includes(programKeyword.toLowerCase()));
                    if (!heading) return null;
                    
                    let current = heading.nextElementSibling;
                    let status = 'UNGGUL'; // Fallback
                    let dates = '';
                    let sk = '';
                    
                    while (current && (current.tagName === 'P' || current.tagName === 'DIV')) {
                        const text = current.textContent;
                        if (text.toLowerCase().includes('status akreditasi')) {
                            const strong = current.querySelector('strong');
                            if (strong) status = strong.textContent.trim();
                        } else if (text.toLowerCase().includes('terakreditasi tahun')) {
                            dates = current.innerHTML; // get innerHTML to preserve any bold formatting if exists
                        } else if (text.toLowerCase().includes('no. sk')) {
                            sk = text;
                        }
                        current = current.nextElementSibling;
                    }
                    return { status, dates: dates || text, sk: sk || text }; // Simplified fallback
                };

                const d3Info = extractInfo('D3 Teknik Informatika');
                const strInfo = extractInfo('Sarjana Terapan');

                if (d3Info && strInfo && d3Info.sk && strInfo.sk) {
                    // Berhasil parsing, masukkan ke Card
                    document.getElementById('d3-status').textContent = d3Info.status;
                    document.getElementById('d3-dates').innerHTML = d3Info.dates.replace(/hingga /i, 'hingga <br class="hidden sm:block"><span class="font-bold">').replace(/\./g, '.</span>'); 
                    if(document.getElementById('d3-dates').innerHTML.indexOf('<br') === -1) {
                         // Simple fallback formatting if replace fails
                         const parts = d3Info.dates.split('hingga');
                         if(parts.length > 1) {
                             document.getElementById('d3-dates').innerHTML = parts[0] + 'hingga <br class="hidden sm:block"><span class="font-bold">' + parts[1] + '</span>';
                         } else {
                             document.getElementById('d3-dates').textContent = d3Info.dates;
                         }
                    }
                    document.getElementById('d3-sk').textContent = d3Info.sk;

                    document.getElementById('str-status').textContent = strInfo.status;
                    const partsStr = strInfo.dates.split('hingga');
                    if(partsStr.length > 1) {
                         document.getElementById('str-dates').innerHTML = partsStr[0] + 'hingga <br class="hidden sm:block"><span class="font-bold">' + partsStr[1] + '</span>';
                    } else {
                         document.getElementById('str-dates').textContent = strInfo.dates;
                    }
                    document.getElementById('str-sk').textContent = strInfo.sk;

                    loading.classList.add('hidden');
                    cardsSection.classList.remove('hidden');
                } else {
                    // Jika parsing gagal karena struktur berubah, tampilkan HTML mentah saja
                    document.getElementById('page-title').textContent = page.title || 'Akreditasi';
                    document.getElementById('page-body').innerHTML = rawHtml;
                    
                    loading.classList.add('hidden');
                    pageContentDiv.classList.remove('hidden');
                }

            } catch (e) {
                loading.classList.add('hidden');
                console.error(e);
            }
        });
    </script>
    </div>
@endsection