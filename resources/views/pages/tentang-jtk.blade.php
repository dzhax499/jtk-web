@extends('layouts.app')

@section('title', 'Tentang JTK - JTK POLBAN')

@section('content')
    <div class="font-['Poppins']">
        
    <!-- Hero Section -->
    <x-hero 
        title="Tentang JTK"
        subtitle="Mengenal lebih dekat dedikasi dan kontribusi kami dalam mencetak talenta digital unggul Jurusan Teknik Komputer dan Informatika "
        bgImage="https://via.placeholder.com/1920x400?text=Tentang+JTK">
        <span><a href="/" class="underline">Beranda</a> &gt; <span>Tentang JTK</span>
    </x-hero>

    <!-- Content Section -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-8">
            <div class="bg-[#F5F7FD] border border-[#799DD6] rounded-lg p-10 shadow-sm">
                <h2 id="page-title" class="text-2xl md:text-4xl font-extrabold text-[#01018B] mb-5">Tentang JTK</h2>

                <!-- Client-side loaded content: will fetch /api/pages/tentang-jtk -->
                <div id="page-loading" class="text-[#00008B] font-semibold mb-4">Memuat informasi Tentang JTK...</div>

                <div id="page-content" style="display: none;" class="text-[#00008B] font-normal leading-relaxed text-base">
                    <div id="page-body" class="flex flex-col gap-4"></div>
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
