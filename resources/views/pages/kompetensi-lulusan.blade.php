@extends('layouts.app')

@section('title', 'Kompetensi Lulusan - JTK POLBAN')

@section('content')
<div class="font-['Poppins']">
    <!-- Hero Section -->
    <x-hero 
        title="Kompetensi Lulusan"
        subtitle="Informasi terbaru seputar Kompetensi Lulusan"
        bgImage="https://via.placeholder.com/1920x400?text=Kompetensi+Lulusan">
        <span>Beranda</span> > <span>Kompetensi Lulusan</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Loading Skeleton -->
            <div id="kompetensi-loading" class="animate-pulse space-y-12">
                <div>
                    <div class="h-8 bg-gray-200 rounded w-64 mb-8"></div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="h-32 bg-gray-200 rounded-lg border border-gray-200"></div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Content Container -->
            <div id="kompetensi-content" class="hidden">
                <!-- Section 1: Kompetensi Lulusan -->
                <div class="mb-16">
                    <h2 class="text-xl md:text-2xl font-extrabold text-[#01018B] mb-6">Kompetensi Lulusan</h2>
                    <div id="kompetensi-grid" class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Section 2: Peran Lulusan -->
                <div class="mb-12 border border-[#01018B] rounded-xl p-8 bg-white shadow-sm">
                    <h3 class="text-xl md:text-2xl font-extrabold text-[#01018B] mb-6">Peran Lulusan</h3>
                    <div id="peran-grid" class="flex flex-wrap gap-4">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Section 3: Jenjang Karir Lanjutan -->
                <div class="border border-[#01018B] rounded-xl p-8 bg-white shadow-sm">
                    <div class="grid md:grid-cols-12 gap-8 items-start">
                        <div class="md:col-span-5">
                            <h3 class="text-xl md:text-2xl font-extrabold text-[#01018B] mb-4">Jenjang Karir Lanjutan</h3>
                            <p id="karir-desc" class="text-[14px] text-[#00008B] leading-relaxed">
                                <!-- Populated by JS -->
                            </p>
                        </div>
                        <div class="md:col-span-7">
                            <ul id="karir-list" class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-[#00008B]">
                                <!-- Populated by JS -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error State -->
            <div id="kompetensi-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data Kompetensi Lulusan</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/pages/kompetensi-lulusan</code> tersedia.</p>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const loading = document.getElementById('kompetensi-loading');
        const contentDiv = document.getElementById('kompetensi-content');
        const error = document.getElementById('kompetensi-error');

        const kompetensiGrid = document.getElementById('kompetensi-grid');
        const peranGrid = document.getElementById('peran-grid');
        const karirDesc = document.getElementById('karir-desc');
        const karirList = document.getElementById('karir-list');

        const svgIcons = [
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'
        ];

        const pillIcons = [
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#01018B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>'
        ];

        function parseContent(htmlStr) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(htmlStr, 'text/html');
            
            const lists = doc.querySelectorAll('ol, ul');
            const paragraphs = doc.querySelectorAll('p');

            const result = {
                kompetensi: [],
                peran: [],
                karirText: '',
                karir: []
            };

            if (lists.length > 0) {
                lists[0].querySelectorAll('li').forEach(li => {
                    result.kompetensi.push(li.textContent.trim().replace(/;$/, '').replace(/\.$/, ''));
                });
            }

            if (lists.length > 1) {
                lists[1].querySelectorAll('li').forEach(li => {
                    result.peran.push(li.textContent.trim().replace(/;$/, '').replace(/\.$/, ''));
                });
            }

            if (paragraphs.length > 2) {
                result.karirText = paragraphs[2].textContent.trim();
            }

            if (lists.length > 2) {
                lists[2].querySelectorAll('li').forEach(li => {
                    result.karir.push(li.textContent.trim().replace(/;$/, '').replace(/\.$/, ''));
                });
            }

            return result;
        }

        try {
            const response = await fetch('/api/pages/kompetensi-lulusan');
            if (!response.ok) throw new Error('Halaman tidak ditemukan');

            const json = await response.json();
            const pageData = json.data || json;

            const parsed = parseContent(pageData.content || '');

            // 1. Render Kompetensi Cards
            if (parsed.kompetensi.length > 0) {
                let html = '';
                parsed.kompetensi.forEach((text, i) => {
                    const icon = svgIcons[i % svgIcons.length];
                    html += `
                        <div class="border border-[#01018B] border-t-4 rounded p-6 hover:shadow-lg transition flex flex-col bg-white h-full group">
                            <div class="bg-blue-50 w-8 h-8 rounded mb-4 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                ${icon}
                            </div>
                            <h3 class="text-[15px] font-bold text-[#01018B] leading-snug">${text}</h3>
                        </div>
                    `;
                });
                kompetensiGrid.innerHTML = html;
            }

            // 2. Render Peran Lulusan Pills
            if (parsed.peran.length > 0) {
                let html = '';
                parsed.peran.forEach((text, i) => {
                    const icon = pillIcons[i % pillIcons.length];
                    html += `
                        <div class="border border-[#01018B]/20 rounded px-4 py-2 flex items-center gap-2 bg-white text-[12px] font-semibold text-[#00008B] hover:shadow-sm transition cursor-default whitespace-nowrap">
                            ${icon}
                            <span>${text}</span>
                        </div>
                    `;
                });
                peranGrid.innerHTML = html;
            }

            // 3. Render Jenjang Karir
            karirDesc.textContent = parsed.karirText || 'Setelah beberapa tahun bekerja di bidang teknologi informasi, lulusan JTK dapat juga mengemban tugas di posisi pekerjaan berikut:';
            if (parsed.karir.length > 0) {
                let html = '';
                parsed.karir.forEach(text => {
                    html += `
                        <li class="flex items-start gap-2 text-[13px] font-semibold mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#01018B] flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            <span class="leading-snug">${text}</span>
                        </li>
                    `;
                });
                karirList.innerHTML = html;
            }

            // Show content
            loading.classList.add('hidden');
            contentDiv.classList.remove('hidden');

        } catch (e) {
            console.error('Error:', e);
            loading.classList.add('hidden');
            error.classList.remove('hidden');
        }
    });
</script>
@endsection
