@extends('layouts.app')

@section('title', ($article['title'] ?? 'Detail Berita') . ' - JTK POLBAN')

@section('content')
    <x-hero
        title="{{ $article['title'] }}"
        bgImage="{{ $article['image'] }}">
        <div class="flex items-center space-x-4">
            <span>📅 {{ $article['date'] }}</span>
            <span>👁️ {{ $article['views'] }} Views</span>
        </div>
    </x-hero>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-sm text-gray-600">
                <a href="/" class="underline hover:text-navy-900">Beranda</a> &gt;
                <a href="/berita" class="underline hover:text-navy-900">Berita</a> &gt;
                <span class="text-navy-900">{{ \Illuminate\Support\Str::limit($article['title'], 50) }}</span>
            </div>

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

            <div class="mb-8 rounded-lg overflow-hidden shadow-lg bg-gray-100">
                <img
                    src="{{ $article['image'] }}"
                    alt="{{ $article['title'] }}"
                    class="w-full h-auto"
                    onerror="this.onerror=null;this.src='https://placehold.co/900x500?text=JTK+POLBAN';"
                >
            </div>

            <article class="prose prose-lg max-w-none mb-12 text-gray-700 leading-relaxed">
                {!! $article['content'] !!}
            </article>

            @if(!empty($relatedArticles))
                <div>
                    <h2 class="text-2xl font-bold text-navy-900 mb-6">Artikel Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($relatedArticles as $related)
                            <x-card
                                title="{{ $related['title'] }}"
                                image="{{ $related['image'] }}"
                                href="/berita/{{ $related['id'] }}">
                                <p class="text-sm text-gray-600">{{ $related['excerpt'] }}</p>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
