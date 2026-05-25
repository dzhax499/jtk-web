@extends('layouts.app')

@section('title', 'Prestasi - JTK POLBAN')

@section('content')
    <!-- Hero Section -->
    <x-hero 
        title="Prestasi Mahasiswa"
        subtitle="Informasi tentang prestasi dan pencapaian mahasiswa Jurusan Teknik Komputer dan Informatika Politeknik Negeri Bandung"
        bgImage="https://via.placeholder.com/1920x400?text=Prestasi">
    </x-hero>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="flex flex-wrap gap-4 mb-12">
                <button class="px-6 py-2 bg-navy-900 text-white rounded-full font-semibold hover:bg-navy-800 transition">
                    Semua Prestasi
                </button>
                <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                    Kompetisi Akademik
                </button>
                <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                    Kompetisi Non Akademik
                </button>
                <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:border-navy-900 transition">
                    Penghargaan
                </button>
            </div>

            <!-- Achievements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($achievements as $achievement)
                    <x-card 
                        image="{{ $achievement['image'] }}"
                        title="{{ $achievement['title'] }}"
                        href="/prestasi/{{ $achievement['id'] }}">
                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                            <span>📅 {{ $achievement['date'] }}</span>
                            <span>👁️ {{ $achievement['views'] }} Views</span>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <!-- Load More -->
            <div class="text-center mt-12">
                <x-button href="#" type="outline" class="border-navy-900 text-navy-900 hover:bg-navy-50">
                    Muat Lebih Banyak Prestasi
                </x-button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-gradient-to-r from-navy-900 to-navy-800 py-16 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <p class="text-5xl font-bold mb-2">150+</p>
                    <p class="text-gray-200">Prestasi Mahasiswa</p>
                </div>
                <div>
                    <p class="text-5xl font-bold mb-2">45+</p>
                    <p class="text-gray-200">Kompetisi Nasional</p>
                </div>
                <div>
                    <p class="text-5xl font-bold mb-2">20+</p>
                    <p class="text-gray-200">Kompetisi Internasional</p>
                </div>
            </div>
        </div>
    </section>
@endsection
