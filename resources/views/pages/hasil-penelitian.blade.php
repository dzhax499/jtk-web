@extends('layouts.app')

@section('title', 'Hasil Penelitian - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Hasil Penelitian"
        subtitle="Informasi terbaru seputar Hasil Penelitian"
        bgImage="https://via.placeholder.com/1920x400?text=Hasil+Penelitian">
        <span>Beranda</span> > <span>Hasil Penelitian</span>
    </x-hero>

    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tabs -->
            <div class="mb-8">
                <div class="flex gap-4 border-b border-gray-300">
                    <button class="px-6 py-3 font-semibold text-navy-900 border-b-2 border-navy-900 focus:outline-none">
                        Semua Program
                    </button>
                    <button class="px-6 py-3 font-semibold text-gray-600 hover:text-navy-900 focus:outline-none">
                        Program Studi D3
                    </button>
                    <button class="px-6 py-3 font-semibold text-gray-600 hover:text-navy-900 focus:outline-none">
                        Program Studi D4
                    </button>
                </div>
            </div>

            <!-- Research Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    [
                        'title' => 'Pemodelan dan Penerapan Penggaloian Sumber Daya Terpaldu untuk Sistem Berbasis ERP',
                        'author' => 'Saptafitana, B.Ak., M.Sc. dkk',
                        'year' => '2019',
                        'id' => 'M&B Beasiswa DPTI'
                    ],
                    [
                        'title' => 'Prototype Framework Aplikasi Pengukuran Kinerja Organisasi',
                        'author' => 'Soni Apdianto, S.Si., M.T., dkk',
                        'year' => '2019',
                        'id' => 'Hibur Inovasi/IPTI UKM'
                    ],
                    [
                        'title' => 'Pemodelan Kemitiraan Pendidikan Politknik Industri',
                        'author' => 'Rizayusha Setiawan, Ph.D',
                        'year' => '2019',
                        'id' => 'Pencurahan DPMI DPTI'
                    ]
                ] as $research)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                        <p class="text-sm font-semibold text-navy-900 mb-2">{{ $research['year'] }}</p>
                        <h3 class="font-bold text-navy-900 mb-3 text-sm leading-relaxed">{{ $research['title'] }}</h3>
                        <p class="text-xs text-gray-600 mb-2">{{ $research['author'] }}</p>
                        <p class="text-xs text-gray-500">{{ $research['id'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="px-6 py-3 border-2 border-navy-900 text-navy-900 font-semibold rounded-full hover:bg-navy-900 hover:text-white transition">
                    Selengkapnya di S3 | A.1
                </button>
            </div>
        </div>
    </section>
@endsection
