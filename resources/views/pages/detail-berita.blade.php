@extends('layouts.app')

@section('title', 'Detail Berita - JTK POLBAN')

@section('content')
    <x-hero 
        title="Detail Berita"
        subtitle="Informasi lengkap berita Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Detail+Berita">
        <span><a href="/" class="underline">Beranda</a> &gt; <a href="/berita" class="underline">Berita</a> &gt; <span>Detail</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="article-loading" class="animate-pulse space-y-6">
                <div class="h-8 bg-gray-200 rounded w-3/4"></div>
                <div class="h-5 bg-gray-200 rounded w-1/2"></div>
                <div class="h-80 bg-gray-200 rounded-xl"></div>
                <div class="space-y-3">
                    <div class="h-4 bg-gray-200 rounded"></div>
                    <div class="h-4 bg-gray-200 rounded"></div>
                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                </div>
            </div>

            <article id="article-content" class="hidden">
                <h1 id="article-title" class="text-3xl md:text-4xl font-bold text-navy-900 mb-4"></h1>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-8">
                    <span id="article-date"></span>
                    <span id="article-views"></span>
                </div>
                <img id="article-image" src="" alt="" class="w-full rounded-xl shadow-card mb-10 max-h-[480px] object-cover" onerror="this.onerror=null;this.src='https://placehold.co/900x500?text=JTK+POLBAN';">
                <div id="article-body" class="prose max-w-none text-gray-700 leading-relaxed"></div>
                <div class="mt-10 pt-8 border-t border-gray-200">
                    <a href="/berita" class="inline-flex items-center text-navy-900 font-semibold hover:text-sky-light transition">← Kembali ke Berita</a>
                </div>
            </article>

            <div id="article-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil detail berita</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/posts/{{ $slug }}</code> tersedia.</p>
                <a href="/berita" class="inline-block mt-6 px-6 py-2 bg-navy-900 text-white rounded-full font-semibold">Kembali ke Berita</a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const slug = @json($slug);
            const placeholder = 'https://placehold.co/900x500?text=JTK+POLBAN';

            const loading = document.getElementById('article-loading');
            const content = document.getElementById('article-content');
            const error = document.getElementById('article-error');

            const stripDangerousHtml = (html) => String(html || '')
                .replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '')
                .replace(/on\w+="[^"]*"/gi, '')
                .replace(/on\w+='[^']*'/gi, '');

            try {
                const response = await fetch(`/api/posts/${encodeURIComponent(slug)}`);
                if (!response.ok) throw new Error('API gagal');

                const json = await response.json();
                const post = json.data || json;

                document.title = `${post.title || 'Detail Berita'} - JTK POLBAN`;
                document.getElementById('article-title').textContent = post.title || 'Tanpa Judul';
                document.getElementById('article-date').textContent = `📅 ${post.date_label || '-'}`;
                document.getElementById('article-views').textContent = `👁️ ${post.views ?? 0} Views`;

                const image = post.image_url || post.featured_media?.url || placeholder;
                const imageElement = document.getElementById('article-image');
                imageElement.src = image;
                imageElement.alt = post.title || 'JTK POLBAN';

                document.getElementById('article-body').innerHTML = stripDangerousHtml(post.content || post.excerpt || '<p>Konten belum tersedia.</p>');

                loading.classList.add('hidden');
                content.classList.remove('hidden');
            } catch (e) {
                loading.classList.add('hidden');
                error.classList.remove('hidden');
            }
        });
    </script>
@endsection
