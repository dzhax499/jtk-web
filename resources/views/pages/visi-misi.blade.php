@extends('layouts.app')

@section('title', 'Visi Misi - JTK POLBAN')

@section('content')
    <x-hero 
        title="Visi dan Misi"
        subtitle="Visi, misi, dan tujuan Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Visi+Misi">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> &gt; <span>Visi dan Misi</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 rounded-lg border border-sky-light/30 bg-sky-light/10 px-5 py-4 text-sm text-gray-700">
                Konten halaman ini diambil menggunakan <strong>fetch REST API</strong> dari endpoint <code>/api/pages/visi-dan-misi</code>.
            </div>

            <div id="page-loading" class="animate-pulse space-y-5">
                <div class="h-8 bg-gray-200 rounded w-1/2"></div>
                <div class="h-5 bg-gray-200 rounded"></div>
                <div class="h-5 bg-gray-200 rounded w-5/6"></div>
                <div class="h-32 bg-gray-200 rounded-xl"></div>
            </div>

            <article id="page-content" class="hidden bg-white border border-gray-200 rounded-xl shadow-card p-8 md:p-10">
                <h2 id="page-title" class="text-3xl md:text-4xl font-bold text-navy-900 mb-8"></h2>
                <div id="page-body" class="visi-content prose max-w-none text-gray-700 leading-relaxed"></div>
            </article>

            <div id="page-error" class="hidden text-center py-16 bg-red-50 rounded-xl border border-red-200">
                <p class="text-xl font-semibold text-red-700 mb-2">Gagal mengambil data Visi Misi</p>
                <p class="text-red-600">Pastikan endpoint <code>/api/pages/visi-dan-misi</code> tersedia.</p>
            </div>
        </div>
    </section>

    <style>
        .visi-content h2,
        .visi-content h3 {
            color: #0f172a;
            font-weight: 800;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .visi-content h2:first-child,
        .visi-content h3:first-child {
            margin-top: 0;
        }

        .visi-content p {
            margin-bottom: 1rem;
        }

        .visi-content ul,
        .visi-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .visi-content li {
            margin-bottom: 0.5rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('page-loading');
            const content = document.getElementById('page-content');
            const error = document.getElementById('page-error');

            const safeHtml = (html) => String(html || '')
                .replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '')
                .replace(/on\w+="[^"]*"/gi, '')
                .replace(/on\w+='[^']*'/gi, '');

            try {
                const response = await fetch('/api/pages/visi-dan-misi');
                if (!response.ok) throw new Error('Page not found');

                const json = await response.json();
                const page = json.data || json;

                document.getElementById('page-title').textContent = page.title || 'Visi dan Misi';
                document.getElementById('page-body').innerHTML = safeHtml(page.content || page.excerpt || '<p>Konten visi misi belum tersedia.</p>');

                loading.classList.add('hidden');
                content.classList.remove('hidden');
            } catch (e) {
                loading.classList.add('hidden');
                error.classList.remove('hidden');
            }
        });
    </script>
@endsection
