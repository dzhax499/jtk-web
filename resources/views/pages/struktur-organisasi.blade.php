@extends('layouts.app')

@section('title', 'Struktur Organisasi - JTK POLBAN')

@section('content')
    <div class="font-['Poppins']">
        
    <!-- Hero Section -->
    <x-hero 
        title="Struktur Organisasi"
        subtitle="Informasi terbaru seputar Struktur Organisasi"
        bgImage="https://via.placeholder.com/1920x400?text=Struktur+Organisasi">
        <span>Beranda</span> > <span>Struktur Organisasi</span>
    </x-hero>

    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            
            <!-- Loading State -->
            <div id="page-loading" style="display: grid; gap: 0.75rem; margin-bottom: 1.5rem;">
                <div style="height: 4rem; background: #E2E8F0; border-radius: 2px;"></div>
                <div style="height: 4rem; background: #E2E8F0; border-radius: 2px;"></div>
                <div style="height: 4rem; background: #E2E8F0; border-radius: 2px;"></div>
            </div>

            <!-- This is where the dynamic API content will be injected -->
            <div id="struktur-container"></div>
        </div>
    </section>

    <style>
        /* Hide default marker */
        details summary::-webkit-details-marker { display: none; }
        details summary::marker { display: none; content: ''; }
        /* Rotate chevron when open */
        details[open] summary svg { transform: rotate(180deg); }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('page-loading');
            const container = document.getElementById('struktur-container');

            try {
                // 1. Ambil data asli dari CMS/Database
                const response = await fetch('/api/pages/struktur-organisasi');
                if (!response.ok) throw new Error('Page not found');
                const json = await response.json();
                const page = json.data || json;
                
                const htmlContent = page.content || '';
                const div = document.createElement('div');
                div.innerHTML = htmlContent;
                
                const sections = [];
                let currentSection = null;
                
                // 2. Parser cerdas: Ekstrak data teks polos jadi struktur teratur
                Array.from(div.children).forEach(child => {
                    const text = child.textContent.trim();
                    if (!text) return;
                    
                    // Deteksi Header (A., B., C., dst)
                    if (/^[A-Z]\./.test(text) && !child.querySelector('br') && text.length < 150) {
                        currentSection = {
                            title: text,
                            items: []
                        };
                        sections.push(currentSection);
                    } else if (currentSection) {
                        // Deteksi Isi: Nama, NIP, Jabatan yang dipisah <br>
                        const parts = child.innerHTML.split(/<br\s*\/?>/i);
                        let role = '', name = '', nip = '';
                        
                        if (parts.length === 3) {
                            const t = document.createElement('div'); t.innerHTML = parts[0]; role = t.textContent.trim();
                            const t2 = document.createElement('div'); t2.innerHTML = parts[1]; name = t2.textContent.trim();
                            const t3 = document.createElement('div'); t3.innerHTML = parts[2]; nip = t3.textContent.trim();
                            currentSection.items.push({ role, name, nip });
                        } else if (parts.length === 2) {
                            const t2 = document.createElement('div'); t2.innerHTML = parts[0]; name = t2.textContent.trim();
                            const t3 = document.createElement('div'); t3.innerHTML = parts[1]; nip = t3.textContent.trim();
                            currentSection.items.push({ role: '', name, nip });
                        } else {
                            currentSection.items.push({ raw: child.textContent.trim() });
                        }
                    }
                });
                
                // 3. Buat HTML akhir berdasarkan struktur yang sudah diparse
                if (sections.length > 0) {
                    let finalHtml = '<div style="display: flex; flex-direction: column; gap: 0.75rem;">';
                    
                    sections.forEach((sec, idx) => {
                        const isOpen = idx === 0 ? 'open' : '';
                        let itemsHtml = '<div style="border-top: 1px solid #C6C5D5; padding: 2rem;"><div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; align-items: stretch;">';
                            
                        sec.items.forEach(item => {
                            if (item.raw) {
                                itemsHtml += '<div class="w-full"><p class="text-[#01018B] text-[15px] leading-relaxed">' + item.raw + '</p></div>';
                            } else {
                                itemsHtml += `
                                <div style="background: #F9F9F9; border: 1px solid #C6C5D5; border-radius: 2px; padding: 20px 16px; text-align: center; display: flex; flex-direction: column; align-items: center; height: 100%;">
                                    <div style="background: #EEEEEE; border: 1px solid rgba(198, 197, 213, 0.2); border-radius: 16px; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; flex-shrink: 0;">
                                        <svg style="width: 28px; height: 28px; color: #1A1C1C;" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2z"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    </div>
                                    <p class="font-semibold text-[#01018B] text-base mb-1 leading-snug">${item.name}</p>
                                    ${item.role ? '<p class="font-medium text-gray-500 text-xs uppercase tracking-wide mb-1 leading-snug">' + item.role + '</p>' : ''}
                                    <p class="font-normal text-gray-500 text-xs mt-auto">${item.nip}</p>
                                </div>`;
                            }
                        });
                        
                        itemsHtml += '</div></div>';
                        
                        finalHtml += `
                        <details ${isOpen} style="background: #ffffff; border: 1px solid #C6C5D5; border-radius: 2px; overflow: hidden;">
                            <summary style="background: #F3F3F4; display: flex; cursor: pointer; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; font-weight: 700; color: #01018B; font-size: 16px; list-style: none;">
                                <span>${sec.title}</span>
                                <svg style="width: 20px; height: 20px; color: #01018B; transition: transform 0.3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </summary>
                            ${sec.items.length > 0 ? itemsHtml : ''}
                        </details>`;
                    });
                    
                    finalHtml += '</div>';
                    
                    if(loading) loading.style.display = 'none';
                    if(container) container.innerHTML = finalHtml;
                } else {
                    throw new Error("No parsed sections");
                }
            } catch (e) {
                console.error("Failed to parse API data:", e);
                if(loading) loading.style.display = 'none';
                if(container) container.innerHTML = '<div style="color: #991B1B; font-weight: 600;">Terjadi kesalahan saat memuat struktur organisasi. Silakan coba lagi nanti.</div>';
            }
        });
    </script>
    </div>
@endsection
