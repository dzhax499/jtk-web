@extends('layouts.app')

@section('title', '{{ $article["title"] }} - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="{{ $article['title'] }}"
        bgImage="{{ $article['image'] }}">
        <div class="flex items-center space-x-4">
            <span>📅 {{ $article['date'] }}</span>
            <span>👁️ {{ $article['views'] }} Views</span>
        </div>
    </x-hero>

    <!-- Article Content -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-8 text-sm text-gray-600">
                <a href="/" class="underline hover:text-navy-900">Beranda</a> > 
                <a href="/berita" class="underline hover:text-navy-900">Berita</a> > 
                <span class="text-navy-900">{{ substr($article['title'], 0, 50) }}...</span>
            </div>

            <!-- Article Meta -->
            <div class="mb-8 pb-8 border-b border-gray-300">
                <h1 class="text-4xl font-bold text-navy-900 mb-4">{{ $article['title'] }}</h1>
                <div class="flex items-center space-x-6 text-gray-600">
                    <div class="flex items-center space-x-2">
                        <span>👤</span>
                        <span>Jurusan JTK</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>📅</span>
                        <span>{{ $article['date'] }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>👁️</span>
                        <span>{{ $article['views'] }} Kali Dibaca</span>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-auto">
            </div>

            <!-- Article Body -->
            <div class="prose prose-lg max-w-none mb-12">
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    {{ $article['content'] }}
                </p>

                <p class="text-gray-700 leading-relaxed mb-6">
                    BANDUNG - Politeknik Negeri Bandung (Polban) mengelar Sidang Terbuka Senat yang menghadirkan peluncuran program-program unggulan. Acara ini berlangsung dengan meriah dan dihadiri oleh berbagai stakeholder dari industri dan institusi pendidikan lainnya.
                </p>

                <p class="text-gray-700 leading-relaxed mb-6">
                    Dalam sambutan pembukaan, Direktur Polban menekankan komitmen institusi untuk terus berinovasi dan mengembangkan program-program yang relevan dengan kebutuhan industri. "Kami bangga dapat mempersiapkan lulusan yang tidak hanya kompeten secara teknis, tetapi juga memiliki soft skills yang kuat," ungkapnya.
                </p>

                <p class="text-gray-700 leading-relaxed">
                    Jurusan Teknik Komputer dan Informatika (JTK) khususnya, turut berkontribusi dalam menyajikan inovasi-inovasi terbaru dalam bidang teknologi informasi. Mahasiswa dan dosen JTK menampilkan berbagai project berkualitas yang mencerminkan dedikasi mereka dalam pendidikan.
                </p>
            </div>

            <!-- Share Section -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-12">
                <h3 class="font-bold text-navy-900 mb-4">Bagikan Artikel</h3>
                <div class="flex flex-wrap gap-4">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Facebook</button>
                    <button class="px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition">Twitter</button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">WhatsApp</button>
                    <button class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">Copy Link</button>
                </div>
            </div>

            <!-- Related Articles -->
            <div>
                <h2 class="text-2xl font-bold text-navy-900 mb-6">Artikel Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-card 
                        title="Prodi Sarjana Terapan Teknik Informatika Polban Raih Akreditasi Unggul"
                        image="https://via.placeholder.com/400x250?text=Akreditasi"
                        href="/berita/2">
                        <p class="text-sm text-gray-600">Program Studi Sarjana Terapan Teknik Informatika di bawah Jurusan Teknik Komputer dan Informatika...</p>
                    </x-card>

                    <x-card 
                        title="JTK Raih Lulusan D3 Terbaik di Wisuda POLBAN 2020"
                        image="https://via.placeholder.com/400x250?text=Wisuda"
                        href="/berita/3">
                        <p class="text-sm text-gray-600">Politeknik Negeri Bandung menggelar Sidang Terbuka Senat yang menghadirkan...</p>
                    </x-card>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-navy-900 text-white py-16 mt-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ingin Tahu Lebih Lanjut?</h2>
            <p class="text-lg text-gray-200 mb-8">Hubungi kami untuk informasi lebih detail tentang program dan kegiatan JTK POLBAN</p>
            <x-button href="#" type="primary" class="bg-sky-light text-navy-900 hover:bg-sky-bright">
                Hubungi Kami →
            </x-button>
        </div>
    </section>
@endsection
