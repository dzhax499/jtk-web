<!-- resources/views/components/icon-card.blade.php -->
@props(['icon' => null, 'title' => null, 'href' => null, 'class' => ''])

<div class="bg-white rounded-lg border border-gray-200 p-6 text-center hover:shadow-card-hover transition-all duration-300 {{ $class }}">
    @if($icon)
        <div class="mb-4 flex justify-center">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-sky-light/20 to-sky-bright/20 flex items-center justify-center">
                <span class="text-3xl">{{ $icon }}</span>
            </div>
        </div>
    @endif

    @if($title)
        <h3 class="text-lg font-bold text-navy-900 mb-3">{{ $title }}</h3>
    @endif

    <p class="text-gray-600 text-sm leading-relaxed mb-4">
        {{ $slot }}
    </p>

    @if($href)
        <a href="{{ $href }}" class="inline-flex items-center justify-center w-full py-2 px-4 rounded-lg border-2 border-navy-900 text-navy-900 font-semibold hover:bg-navy-50 transition">
            Selengkapnya →
        </a>
    @endif
</div>
