@extends('layouts.app')

@section('title', 'Berita - JTK POLBAN')

@section('content')
    <x-hero
        title="Berita"
        subtitle="Informasi terbaru seputar kegiatan, prestasi, dan pengumuman Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://placehold.co/1920x400?text=Berita">
        <span>Breadcrumb: <a href="/" class="underline">Beranda</a> > <span>Berita</span></span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ url('/berita') }}"
                       class="px-6 py-2 rounded-full font-semibold transition {{ ($activeCategory ?? 'Semua Berita') === 'Semua Berita' ? 'bg-navy-900 text-white hover:bg-navy-800' : 'border-2 border-gray-300 text-gray-700 hover:border-navy-900' }}">
                        Semua Berita
                    </a>

                    @foreach(array_filter($categories ?? []) as $category)
                        @continue($category === 'Semua Berita')
                        <a href="{{ url('/berita?category=' . urlencode($category)) }}"
                           class="px-6 py-2 rounded-full font-semibold transition {{ ($activeCategory ?? '') === $category ? 'bg-navy-900 text-white hover:bg-navy-800' : 'border-2 border-gray-300 text-gray-700 hover:border-navy-900' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>

                <form method="GET" action="{{ url('/berita') }}" class="relative w-full md:w-auto">
                    @if(!empty($activeCategory) && $activeCategory !== 'Semua Berita')
                        <input type="hidden" name="category" value="{{ $activeCategory }}">
                    @endif
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari Berita..."
                        class="w-full md:w-80 px-4 py-2 pl-10 border border-gray-300 rounded-full focus:outline-none focus:border-sky-light"
                    >
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </form>
            </div>

            <div class="flex items-center justify-between mb-8 text-sm text-gray-600">
                <p>
                    Menampilkan {{ count($news ?? []) }} berita dari database
                    @if(!empty($activeCategory) && $activeCategory !== 'Semua Berita')
                        untuk kategori <strong>{{ $activeCategory }}</strong>
                    @endif
                </p>
            </div>

            @if(empty($news))
                <div class="bg-white border border-gray-200 rounded-lg p-10 text-center text-gray-600">
                    Belum ada berita yang sesuai dengan filter ini.
                </div>
            @else
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
            @endif
        </div>
    </section>
@endsection
