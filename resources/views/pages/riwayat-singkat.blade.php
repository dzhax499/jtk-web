@extends('layouts.app')

@section('title', 'Riwayat Singkat - JTK POLBAN')

@section('content')
    <div class="font-['Poppins']">

    <!-- Hero Section -->
    <x-hero 
        title="Riwayat Singkat"
        subtitle="Informasi terbaru seputar Riwayat Singkat"
        bgImage="https://via.placeholder.com/1920x400?text=Riwayat+Singkat">
        <span>Beranda</span> > <span>Riwayat Singkat</span>
    </x-hero>

    <section style="padding: 4rem 0; background-color: #ffffff;">
        <div style="max-width: 72rem; margin: 0 auto; padding: 0 1.5rem;">
            
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 class="text-2xl md:text-[40px] font-extrabold text-[#01018B]">Riwayat Singkat</h2>
            </div>

            <!-- Loading state -->
            <div id="page-loading" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
                <div style="height: 200px; background: #F1F5F9; border-radius: 4px; border-left: 4px solid #CBD5E1;"></div>
                <div style="height: 200px; background: #F1F5F9; border-radius: 4px; border-left: 4px solid #CBD5E1;"></div>
                <div style="height: 200px; background: #F1F5F9; border-radius: 4px; border-left: 4px solid #CBD5E1;"></div>
            </div>

            <!-- Dynamic content injected here -->
            <div id="page-content" style="display: none;"></div>

            <!-- Error state -->
            <div id="page-error" style="display: none; text-align: center; padding: 4rem 0; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
                <p style="font-size: 1.25rem; font-weight: 600; color: #B91C1C; margin-bottom: 0.5rem;">Gagal mengambil data Riwayat Singkat</p>
                <p style="color: #DC2626;">Silakan coba lagi beberapa saat lagi.</p>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('page-loading');
            const content = document.getElementById('page-content');
            const error = document.getElementById('page-error');

            try {
                const res = await fetch('/api/pages/riwayat-singkat');
                if (!res.ok) throw new Error('Page not found');
                const json = await res.json();
                const page = json.data || json;

                const htmlContent = page.content || page.excerpt || '';
                const div = document.createElement('div');
                div.innerHTML = htmlContent;

                const items = [];

                Array.from(div.children).forEach(child => {
                    if (child.tagName === 'P') {
                        const text = child.textContent.trim();
                        if (!text) return;
                        const yearMatch = text.match(/tahun\s+([0-9]{4})/i);
                        if (yearMatch) {
                            items.push({ year: yearMatch[1], text: text });
                        } else {
                            items.push({ year: '-', text: text });
                        }
                    } else if (child.tagName === 'OL' || child.tagName === 'UL') {
                        Array.from(child.children).forEach(li => {
                            const text = li.textContent.trim();
                            if (!text) return;
                            // Match variants like "Tahun 1989," or "Tahun 2001 (sampai sekarang),"
                            const yearMatch = text.match(/^Tahun\s+([0-9]{4}(?:[—\-][0-9]{4}|\s*\(sampai sekarang\))?)/i);
                            if (yearMatch) {
                                items.push({ year: yearMatch[1], text: text });
                            } else {
                                // Fallback if it doesn't start with "Tahun XXXX"
                                const internalMatch = text.match(/tahun\s+([0-9]{4}(?:[—\-][0-9]{4})?)/i);
                                if (internalMatch) {
                                    items.push({ year: internalMatch[1], text: text });
                                } else {
                                    items.push({ year: 'Info', text: text });
                                }
                            }
                        });
                    }
                });

                if (items.length > 0) {
                    let cardsHtml = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">';
                    
                    items.forEach(item => {
                        cardsHtml += `
                        <div class="bg-white border border-gray-200 border-l-4 border-l-[#01018B] p-6 flex flex-col shadow-sm">
                            <div class="bg-[#00004E]/10 text-[#00004E] text-xs font-bold py-1.5 px-3 rounded self-start mb-4">
                                ${item.year}
                            </div>
                            <p class="text-[15px] font-normal text-[#01018B] leading-relaxed m-0">
                                ${item.text}
                            </p>
                        </div>`;
                    });

                    cardsHtml += '</div>';
                    content.innerHTML = cardsHtml;
                } else {
                    content.innerHTML = '<p style="text-align:center; color: #01018B;">Tidak ada data riwayat singkat.</p>';
                }

                loading.style.display = 'none';
                content.style.display = 'block';
            } catch (e) {
                console.error('Gagal memuat /api/pages/riwayat-singkat', e);
                loading.style.display = 'none';
                error.style.display = 'block';
            }
        });
    </script>
    </div>
@endsection
