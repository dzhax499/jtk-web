@extends('layouts.app')

@section('title', 'Tentang JTK - JTK POLBAN')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
    </style>
    <div style="font-family: 'Poppins', sans-serif;">
        
    <!-- Hero Section -->
    <x-hero 
        title="Tentang JTK"
        subtitle="Informasi terbaru seputar JTK"
        bgImage="https://via.placeholder.com/1920x400?text=Tentang+JTK">
        <span>Beranda</span> > <span>Tentang JTK</span>
    </x-hero>

    <!-- Content Section -->
    <section style="padding: 3rem 0; background-color: #ffffff;">
        <div style="max-width: 72rem; margin: 0 auto; padding: 0 2rem;">
            <div style="background: #F5F7FD; border: 1px solid #799DD6; border-radius: 8px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <h2 id="page-title" style="font-size: 32px; font-weight: 700; color: #01018B; margin-bottom: 1.25rem;">Tentang JTK</h2>

                <!-- Client-side loaded content: will fetch /api/pages/tentang-jtk -->
                <div id="page-loading" style="color: #00008B; font-weight: 600; margin-bottom: 1rem;">Memuat informasi Tentang JTK...</div>

                <div id="page-content" style="display: none; color: #00008B; font-weight: 400; line-height: 1.7; font-size: 16px; ">
                    <div id="page-body" style="display: flex; flex-direction: column; gap: 1rem;"></div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', async () => {
                        const loading = document.getElementById('page-loading');
                        const content = document.getElementById('page-content');
                        const titleEl = document.getElementById('page-title');
                        const bodyEl = document.getElementById('page-body');

                        const safeHtml = (html) => String(html || '')
                            .replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '')
                            .replace(/on\w+="[^"]*"/gi, '')
                            .replace(/on\w+='[^']*'/gi, '');

                        try {
                            const res = await fetch('/api/pages/tentang-jtk');
                            if (!res.ok) throw new Error('Page not found');
                            const json = await res.json();
                            const page = json.data || json;

                            titleEl.textContent = page.title || 'Tentang JTK';
                            bodyEl.innerHTML = safeHtml(page.content || page.excerpt || '<p>Konten belum tersedia.</p>');

                            loading.style.display = 'none';
                            content.style.display = 'block';
                        } catch (e) {
                            console.warn('Gagal memuat /api/pages/tentang-jtk', e);
                            loading.style.display = 'none';
                            content.style.display = 'block';
                            bodyEl.innerHTML = '<div style="color: #991B1B; font-weight: 600;">Terjadi kesalahan saat memuat konten. Silakan coba lagi nanti.</div>';
                        }
                    });
                </script>
            </div>
        </div>
    </section>
    </div>
@endsection
