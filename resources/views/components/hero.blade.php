<!-- resources/views/components/hero.blade.php -->
@props(['title', 'subtitle' => null, 'bgImage' => null, 'class' => ''])

<div class="relative w-full h-96 overflow-hidden {{ $class }}" 
     @if($bgImage) style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;" @endif>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-navy-900/90 to-navy-800/70"></div>
    
    <!-- Content -->
    <div class="relative h-full flex flex-col justify-center items-start">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="text-lg text-gray-100 max-w-2xl">
                    {{ $subtitle }}
                </p>
            @endif
            <div class="mt-6 text-sm text-gray-200">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
