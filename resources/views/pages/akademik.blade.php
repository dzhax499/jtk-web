@extends('layouts.app')

@section('title', 'Akademik - JTK POLBAN')

@section('content')
    <x-hero 
        title="Akademik"
        subtitle="Informasi akademik Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Akademik">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> &gt; <span>Akademik</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 rounded-lg border border-sky-light/30 bg-sky-light/10 px-5 py-4 text-sm text-gray-700">
                Konten ringkasan halaman ini diambil menggunakan <strong>fetch REST API</strong> dari endpoint <code>/api/pages/akademik</code>.
            </div>

            <div id="page-loading" class="animate-pulse space-y-4 mb-10">
                <div class="h-7 bg-gray-200 rounded w-1/2"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded w-5/6"></div>
            </div>

            <div id="page-content" class="hidden bg-white border border-gray-200 rounded-xl shadow-card p-8 mb-12">
                <h2 id="page-title" class="text-3xl font-bold text-navy-900 mb-6"></h2>
                <div id="page-body" class="prose max-w-none text-gray-700"></div>
            </div>

            <div id="page-fallback" class="hidden bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-12 text-yellow-900">
                Data halaman akademik belum tersedia di API. Konten default tetap ditampilkan di bawah.
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-card">
                    <div class="text-5xl mb-5">📅</div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Kalender Akademik</h3>
                    <p class="text-gray-600 mb-6">Lihat informasi kalender akademik resmi POLBAN yang berisi jadwal perkuliahan, ujian, libur akademik, dan agenda akademik lain.</p>
                    <a href="https://www.polban.ac.id/tentang-polban/kalender-akademik/" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                        Lihat Kalender Akademik →
                    </a>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-card">
                    <div class="text-5xl mb-5">📘</div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Peraturan Akademik</h3>
                    <p class="text-gray-600 mb-6">Akses informasi peraturan akademik resmi sebagai acuan pelaksanaan kegiatan akademik di Politeknik Negeri Bandung.</p>
                    <a href="https://www.polban.ac.id/peraturan-akademik/" target="_blank" rel="noopener noreferrer" class="inline-block px-6 py-2 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                        Lihat Peraturan Akademik →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const loading = document.getElementById('page-loading');
            const content = document.getElementById('page-content');
            const fallback = document.getElementById('page-fallback');

            const safeHtml = (html) => String(html || '')
                .replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '')
                .replace(/on\w+="[^"]*"/gi, '')
                .replace(/on\w+='[^']*'/gi, '');

            try {
                const response = await fetch('/api/pages/akademik');
                if (!response.ok) throw new Error('Page not found');

                const json = await response.json();
                const page = json.data || json;

                document.getElementById('page-title').textContent = page.title || 'Akademik';
                document.getElementById('page-body').innerHTML = safeHtml(page.content || page.excerpt || '<p>Konten akademik belum tersedia.</p>');

                loading.classList.add('hidden');
                content.classList.remove('hidden');
            } catch (e) {
                loading.classList.add('hidden');
                fallback.classList.remove('hidden');
            }
        });
    </script>
@endsection
