@extends('layouts.app')

@section('title', 'Arsip - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Berita"
        subtitle="Informasi terbaru seputar kegiatan, prestasi, dan pengumuman"
        bgImage="https://via.placeholder.com/1920x400?text=Arsip">
        <span>Beranda</span> > <span>Arsip</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Main Content -->
                <div class="flex-1">
                    <!-- Search and Filter -->
                    <div class="mb-12">
                        <div class="flex gap-4 mb-8">
                            <input type="text" placeholder="Cari arsip..." class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-900">
                            <button class="px-4 py-3 bg-navy-900 text-white rounded-lg hover:bg-navy-800 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Archive List -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-navy-900 mb-8">Daftar Arsip Terbaru</h2>
                        <div class="space-y-6">
                            @foreach($news as $item)
                                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition flex">
                                    <!-- Image -->
                                    <div class="w-40 h-32 flex-shrink-0 overflow-hidden">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 p-6 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center gap-3 mb-2">
                                                <span class="inline-block px-3 py-1 bg-navy-100 text-navy-900 text-xs font-semibold rounded">{{ $item['category'] }}</span>
                                                @if($item['type'] === 'prestasi')
                                                    <span class="inline-block px-3 py-1 bg-sky-light/20 text-sky-light text-xs font-semibold rounded">PRESTASI</span>
                                                @endif
                                            </div>
                                            <h3 class="text-lg font-bold text-navy-900 mb-2 hover:text-sky-light transition cursor-pointer">
                                                {{ $item['title'] }}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-3">{{ $item['excerpt'] }}</p>
                                        </div>
                                        
                                        <!-- Meta -->
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span>{{ $item['date'] }}</span>
                                            <span>👁️ {{ $item['views'] }} Views</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center gap-2">
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">‹</button>
                        <button class="px-3 py-2 bg-navy-900 text-white rounded">1</button>
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">2</button>
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">3</button>
                        <span class="px-3 py-2">...</span>
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">10</button>
                        <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">›</button>
                    </div>
                </div>

                <!-- Sidebar - Recent News -->
                <div class="lg:w-80 flex-shrink-0">
                    <div class="bg-blue-50 rounded-lg p-6 sticky top-24">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 bg-navy-900 text-white rounded flex items-center justify-center font-bold">
                                E
                            </div>
                            <h3 class="text-lg font-bold text-navy-900">Berita Terkini</h3>
                        </div>

                        <div class="space-y-4">
                            @foreach($news as $item)
                                <div class="border-b border-gray-300 pb-4 last:border-b-0">
                                    <div class="mb-2">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-24 object-cover rounded">
                                    </div>
                                    <h4 class="font-bold text-navy-900 text-sm hover:text-sky-light transition cursor-pointer">
                                        {{ substr($item['title'], 0, 50) }}...
                                    </h4>
                                    <p class="text-xs text-gray-600 mt-1">{{ $item['date'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        <a href="/berita" class="inline-block mt-6 px-4 py-2 border-2 border-navy-900 text-navy-900 font-semibold text-sm rounded-full hover:bg-navy-900 hover:text-white transition">
                            Lihat Semua Arsip →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
