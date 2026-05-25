@extends('layouts.app')

@section('title', 'Produk - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Produk"
        subtitle="Informasi terbaru seputar Kompetensi Produk"
        bgImage="https://via.placeholder.com/1920x400?text=Produk">
        <span>Beranda</span> > <span>Produk</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    [
                        'icon' => '📋',
                        'title' => 'Misaor RK1 Sistem Informasi Manajemen',
                        'subtitle' => 'PT. JTK Direkutusi Jakarta Raya dan Tangerang'
                    ],
                    [
                        'icon' => '📊',
                        'title' => 'Aplikasi S.SUPER DATA INFORME PT. PT. JTK',
                        'subtitle' => 'Distribusi klisas tiap dan Tangerang'
                    ],
                    [
                        'icon' => '🌐',
                        'title' => 'Sistem Informasi Kesehatan dan Pencarian Runuan software ini di Indonesia',
                        'subtitle' => ''
                    ],
                    [
                        'icon' => '💼',
                        'title' => 'Misaor RK1 Sistem Informasi Manajemen',
                        'subtitle' => 'PT. JTK direkusitusi Jakarta Raya Sumatera Selatan'
                    ],
                    [
                        'icon' => '🔐',
                        'title' => 'Aplikasi Customer Relationship Management',
                        'subtitle' => ''
                    ],
                    [
                        'icon' => '🎯',
                        'title' => 'Produk Enam',
                        'subtitle' => 'Deskripsi produk'
                    ]
                ] as $product)
                    <div class="border-2 border-navy-900 rounded-lg p-8 hover:shadow-lg transition text-center">
                        <div class="text-5xl mb-4">{{ $product['icon'] }}</div>
                        <h3 class="font-bold text-navy-900 mb-3 text-sm">{{ $product['title'] }}</h3>
                        @if($product['subtitle'])
                            <p class="text-xs text-gray-600">{{ $product['subtitle'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
