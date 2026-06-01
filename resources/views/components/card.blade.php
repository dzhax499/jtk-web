<!-- resources/views/components/card.blade.php -->
@props(['title' => null, 'image' => null, 'href' => null, 'class' => ''])

@php
    $fallbackImage = 'https://placehold.co/600x400?text=JTK+POLBAN';
    $imageSrc = $image ?: $fallbackImage;
@endphp

<div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-card-hover transition-all duration-300 {{ $class }}">
    <div class="overflow-hidden h-48 bg-gray-100">
        <img
            src="{{ $imageSrc }}"
            alt="{{ $title ?? 'JTK POLBAN' }}"
            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
        >
    </div>

    <div class="p-6">
        @if($title)
            <h3 class="text-lg font-bold text-navy-900 mb-3">{{ $title }}</h3>
        @endif

        <div class="text-gray-700 text-sm leading-relaxed mb-4">
            {{ $slot }}
        </div>

        @if($href)
            <a href="{{ $href }}" class="inline-flex items-center text-navy-900 font-semibold hover:text-sky-light transition">
                Lihat Selengkapnya
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @endif
    </div>
</div>
