<!-- resources/views/components/section-title.blade.php -->
@props(['title', 'subtitle' => null, 'centered' => true, 'class' => ''])

<div class="@if($centered) text-center @endif mb-12 {{ $class }}">
    <h2 class="text-3xl md:text-4xl font-bold text-navy-900 mb-3">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="text-lg text-gray-600 max-w-2xl @if($centered) mx-auto @endif">
            {{ $subtitle }}
        </p>
    @endif
</div>
