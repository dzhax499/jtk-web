@extends('layouts.app')

@section('title', 'Akreditasi - JTK POLBAN')

@section('content')
    <x-hero 
        title="Akreditasi"
        subtitle="Informasi akreditasi program studi Jurusan Teknik Komputer dan Informatika"
        bgImage="https://via.placeholder.com/1920x400?text=Akreditasi">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> &gt; <span>Akreditasi</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 rounded-lg border border-sky-light/30 bg-sky-light/10 px-5 py-4 text-sm text-gray-700">
                Konten ringkasan halaman ini diambil menggunakan <strong>fetch REST API</strong> dari endpoint <code>/api/pages/akreditasi</code>.
            </div>

            <div id="page-loading" class="animate-pulse space-y-4 mb-10">
                <div class="h-7 bg-gray-200 rounded w-1/2"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
            </div>

            <div id="page-content" class="hidden bg-white border border-gray-200 rounded-xl shadow-card p-8 mb-12">
                <h2 id="page-title" class="text-3xl font-bold text-navy-900 mb-6"></h2>
                <div id="page-body" class="prose max-w-none text-gray-700"></div>
            </div>

            <div id="page-fallback" class="hidden bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-12 text-yellow-900">
                Data halaman akreditasi belum tersedia di API. Informasi akreditasi default tetap ditampilkan di bawah.
            </div>

            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-navy-900 mb-3">Akreditasi Program Studi</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Informasi akreditasi program studi di Jurusan Teknik Komputer dan Informatika.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-navy-900">D3 Teknik Informatika</h3>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-bold">UNGGUL</span>
                    </div>
                    <p class="text-gray-600 mb-3">Terakreditasi tahun 2023, berlaku hingga 2028-08-07.</p>
                    <p class="text-gray-600 mb-6">No. SK: 073/SK/LAM-INFOKOM/Ak/D3/VIII/2023.</p>
                    <div class="space-y-3">
                        <a href="https://www.polban.ac.id/wp-content/uploads/2024/01/24.-Sertifikat-Akreditasi-D3-Teknik-Informatika_073-2023-2028.pdf" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 bg-navy-900 text-white rounded-lg font-semibold hover:bg-navy-800 transition">
                            Unduh Sertifikat
                        </a>
                        <a href="https://laminfokom.or.id/official/data-akreditasi-1.html" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 border-2 border-navy-900 text-navy-900 rounded-lg font-semibold hover:bg-navy-50 transition">
                            Kunjungi LAM INFOKOM
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-navy-900">Sarjana Terapan Teknik Informatika</h3>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-bold">UNGGUL</span>
                    </div>
                    <p class="text-gray-600 mb-3">Terakreditasi tahun 2025, berlaku hingga 2030-08-15.</p>
                    <p class="text-gray-600 mb-6">No. SK: 146/SK/LAM-INFOKOM/Ak/STr/VIII/2025.</p>
                    <div class="space-y-3">
                        <a href="https://www.polban.ac.id/wp-content/uploads/2025/08/file_sertifikat_25051520395200500455301_1755423415.pdf" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 bg-navy-900 text-white rounded-lg font-semibold hover:bg-navy-800 transition">
                            Unduh Sertifikat
                        </a>
                        <a href="https://laminfokom.or.id/official/data-akreditasi-1.html" target="_blank" rel="noopener noreferrer" class="block w-full text-center px-6 py-3 border-2 border-navy-900 text-navy-900 rounded-lg font-semibold hover:bg-navy-50 transition">
                            Kunjungi LAM INFOKOM
                        </a>
                    </div>
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
                const response = await fetch('/api/pages/akreditasi');
                if (!response.ok) throw new Error('Page not found');

                const json = await response.json();
                const page = json.data || json;

                document.getElementById('page-title').textContent = page.title || 'Akreditasi';
                document.getElementById('page-body').innerHTML = safeHtml(page.content || page.excerpt || '<p>Konten akreditasi belum tersedia.</p>');

                loading.classList.add('hidden');
                content.classList.remove('hidden');
            } catch (e) {
                loading.classList.add('hidden');
                fallback.classList.remove('hidden');
            }
        });
    </script>
@endsection
