@extends('layouts.app')

@section('title', 'Hasil Penelitian - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Hasil Penelitian"
        subtitle="Informasi terbaru seputar Hasil Penelitian"
        bgImage="https://via.placeholder.com/1920x400?text=Hasil+Penelitian">
        <span>Beranda</span> > <span>Hasil Penelitian</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Main Tabs: Hasil Penelitian | Kegiatan PkM -->
            <div class="flex gap-8 mb-8 items-end">
                <button id="tab-penelitian" onclick="switchMainTab('penelitian')"
                    class="main-tab text-3xl md:text-4xl font-bold text-navy-900 pb-2 border-b-4 border-navy-900 transition-all duration-300 cursor-pointer">
                    Hasil Penelitian
                </button>
                <button id="tab-pkm" onclick="switchMainTab('pkm')"
                    class="main-tab text-3xl md:text-4xl font-bold text-gray-400 pb-2 border-b-4 border-transparent hover:text-navy-700 transition-all duration-300 cursor-pointer">
                    Kegiatan PkM
                </button>
            </div>

            <!-- Sub Tabs: Semua Program | Program Studi D3 | Program Studi D4 -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-3">
                    <button id="subtab-semua" onclick="switchSubTab('semua')"
                        class="sub-tab px-5 py-2 text-sm font-semibold rounded-full border transition-all duration-300 cursor-pointer bg-navy-900 text-white border-navy-900 shadow-md">
                        Semua Program
                    </button>
                    <button id="subtab-d3" onclick="switchSubTab('d3')"
                        class="sub-tab px-5 py-2 text-sm font-semibold rounded-full border transition-all duration-300 cursor-pointer bg-white text-navy-900 border-gray-300 hover:bg-gray-50">
                        Program Studi D3
                    </button>
                    <button id="subtab-d4" onclick="switchSubTab('d4')"
                        class="sub-tab px-5 py-2 text-sm font-semibold rounded-full border transition-all duration-300 cursor-pointer bg-white text-navy-900 border-gray-300 hover:bg-gray-50">
                        Program Studi D4
                    </button>
                </div>
            </div>

            <!-- Loading Skeleton -->
            <div id="penelitian-loading" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 6; $i++)
                    <div class="animate-pulse rounded-lg border border-gray-200 p-6">
                        <div class="h-4 bg-gray-200 rounded w-full mb-3"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6 mb-3"></div>
                        <div class="h-3 bg-gray-200 rounded w-2/3 mb-3"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/3 mb-2"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                    </div>
                @endfor
            </div>

            <!-- Research/PkM Cards Grid -->
            <div id="penelitian-grid" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Populated dynamically by JavaScript --}}
            </div>

            <!-- Error State -->
            <div id="penelitian-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data Hasil Penelitian</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/pages/hasil-penelitian</code> tersedia.</p>
            </div>

            <!-- SINTA Link Button -->
            <div id="sinta-link" class="hidden text-center mt-12">
                <a id="sinta-btn" href="#" target="_blank" rel="noreferrer noopener"
                    class="inline-flex items-center gap-2 px-8 py-3 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition-all duration-300">
                    Selengkapnya di SINTA
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('penelitian-loading');
            const grid = document.getElementById('penelitian-grid');
            const error = document.getElementById('penelitian-error');
            const sintaLink = document.getElementById('sinta-link');
            const sintaBtn = document.getElementById('sinta-btn');

            // State
            let allData = {
                penelitian: { d3: [], d4: [], links: { d3: '#', d4: '#' } },
                pkm: { d3: [], d4: [], links: { d3: '#', d4: '#' } }
            };
            let currentMainTab = 'penelitian';
            let currentSubTab = 'semua';

            function parseContent(htmlContent) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(htmlContent, 'text/html');
                const body = doc.body;

                const result = {
                    penelitian: { d3: [], d4: [], links: { d3: '#', d4: '#' } },
                    pkm: { d3: [], d4: [], links: { d3: '#', d4: '#' } }
                };

                // We'll walk through the DOM nodes sequentially to detect sections
                let currentProgram = null; // 'd3' or 'd4'
                let currentSection = null; // 'penelitian' or 'pkm'

                const elements = body.children;
                for (let i = 0; i < elements.length; i++) {
                    const el = elements[i];
                    const text = el.textContent.trim();

                    // Detect program headers
                    if (text.match(/Program\s+Studi\s*D3/i) && el.tagName === 'P') {
                        currentProgram = 'd3';
                        currentSection = null;
                        continue;
                    }
                    if (text.match(/Program\s+Studi\s*D4/i) && el.tagName === 'P') {
                        currentProgram = 'd4';
                        currentSection = null;
                        continue;
                    }

                    // Detect section headers
                    if (text.match(/Penelitian\s+Dosen/i) && el.tagName === 'P') {
                        currentSection = 'penelitian';
                        continue;
                    }
                    if (text.match(/Kegiatan\s+Pelayanan|Pengabdian\s+kepada\s+Masyarakat|PkM/i) && el.tagName === 'P') {
                        currentSection = 'pkm';
                        continue;
                    }

                    // Parse list items
                    if (el.tagName === 'UL' && currentProgram && currentSection) {
                        const listItems = el.querySelectorAll('li');
                        listItems.forEach(li => {
                            const itemText = li.textContent.trim();
                            if (itemText) {
                                const parsed = parseResearchItem(itemText, currentSection);
                                result[currentSection][currentProgram].push(parsed);
                            }
                        });
                        continue;
                    }

                    // Detect SINTA links
                    if (el.tagName === 'P' && currentProgram && currentSection) {
                        const link = el.querySelector('a');
                        if (link && link.href && text.match(/Selengkapnya/i)) {
                            result[currentSection][currentProgram].link = link.getAttribute('href') || '#';
                            // Store the SINTA link
                            if (result[currentSection].links) {
                                result[currentSection].links[currentProgram] = link.getAttribute('href') || '#';
                            }
                        }
                    }
                }

                return result;
            }

            function parseResearchItem(text, section) {
                if (section === 'penelitian') {
                    const yearMatch = text.match(/,\s*((?:19|20)\d{2})\s*,/);
                    const year = yearMatch ? yearMatch[1] : '';

                    let title = '';
                    let author = '';
                    let source = '';

                    // Extract title between quotes (various quote marks)
                    const titleMatch = text.match(/["\u201c\u201d](.*?)["\u201c\u201d]/);
                    if (titleMatch) {
                        title = titleMatch[1].trim();
                    }

                    // Author is everything before the year
                    if (yearMatch) {
                        author = text.substring(0, yearMatch.index).trim();
                        // Remove trailing comma
                        author = author.replace(/,\s*$/, '');
                    }

                    // Source is everything after the last closing quote
                    const lastQuoteIdx = Math.max(
                        text.lastIndexOf('\u201d'),
                        text.lastIndexOf('"')
                    );
                    if (lastQuoteIdx > -1) {
                        source = text.substring(lastQuoteIdx + 1).trim();
                        // Remove leading comma or period
                        source = source.replace(/^[,.\s]+/, '').replace(/[.\s]+$/, '');
                    }

                    return { title, author, year, source, raw: text };
                } else {
                    // PkM: more varied format
                    // Try to find year
                    const yearMatch = text.match(/((?:19|20)\d{2})/);
                    const year = yearMatch ? yearMatch[1] : '';

                    // Try to extract the activity title in quotes
                    const titleMatch = text.match(/["\u201c\u201d](.*?)["\u201c\u201d]/);
                    let title = '';
                    let description = '';

                    if (titleMatch) {
                        title = titleMatch[1].trim();
                    } else {
                        // Use the beginning of text as title
                        title = text.length > 100 ? text.substring(0, 100) + '...' : text;
                    }

                    // Extract "Dosen yang terlibat"
                    const dosenMatch = text.match(/Dosen\s+yang\s+terlibat\s+(.*?)(?:,\s*Pendanaan|$)/i);
                    const dosen = dosenMatch ? dosenMatch[1].trim().replace(/,\s*$/, '') : '';

                    // Extract "Pendanaan"
                    const pendanaanMatch = text.match(/Pendanaan\s+(.*?)\.?\s*$/i);
                    const pendanaan = pendanaanMatch ? pendanaanMatch[1].trim().replace(/\.\s*$/, '') : '';

                    return { title, dosen, year, pendanaan, raw: text };
                }
            }

            function renderResearchCard(item) {
                return `
                    <div class="flex flex-col h-full border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 bg-white">
                        <h3 class="font-bold text-[#01018B] text-lg leading-snug mb-3">${escapeHtml(item.title || item.raw)}</h3>
                        ${item.author ? `<p class="text-sm text-[#00008B] mb-6 leading-relaxed">${escapeHtml(item.author)}</p>` : ''}
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-200 gap-4">
                            ${item.year ? `<span class="text-sm font-semibold text-[#00008B] whitespace-nowrap">${escapeHtml(item.year)}</span>` : '<span></span>'}
                            ${item.source ? `<span class="text-xs font-medium text-[#00008B] bg-navy-50 px-3 py-1.5 rounded text-right leading-tight break-words max-w-[75%]">${escapeHtml(item.source)}</span>` : ''}
                        </div>
                    </div>
                `;
            }

            function renderPkmCard(item) {
                return `
                    <div class="flex flex-col h-full border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 bg-white">
                        <h3 class="font-bold text-[#01018B] text-lg leading-snug mb-3">${escapeHtml(item.title || item.raw)}</h3>
                        ${item.dosen ? `<p class="text-sm text-[#00008B] mb-6 leading-relaxed">${escapeHtml(item.dosen)}</p>` : ''}
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-200 gap-4">
                            ${item.year ? `<span class="text-sm font-semibold text-[#00008B] whitespace-nowrap">${escapeHtml(item.year)}</span>` : '<span></span>'}
                            ${item.pendanaan ? `<span class="text-xs font-medium text-[#00008B] bg-navy-50 px-3 py-1.5 rounded text-right leading-tight break-words max-w-[75%]">${escapeHtml(item.pendanaan)}</span>` : ''}
                        </div>
                    </div>
                `;
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.appendChild(document.createTextNode(text));
                return div.innerHTML;
            }

            function renderGrid() {
                const sectionData = allData[currentMainTab];
                let items = [];

                if (currentSubTab === 'semua') {
                    items = [...(sectionData.d3 || []), ...(sectionData.d4 || [])];
                } else if (currentSubTab === 'd3') {
                    items = sectionData.d3 || [];
                } else if (currentSubTab === 'd4') {
                    items = sectionData.d4 || [];
                }

                if (items.length > 0) {
                    const renderFn = currentMainTab === 'penelitian' ? renderResearchCard : renderPkmCard;
                    grid.innerHTML = items.map(renderFn).join('');
                    grid.classList.remove('hidden');
                } else {
                    grid.innerHTML = '<div class="col-span-3 text-center py-12 text-gray-500"><p>Belum ada data untuk kategori ini.</p></div>';
                    grid.classList.remove('hidden');
                }

                // Update SINTA link
                updateSintaLink();
            }

            function updateSintaLink() {
                const sectionData = allData[currentMainTab];
                let href = '#';

                if (currentSubTab === 'd3' && sectionData.links && sectionData.links.d3) {
                    href = sectionData.links.d3;
                } else if (currentSubTab === 'd4' && sectionData.links && sectionData.links.d4) {
                    href = sectionData.links.d4;
                } else {
                    // For "Semua Program", use D3 link as default
                    href = sectionData.links ? (sectionData.links.d3 || sectionData.links.d4 || '#') : '#';
                }

                if (href && href !== '#') {
                    // Fix outdated Kemdikbud domain to new Kemdiktisaintek domain
                    href = href.replace('sinta.kemdikbud.go.id', 'sinta.kemdiktisaintek.go.id');
                    sintaBtn.href = href;
                    sintaLink.classList.remove('hidden');
                } else {
                    sintaLink.classList.add('hidden');
                }
            }

            // Expose tab switching functions to global scope
            window.switchMainTab = function(tab) {
                currentMainTab = tab;

                // Update main tab styles
                document.querySelectorAll('.main-tab').forEach(btn => {
                    btn.classList.remove('text-navy-900', 'border-navy-900');
                    btn.classList.add('text-gray-400', 'border-transparent');
                });

                const activeTab = document.getElementById('tab-' + tab);
                activeTab.classList.remove('text-gray-400', 'border-transparent');
                activeTab.classList.add('text-navy-900', 'border-navy-900');

                renderGrid();
            };

            window.switchSubTab = function(tab) {
                currentSubTab = tab;

                // Update sub tab styles
                document.querySelectorAll('.sub-tab').forEach(btn => {
                    btn.classList.remove('bg-navy-900', 'text-white', 'border-navy-900', 'shadow-md', 'bg-navy-50', 'border-navy-50'); // just to be safe with old classes
                    btn.classList.add('bg-white', 'text-navy-900', 'border-gray-300', 'hover:bg-gray-50');
                });

                const activeSubTab = document.getElementById('subtab-' + tab);
                activeSubTab.classList.remove('bg-white', 'text-navy-900', 'border-gray-300', 'hover:bg-gray-50');
                activeSubTab.classList.add('bg-navy-900', 'text-white', 'border-navy-900', 'shadow-md');

                renderGrid();
            };

            // Fetch data from API
            try {
                const response = await fetch('/api/pages/hasil-penelitian');
                if (!response.ok) throw new Error('Halaman tidak ditemukan');

                const json = await response.json();
                const page = json.data || json;

                // Parse the content HTML into structured data
                allData = parseContent(page.content || '');

                // Hide loading, show grid
                loading.classList.add('hidden');
                renderGrid();

            } catch (e) {
                console.error('Error fetching hasil penelitian:', e);
                loading.classList.add('hidden');
                error.classList.remove('hidden');
            }
        });
    </script>

    <style>
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection