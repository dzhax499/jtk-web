<!-- resources/views/components/button.blade.php -->
@props(['href' => null, 'type' => 'primary', 'size' => 'md', 'class' => ''])

@php
$baseClasses = 'font-medium rounded-lg transition duration-300 inline-block text-center';

$sizeClasses = match($size) {
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-3 text-base',
    'lg' => 'px-8 py-4 text-lg',
    default => 'px-6 py-3 text-base',
};

$typeClasses = match($type) {
    'primary' => 'bg-navy-900 text-white hover:bg-navy-800 shadow-md hover:shadow-lg',
    'secondary' => 'border-2 border-navy-900 text-navy-900 hover:bg-navy-50',
    'outline' => 'border-2 border-navy-900 text-navy-900 hover:bg-navy-50',
    'ghost' => 'text-navy-900 hover:bg-gray-100',
    default => 'bg-navy-900 text-white hover:bg-navy-800',
};

$finalClasses = trim("$baseClasses $sizeClasses $typeClasses $class");
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $finalClasses }}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button type="button" class="{{ $finalClasses }}" {{ $attributes }}>
        {{ $slot }}
    </button>
@endif
