<!-- resources/views/components/hero.blade.php -->
@props(['title', 'subtitle' => null, 'bgImage' => null, 'class' => ''])

<div class="relative w-full h-[380px] md:h-[300px] overflow-hidden group font-['Poppins'] {{ $class }}" 
     @if($bgImage) style="background-image: url('{{ asset('img/gedungh.png') }}'); background-size: cover; background-position: right center;" @endif>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#00008B] from-[15%] to-transparent"></div>
    
    <!-- Content -->
    <div class="relative h-full flex flex-col justify-center items-start">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-3 leading-tight">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="text-sm md:text-base text-gray-200 max-w-2xl mb-4">
                   {{ $subtitle }}
                </p>
            @endif
            <div class="text-xs md:text-sm text-gray-300">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
