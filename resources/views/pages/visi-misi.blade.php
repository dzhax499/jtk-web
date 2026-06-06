@extends('layouts.app')

@section('title', 'Visi Misi - JTK POLBAN')

@section('content')
    <x-hero 
        title="Visi dan Misi"
        subtitle="Visi, misi, dan tujuan Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Visi+Misi">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> &gt; <span>Visi dan Misi</span></span>
    </x-hero>

    <section style="padding: 4rem 0; background-color: #ffffff;">
        <div style="max-width: 64rem; margin: 0 auto; padding: 0 1.5rem;">
            
            <div id="page-loading" style="display: grid; gap: 1.5rem; margin-bottom: 2rem;">
                <div style="height: 150px; background: #F1F5F9; border-radius: 8px;"></div>
                <div style="height: 200px; background: #F1F5F9; border-radius: 8px;"></div>
                <div style="height: 150px; background: #F1F5F9; border-radius: 8px;"></div>
            </div>

            <div id="page-content" style="display: none;"></div>

            <div id="page-error" style="display: none; text-align: center; padding: 4rem 0; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
                <p style="font-size: 1.25rem; font-weight: 600; color: #B91C1C; margin-bottom: 0.5rem;">Gagal mengambil data Visi Misi</p>
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
                const response = await fetch('/api/pages/visi-dan-misi');
                if (!response.ok) throw new Error('Page not found');

                const json = await response.json();
                const page = json.data || json;
                
                const htmlContent = page.content || page.excerpt || '';
                const div = document.createElement('div');
                div.innerHTML = htmlContent;

                const sections = [];
                let currentSection = null;

                // Parsing H2 dan isinya
                Array.from(div.children).forEach(child => {
                    if (child.tagName === 'H2' || child.tagName === 'H3') {
                        currentSection = {
                            title: child.textContent.trim(),
                            content: [],
                            listItems: []
                        };
                        sections.push(currentSection);
                    } else if (currentSection) {
                        if (child.tagName === 'P') {
                            const text = child.innerHTML.trim();
                            if(text) currentSection.content.push(text);
                        } else if (child.tagName === 'OL' || child.tagName === 'UL') {
                            Array.from(child.children).forEach(li => {
                                currentSection.listItems.push(li.innerHTML.trim());
                            });
                        }
                    }
                });

                if (sections.length === 0) throw new Error("No sections parsed");

                let finalHtml = '';
                const icons = [
                    '<svg style="width:28px; height:28px; color:#01018B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
                    '<svg style="width:28px; height:28px; color:#01018B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
                    '<svg style="width:28px; height:28px; color:#01018B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>',
                    '<svg style="width:28px; height:28px; color:#01018B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>',
                    '<svg style="width:28px; height:28px; color:#01018B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>'
                ];

                sections.forEach(sec => {
                    const titleLower = sec.title.toLowerCase();
                    
                    if (titleLower.includes('nilai')) {
                        // Nilai-Nilai Utama Grid
                        let cardsHtml = '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">';
                        sec.listItems.forEach((li, idx) => {
                            let name = '', desc = '';
                            const match = li.match(/<strong>(.*?)<\/strong>\s*[–\-]\s*(.*)/);
                            if (match) {
                                name = match[1]; desc = match[2];
                            } else {
                                // If regex fails, just split roughly or use full text
                                const parts = li.split('–');
                                if(parts.length > 1) {
                                    name = parts[0].replace(/<[^>]*>/g, '').trim();
                                    desc = parts.slice(1).join('–').trim();
                                } else {
                                    name = li.replace(/<[^>]*>/g, '').trim();
                                }
                            }
                            cardsHtml += `
                            <div style="background: #ffffff; border: 1px solid #BFDBFE; border-radius: 8px; padding: 1.5rem 1rem; text-align: center; display: flex; flex-direction: column; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                <div style="margin-bottom: 0.75rem;">${icons[idx] || icons[0]}</div>
                                <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 800; color: #01018B; margin-bottom: 0.5rem;">${name}</h3>
                                <p style="font-size: 0.75rem; color: #00008B; line-height: 1.5;">${desc}</p>
                            </div>`;
                        });
                        cardsHtml += '</div>';

                        finalHtml += `
                        <div style="margin-bottom: 3.5rem; margin-top: 3.5rem; text-align: center;">
                            <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.75rem; font-weight: 800; color: #01018B; margin-bottom: 1rem;">${sec.title}</h2>
                            <p style="font-size: 0.95rem; color: #00008B; max-width: 800px; margin: 0 auto 2.5rem auto; line-height: 1.6;">${sec.content.join('<br>')}</p>
                            ${cardsHtml}
                        </div>`;
                    } else {
                        // Visi, Tujuan, Strategi Umum
                        let contentHtml = '';
                        if (sec.content.length > 0) {
                            contentHtml += '<div style="color: #00008B; font-family: \'Poppins\', sans-serif; font-weight: 400; line-height: 1.7; font-size: 16px;">' + sec.content.join('<br>') + '</div>';
                        }
                        if (sec.listItems.length > 0) {
                            contentHtml += '<ol style="padding-left: 1.25rem; list-style-type: decimal; color: #00008B; font-family: \'Poppins\', sans-serif; font-weight: 400; line-height: 1.7; font-size: 16px; margin-top: 1rem;">';
                            sec.listItems.forEach(li => { contentHtml += '<li style="margin-bottom: 0.5rem;">' + li + '</li>'; });
                            contentHtml += '</ol>';
                        }

                        finalHtml += `
                        <div style="background: #F8FAFC; border: 1px solid #BFDBFE; border-radius: 8px; padding: 2rem; margin-bottom: 2.5rem;">
                            <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 800; color: #01018B; margin-bottom: 1rem;">${sec.title}</h2>
                            ${contentHtml}
                        </div>`;
                    }
                });

                content.innerHTML = finalHtml;
                
                loading.style.display = 'none';
                content.style.display = 'block';
            } catch (e) {
                console.error("Gagal memuat API visi-misi:", e);
                loading.style.display = 'none';
                error.style.display = 'block';
            }
        });
    </script>
@endsection
