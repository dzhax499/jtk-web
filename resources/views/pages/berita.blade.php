@extends('layouts.app')

@section('title', 'Berita - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Berita"
        subtitle="Informasi terbaru seputar kegiatan, prestasi, dan pengumuman Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Berita">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> > <span>Berita</span></span>
    </x-hero>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter and Search -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <!-- Category Filter -->
                <div class="flex flex-wrap gap-3">
                    <button class="px-6 py-2 bg-navy-900 text-white rounded-full font-semibold hover:bg-navy-800 transition">
                        Semua Berita
                    </button>
                    @foreach(array_slice($categories, 1) as $category)
                        <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>

                <!-- Search -->
                <div class="relative w-full md:w-auto">
                    <input 
                        type="text" 
                        placeholder="Cari Berita..."
                        class="w-full md:w-80 px-4 py-2 pl-10 border border-gray-300 rounded-full focus:outline-none focus:border-sky-light"
                    >
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                @foreach($news as $article)
                    <x-card 
                        title="{{ $article['title'] }}"
                        image="{{ $article['image'] }}"
                        href="/berita/{{ $article['id'] }}">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                {{ $article['category'] }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                            <span>📅 {{ $article['date'] }}</span>
                            <span>👁️ {{ $article['views'] }} Views</span>
                        </div>
                        <p class="text-gray-600">{{ $article['excerpt'] }}</p>
                    </x-card>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center space-x-2 py-8">
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">←</button>
                <button class="px-4 py-2 bg-navy-900 text-white rounded-lg">1</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">2</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">3</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">→</button>
            </div>
        </div>
    </section>

    <!-- Recent Sidebar Info -->
    <section class="bg-gray-50 py-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-card text-center">
                    <span class="text-4xl mb-4 block">📰</span>
                    <p class="text-3xl font-bold text-navy-900 mb-2">128</p>
                    <p class="text-gray-600">Total Berita</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-card text-center">
                    <span class="text-4xl mb-4 block">👥</span>
                    <p class="text-3xl font-bold text-navy-900 mb-2">45K+</p>
                    <p class="text-gray-600">Total Pengunjung</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-card text-center">
                    <span class="text-4xl mb-4 block">📅</span>
                    <p class="text-3xl font-bold text-navy-900 mb-2">2026</p>
                    <p class="text-gray-600">Tahun Terbit</p>
                </div>
            </div>
        </div>
    </section>
@endsection
